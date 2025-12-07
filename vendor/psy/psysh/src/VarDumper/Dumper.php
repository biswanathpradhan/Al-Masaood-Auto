<?php

/*
 * This file is part of Psy Shell.
 *
<<<<<<< HEAD
 * (c) 2012-2023 Justin Hileman
=======
 * (c) 2012-2025 Justin Hileman
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\VarDumper;

use Symfony\Component\Console\Formatter\OutputFormatter;
use Symfony\Component\VarDumper\Cloner\Cursor;
use Symfony\Component\VarDumper\Dumper\CliDumper;

/**
 * A PsySH-specialized CliDumper.
 */
class Dumper extends CliDumper
{
<<<<<<< HEAD
    private $formatter;
    private $forceArrayIndexes;

    protected static $onlyControlCharsRx = '/^[\x00-\x1F\x7F]+$/';
    protected static $controlCharsRx = '/([\x00-\x1F\x7F]+)/';
    protected static $controlCharsMap = [
=======
    private OutputFormatter $formatter;
    private bool $forceArrayIndexes;

    private const ONLY_CONTROL_CHARS = '/^[\x00-\x1F\x7F]+$/';
    private const CONTROL_CHARS = '/([\x00-\x1F\x7F]+)/';
    private const CONTROL_CHARS_MAP = [
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        "\0"   => '\0',
        "\t"   => '\t',
        "\n"   => '\n',
        "\v"   => '\v',
        "\f"   => '\f',
        "\r"   => '\r',
        "\033" => '\e',
    ];

    public function __construct(OutputFormatter $formatter, $forceArrayIndexes = false)
    {
        $this->formatter = $formatter;
        $this->forceArrayIndexes = $forceArrayIndexes;
        parent::__construct();
        $this->setColors(false);
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function enterHash(Cursor $cursor, $type, $class, $hasChild)
=======
    public function enterHash(Cursor $cursor, $type, $class, $hasChild): void
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    {
        if (Cursor::HASH_INDEXED === $type || Cursor::HASH_ASSOC === $type) {
            $class = 0;
        }
        parent::enterHash($cursor, $type, $class, $hasChild);
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    protected function dumpKey(Cursor $cursor)
=======
    protected function dumpKey(Cursor $cursor): void
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    {
        if ($this->forceArrayIndexes || Cursor::HASH_INDEXED !== $cursor->hashType) {
            parent::dumpKey($cursor);
        }
    }

    protected function style($style, $value, $attr = []): string
    {
        if ('ref' === $style) {
            $value = \strtr($value, '@', '#');
        }

        $styled = '';
<<<<<<< HEAD
        $map = self::$controlCharsMap;
        $cchr = $this->styles['cchr'];

        $chunks = \preg_split(self::$controlCharsRx, $value, -1, \PREG_SPLIT_NO_EMPTY | \PREG_SPLIT_DELIM_CAPTURE);
        foreach ($chunks as $chunk) {
            if (\preg_match(self::$onlyControlCharsRx, $chunk)) {
                $chars = '';
                $i = 0;
                do {
                    $chars .= isset($map[$chunk[$i]]) ? $map[$chunk[$i]] : \sprintf('\x%02X', \ord($chunk[$i]));
=======
        $cchr = $this->styles['cchr'] ?? '';

        $chunks = \preg_split(self::CONTROL_CHARS, $value, -1, \PREG_SPLIT_NO_EMPTY | \PREG_SPLIT_DELIM_CAPTURE);
        foreach ($chunks as $chunk) {
            if (\preg_match(self::ONLY_CONTROL_CHARS, $chunk)) {
                $chars = '';
                $i = 0;
                do {
                    $chars .= isset(self::CONTROL_CHARS_MAP[$chunk[$i]]) ? self::CONTROL_CHARS_MAP[$chunk[$i]] : \sprintf('\x%02X', \ord($chunk[$i]));
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
                } while (isset($chunk[++$i]));

                $chars = $this->formatter->escape($chars);
                $styled .= "<{$cchr}>{$chars}</{$cchr}>";
            } else {
                $styled .= $this->formatter->escape($chunk);
            }
        }

        $style = $this->styles[$style];

        return "<{$style}>{$styled}</{$style}>";
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    protected function dumpLine($depth, $endOfValue = false)
=======
    protected function dumpLine($depth, $endOfValue = false): void
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    {
        if ($endOfValue && 0 < $depth) {
            $this->line .= ',';
        }
        $this->line = $this->formatter->format($this->line);
        parent::dumpLine($depth, $endOfValue);
    }
}
