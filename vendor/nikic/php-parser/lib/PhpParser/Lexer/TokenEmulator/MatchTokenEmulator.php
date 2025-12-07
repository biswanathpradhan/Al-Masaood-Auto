<?php declare(strict_types=1);

namespace PhpParser\Lexer\TokenEmulator;

<<<<<<< HEAD
use PhpParser\Lexer\Emulative;

final class MatchTokenEmulator extends KeywordEmulator
{
    public function getPhpVersion(): string
    {
        return Emulative::PHP_8_0;
    }

    public function getKeywordString(): string
    {
        return 'match';
    }

    public function getKeywordToken(): int
    {
=======
use PhpParser\PhpVersion;

final class MatchTokenEmulator extends KeywordEmulator {
    public function getPhpVersion(): PhpVersion {
        return PhpVersion::fromComponents(8, 0);
    }

    public function getKeywordString(): string {
        return 'match';
    }

    public function getKeywordToken(): int {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return \T_MATCH;
    }
}
