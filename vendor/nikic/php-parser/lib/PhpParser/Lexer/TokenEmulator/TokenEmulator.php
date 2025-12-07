<?php declare(strict_types=1);

namespace PhpParser\Lexer\TokenEmulator;

<<<<<<< HEAD
/** @internal */
abstract class TokenEmulator
{
    abstract public function getPhpVersion(): string;
=======
use PhpParser\PhpVersion;
use PhpParser\Token;

/** @internal */
abstract class TokenEmulator {
    abstract public function getPhpVersion(): PhpVersion;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    abstract public function isEmulationNeeded(string $code): bool;

    /**
<<<<<<< HEAD
     * @return array Modified Tokens
=======
     * @param Token[] $tokens Original tokens
     * @return Token[] Modified Tokens
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    abstract public function emulate(string $code, array $tokens): array;

    /**
<<<<<<< HEAD
     * @return array Modified Tokens
     */
    abstract public function reverseEmulate(string $code, array $tokens): array;

=======
     * @param Token[] $tokens Original tokens
     * @return Token[] Modified Tokens
     */
    abstract public function reverseEmulate(string $code, array $tokens): array;

    /** @param array{int, string, string}[] $patches */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    public function preprocessCode(string $code, array &$patches): string {
        return $code;
    }
}
