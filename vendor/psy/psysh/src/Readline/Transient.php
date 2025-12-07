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

namespace Psy\Readline;

use Psy\Exception\BreakException;

/**
 * An array-based Readline emulation implementation.
 */
class Transient implements Readline
{
<<<<<<< HEAD
    private $history;
    private $historySize;
    private $eraseDups;
=======
    private array $history;
    private int $historySize;
    private bool $eraseDups;
    /** @var resource */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    private $stdin;

    /**
     * Transient Readline is always supported.
     *
     * {@inheritdoc}
     */
    public static function isSupported(): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public static function supportsBracketedPaste(): bool
    {
        return false;
    }

    /**
     * Transient Readline constructor.
     */
    public function __construct($historyFile = null, $historySize = 0, $eraseDups = false)
    {
        // don't do anything with the history file...
        $this->history = [];
        $this->historySize = $historySize;
<<<<<<< HEAD
        $this->eraseDups = $eraseDups;
=======
        $this->eraseDups = $eraseDups ?? false;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * {@inheritdoc}
     */
    public function addHistory(string $line): bool
    {
        if ($this->eraseDups) {
            if (($key = \array_search($line, $this->history)) !== false) {
                unset($this->history[$key]);
            }
        }

        $this->history[] = $line;

        if ($this->historySize > 0) {
            $histsize = \count($this->history);
            if ($histsize > $this->historySize) {
                $this->history = \array_slice($this->history, $histsize - $this->historySize);
            }
        }

        $this->history = \array_values($this->history);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function clearHistory(): bool
    {
        $this->history = [];

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function listHistory(): array
    {
        return $this->history;
    }

    /**
     * {@inheritdoc}
     */
    public function readHistory(): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     *
     * @throws BreakException if user hits Ctrl+D
     *
     * @return false|string
     */
<<<<<<< HEAD
    public function readline(string $prompt = null)
=======
    public function readline(?string $prompt = null)
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    {
        echo $prompt;

        return \rtrim(\fgets($this->getStdin()), "\n\r");
    }

    /**
     * {@inheritdoc}
     */
    public function redisplay()
    {
        // noop
    }

    /**
     * {@inheritdoc}
     */
    public function writeHistory(): bool
    {
        return true;
    }

    /**
     * Get a STDIN file handle.
     *
     * @throws BreakException if user hits Ctrl+D
     *
     * @return resource
     */
    private function getStdin()
    {
        if (!isset($this->stdin)) {
            $this->stdin = \fopen('php://stdin', 'r');
        }

        if (\feof($this->stdin)) {
            throw new BreakException('Ctrl+D');
        }

        return $this->stdin;
    }
}
