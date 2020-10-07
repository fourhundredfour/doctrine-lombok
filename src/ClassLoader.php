<?php

namespace Schischkin\DoctrineLombok;

use FilesystemIterator;

class ClassLoader
{
    /**
     * Loads all classes from a given path
     *
     * @param string $path
     * @return string[] An array with all class names
     */
    public function loadClasses(string $path): array
    {
        $files = array();

        $dir = new FilesystemIterator($path);
        foreach ($dir as $fileinfo) {
            if ($fileinfo->isFile() && $fileinfo->getExtension() === "php") {
                $namespace = $this->determineTokenValue($fileinfo->getRealPath(), [T_NAMESPACE]);
                $classname = $this->determineTokenValue($fileinfo->getRealPath(), [T_CLASS, T_INTERFACE]);

                if ($namespace !== null && $classname !== null) {
                    $files[] = "\\" . $namespace . "\\" . $classname;
                }
            } else {
                $childFiles = $this->loadClasses($fileinfo->getRealPath());
                $files = array_merge($files, $childFiles);
            }
        }

        return $files;
    }

    /**
     * Determine the namespace / name of class or interface depending on the given PHP Tokens
     *
     * @param string $classFile <p>
     * The filepath of the class
     * </p>
     * @param array $phpTokens <p>
     * Array of PHP token identifiers
     * </p>
     * @return string|null The namespace / class or interface name or null if the file does not
     * contain a class definition.
     */
    private function determineTokenValue(string $classFile, array $phpTokens): ?string
    {
        $content = file_get_contents($classFile);
        $tokens = token_get_all($content);

        $tokenIdx = $this->getTokenIndex($tokens, $phpTokens);
        if ($tokenIdx == -1) {
            return null;
        }

        $tokenValue = "";
        $tokenIdx += 2;

        // filter all whitespaces and single character tokens until
        // namespace / name of class or interface starts
        while (is_array($tokens[$tokenIdx]) && $tokens[$tokenIdx][0] !== T_WHITESPACE) {
            $tokenValue .= $tokens[$tokenIdx][1];
            $tokenIdx++;
        }

        return $tokenValue;
    }

    /**
     * Find the token index of one of the given PHP Tokens
     *
     * @param array $tokens <p>
     * Tokenized content of the class file
     * </p>
     * @param array $phpTokens <p>
     * PHP Tokens to find index of
     * </p>
     * @return int Index of the found token or -1 if no token was found
     */
    private function getTokenIndex(array $tokens, array $phpTokens): int
    {
        for ($tokenIndex = 0; $tokenIndex < count($tokens); $tokenIndex++) {
            if (is_array($tokens[$tokenIndex]) && in_array($tokens[$tokenIndex][0], $phpTokens)) {
                return $tokenIndex;
            }
        }

        return -1;
    }
}
