<?php declare(strict_types=1);

namespace PhpParser\Lexer\TokenEmulator;

<<<<<<< HEAD
abstract class KeywordEmulator extends TokenEmulator
{
    abstract function getKeywordString(): string;
    abstract function getKeywordToken(): int;

    public function isEmulationNeeded(string $code): bool
    {
        return strpos(strtolower($code), $this->getKeywordString()) !== false;
    }

    protected function isKeywordContext(array $tokens, int $pos): bool
    {
        $previousNonSpaceToken = $this->getPreviousNonSpaceToken($tokens, $pos);
        return $previousNonSpaceToken === null || $previousNonSpaceToken[0] !== \T_OBJECT_OPERATOR;
    }

    public function emulate(string $code, array $tokens): array
    {
        $keywordString = $this->getKeywordString();
        foreach ($tokens as $i => $token) {
            if ($token[0] === T_STRING && strtolower($token[1]) === $keywordString
                    && $this->isKeywordContext($tokens, $i)) {
                $tokens[$i][0] = $this->getKeywordToken();
=======
use PhpParser\Token;

abstract class KeywordEmulator extends TokenEmulator {
    abstract public function getKeywordString(): string;
    abstract public function getKeywordToken(): int;

    public function isEmulationNeeded(string $code): bool {
        return strpos(strtolower($code), $this->getKeywordString()) !== false;
    }

    /** @param Token[] $tokens */
    protected function isKeywordContext(array $tokens, int $pos): bool {
        $prevToken = $this->getPreviousNonSpaceToken($tokens, $pos);
        if ($prevToken === null) {
            return false;
        }
        return $prevToken->id !== \T_OBJECT_OPERATOR
            && $prevToken->id !== \T_NULLSAFE_OBJECT_OPERATOR;
    }

    public function emulate(string $code, array $tokens): array {
        $keywordString = $this->getKeywordString();
        foreach ($tokens as $i => $token) {
            if ($token->id === T_STRING && strtolower($token->text) === $keywordString
                    && $this->isKeywordContext($tokens, $i)) {
                $token->id = $this->getKeywordToken();
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            }
        }

        return $tokens;
    }

<<<<<<< HEAD
    /**
     * @param mixed[] $tokens
     * @return array|string|null
     */
    private function getPreviousNonSpaceToken(array $tokens, int $start)
    {
        for ($i = $start - 1; $i >= 0; --$i) {
            if ($tokens[$i][0] === T_WHITESPACE) {
=======
    /** @param Token[] $tokens */
    private function getPreviousNonSpaceToken(array $tokens, int $start): ?Token {
        for ($i = $start - 1; $i >= 0; --$i) {
            if ($tokens[$i]->id === T_WHITESPACE) {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
                continue;
            }

            return $tokens[$i];
        }

        return null;
    }

<<<<<<< HEAD
    public function reverseEmulate(string $code, array $tokens): array
    {
        $keywordToken = $this->getKeywordToken();
        foreach ($tokens as $i => $token) {
            if ($token[0] === $keywordToken) {
                $tokens[$i][0] = \T_STRING;
=======
    public function reverseEmulate(string $code, array $tokens): array {
        $keywordToken = $this->getKeywordToken();
        foreach ($tokens as $token) {
            if ($token->id === $keywordToken) {
                $token->id = \T_STRING;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            }
        }

        return $tokens;
    }
}
