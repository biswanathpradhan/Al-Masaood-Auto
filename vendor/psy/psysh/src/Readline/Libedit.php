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

<<<<<<< HEAD
=======
use Psy\ConfigPaths;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
use Psy\Util\Str;

/**
 * A Libedit-based Readline implementation.
 *
 * This is largely the same as the Readline implementation, but it emulates
 * support for `readline_list_history` since PHP decided it was a good idea to
 * ship a fake Readline implementation that is missing history support.
 *
 * NOTE: As of PHP 7.4, PHP sometimes has history support in the Libedit
 * wrapper, so it will use the GNUReadline implementation rather than this one.
 */
class Libedit extends GNUReadline
{
<<<<<<< HEAD
    private $hasWarnedOwnership = false;
=======
    private bool $hasWarnedOwnership = false;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Let's emulate GNU Readline by manually reading and parsing the history file!
     */
    public static function isSupported(): bool
    {
        return \function_exists('readline') && !\function_exists('readline_list_history');
    }

    /**
     * {@inheritdoc}
     */
    public static function supportsBracketedPaste(): bool
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function listHistory(): array
    {
<<<<<<< HEAD
=======
        if ($this->historyFile === false) {
            return [];
        }

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        $history = \file_get_contents($this->historyFile);
        if (!$history) {
            return [];
        }

        // libedit doesn't seem to support non-unix line separators.
        $history = \explode("\n", $history);

        // remove history signature if it exists
        if ($history[0] === '_HiStOrY_V2_') {
            \array_shift($history);
        }

        // decode the line
        $history = \array_map([$this, 'parseHistoryLine'], $history);
<<<<<<< HEAD
=======

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        // filter empty lines & comments
        return \array_values(\array_filter($history));
    }

    /**
     * {@inheritdoc}
     */
    public function writeHistory(): bool
    {
        $res = parent::writeHistory();

        // Libedit apparently refuses to save history if the history file is not
        // owned by the user, even if it is writable. Warn when this happens.
        //
        // See https://github.com/bobthecow/psysh/issues/552
        if ($res === false && !$this->hasWarnedOwnership) {
            if (\is_file($this->historyFile) && \is_writable($this->historyFile)) {
                $this->hasWarnedOwnership = true;
<<<<<<< HEAD
                $msg = \sprintf('Error writing history file, check file ownership: %s', $this->historyFile);
=======
                $msg = \sprintf('Error writing history file, check file ownership: %s', ConfigPaths::prettyPath($this->historyFile));
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
                \trigger_error($msg, \E_USER_NOTICE);
            }
        }

        return $res;
    }

    /**
     * From GNUReadline (readline/histfile.c & readline/histexpand.c):
     * lines starting with "\0" are comments or timestamps;
     * if "\0" is found in an entry,
     * everything from it until the next line is a comment.
     *
     * @param string $line The history line to parse
     *
     * @return string|null
     */
    protected function parseHistoryLine(string $line)
    {
        // empty line, comment or timestamp
        if (!$line || $line[0] === "\0") {
<<<<<<< HEAD
            return;
=======
            return null;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        }
        // if "\0" is found in an entry, then
        // everything from it until the end of line is a comment.
        if (($pos = \strpos($line, "\0")) !== false) {
            $line = \substr($line, 0, $pos);
        }

        return ($line !== '') ? Str::unvis($line) : null;
    }
}
