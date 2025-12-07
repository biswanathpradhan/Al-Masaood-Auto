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

namespace Psy\Command;

<<<<<<< HEAD
=======
use Psy\ConfigPaths;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
use Psy\Input\FilterOptions;
use Psy\Output\ShellOutput;
use Psy\Readline\Readline;
use Symfony\Component\Console\Formatter\OutputFormatter;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Psy Shell history command.
 *
 * Shows, searches and replays readline history. Not too shabby.
 */
class HistoryCommand extends Command
{
<<<<<<< HEAD
    private $filter;
    private $readline;
=======
    private FilterOptions $filter;
    private Readline $readline;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * {@inheritdoc}
     */
    public function __construct($name = null)
    {
        $this->filter = new FilterOptions();

        parent::__construct($name);
    }

    /**
     * Set the Shell's Readline service.
     *
     * @param Readline $readline
     */
    public function setReadline(Readline $readline)
    {
        $this->readline = $readline;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        list($grep, $insensitive, $invert) = FilterOptions::getOptions();

        $this
            ->setName('history')
            ->setAliases(['hist'])
            ->setDefinition([
                new InputOption('show', 's', InputOption::VALUE_REQUIRED, 'Show the given range of lines.'),
                new InputOption('head', 'H', InputOption::VALUE_REQUIRED, 'Display the first N items.'),
                new InputOption('tail', 'T', InputOption::VALUE_REQUIRED, 'Display the last N items.'),

                $grep,
                $insensitive,
                $invert,

                new InputOption('no-numbers', 'N', InputOption::VALUE_NONE, 'Omit line numbers.'),

                new InputOption('save', '', InputOption::VALUE_REQUIRED, 'Save history to a file.'),
                new InputOption('replay', '', InputOption::VALUE_NONE, 'Replay.'),
                new InputOption('clear', '', InputOption::VALUE_NONE, 'Clear the history.'),
            ])
            ->setDescription('Show the Psy Shell history.')
            ->setHelp(
                <<<'HELP'
Show, search, save or replay the Psy Shell history.

e.g.
<return>>>> history --grep /[bB]acon/</return>
<return>>>> history --show 0..10 --replay</return>
<return>>>> history --clear</return>
<return>>>> history --tail 1000 --save somefile.txt</return>
HELP
            );
    }

    /**
     * {@inheritdoc}
     *
     * @return int 0 if everything went fine, or an exit code
     */
<<<<<<< HEAD
    protected function execute(InputInterface $input, OutputInterface $output)
=======
    protected function execute(InputInterface $input, OutputInterface $output): int
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    {
        $this->validateOnlyOne($input, ['show', 'head', 'tail']);
        $this->validateOnlyOne($input, ['save', 'replay', 'clear']);

<<<<<<< HEAD
        $history = $this->getHistorySlice(
            $input->getOption('show'),
            $input->getOption('head'),
            $input->getOption('tail')
        );
=======
        // For --show, slice first (uses original line numbers), then filter
        $show = $input->getOption('show');

        // For --head/--tail, filter first, then slice (uses result count)
        $head = $input->getOption('head');
        $tail = $input->getOption('tail');

        $history = $this->getHistorySlice($show);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        $highlighted = false;

        $this->filter->bind($input);
        if ($this->filter->hasFilter()) {
            $matches = [];
            $highlighted = [];
            foreach ($history as $i => $line) {
                if ($this->filter->match($line, $matches)) {
                    if (isset($matches[0])) {
                        $chunks = \explode($matches[0], $history[$i]);
                        $chunks = \array_map([__CLASS__, 'escape'], $chunks);
                        $glue = \sprintf('<urgent>%s</urgent>', self::escape($matches[0]));

                        $highlighted[$i] = \implode($glue, $chunks);
                    }
                } else {
                    unset($history[$i]);
<<<<<<< HEAD
=======
                    unset($highlighted[$i]);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
                }
            }
        }

<<<<<<< HEAD
        if ($save = $input->getOption('save')) {
            $output->writeln(\sprintf('Saving history in %s...', $save));
=======
        $history = $this->applyHeadOrTail($history, $head, $tail);
        if ($highlighted) {
            $highlighted = $this->applyHeadOrTail($highlighted, $head, $tail);
        }

        if ($save = $input->getOption('save')) {
            $output->writeln(\sprintf('Saving history in %s...', ConfigPaths::prettyPath($save)));
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            \file_put_contents($save, \implode(\PHP_EOL, $history).\PHP_EOL);
            $output->writeln('<info>History saved.</info>');
        } elseif ($input->getOption('replay')) {
            if (!($input->getOption('show') || $input->getOption('head') || $input->getOption('tail'))) {
                throw new \InvalidArgumentException('You must limit history via --head, --tail or --show before replaying');
            }

            $count = \count($history);
            $output->writeln(\sprintf('Replaying %d line%s of history', $count, ($count !== 1) ? 's' : ''));
<<<<<<< HEAD
            $this->getApplication()->addInput($history);
=======

            $this->getShell()->addInput($history);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        } elseif ($input->getOption('clear')) {
            $this->clearHistory();
            $output->writeln('<info>History cleared.</info>');
        } else {
            $type = $input->getOption('no-numbers') ? 0 : ShellOutput::NUMBER_LINES;
            if (!$highlighted) {
                $type = $type | OutputInterface::OUTPUT_RAW;
            }

            $output->page($highlighted ?: $history, $type);
        }

        return 0;
    }

    /**
     * Extract a range from a string.
     *
     * @param string $range
     *
<<<<<<< HEAD
     * @return array [ start, end ]
=======
     * @return int[] [ start, end ]
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    private function extractRange(string $range): array
    {
        if (\preg_match('/^\d+$/', $range)) {
<<<<<<< HEAD
            return [$range, $range + 1];
=======
            return [(int) $range, (int) $range + 1];
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        }

        $matches = [];
        if ($range !== '..' && \preg_match('/^(\d*)\.\.(\d*)$/', $range, $matches)) {
            $start = $matches[1] ? (int) $matches[1] : 0;
            $end = $matches[2] ? (int) $matches[2] + 1 : \PHP_INT_MAX;

            return [$start, $end];
        }

        throw new \InvalidArgumentException('Unexpected range: '.$range);
    }

    /**
<<<<<<< HEAD
     * Retrieve a slice of the readline history.
     *
     * @param string|null $show
     * @param string|null $head
     * @param string|null $tail
     *
     * @return array A slice of history
     */
    private function getHistorySlice($show, $head, $tail): array
    {
        $history = $this->readline->listHistory();

        // don't show the current `history` invocation
        \array_pop($history);

        if ($show) {
            list($start, $end) = $this->extractRange($show);
            $length = $end - $start;
        } elseif ($head) {
=======
     * Retrieve a slice of the readline history by range.
     *
     * @param string|null $show Range specification (e.g., "5..10")
     *
     * @return array A slice of history
     */
    private function getHistorySlice(?string $show): array
    {
        $history = $this->readline->listHistory();
        // don't show the current `history` invocation
        \array_pop($history);

        if ($show === null) {
            return $history;
        }

        list($start, $end) = $this->extractRange($show);
        $length = $end - $start;

        return \array_slice($history, $start, $length, true);
    }

    /**
     * Apply --head or --tail to a history array.
     */
    private function applyHeadOrTail(array $history, ?string $head, ?string $tail): array
    {
        if ($head) {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            if (!\preg_match('/^\d+$/', $head)) {
                throw new \InvalidArgumentException('Please specify an integer argument for --head');
            }

<<<<<<< HEAD
            $start = 0;
            $length = (int) $head;
=======
            return \array_slice($history, 0, (int) $head, true);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        } elseif ($tail) {
            if (!\preg_match('/^\d+$/', $tail)) {
                throw new \InvalidArgumentException('Please specify an integer argument for --tail');
            }

<<<<<<< HEAD
            $start = \count($history) - $tail;
            $length = (int) $tail + 1;
        } else {
            return $history;
        }

        return \array_slice($history, $start, $length, true);
=======
            $start = \count($history) - (int) $tail;
            $length = (int) $tail + 1;

            return \array_slice($history, $start, $length, true);
        }

        return $history;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Validate that only one of the given $options is set.
     *
     * @param InputInterface $input
     * @param array          $options
     */
    private function validateOnlyOne(InputInterface $input, array $options)
    {
        $count = 0;
        foreach ($options as $opt) {
            if ($input->getOption($opt)) {
                $count++;
            }
        }

        if ($count > 1) {
            throw new \InvalidArgumentException('Please specify only one of --'.\implode(', --', $options));
        }
    }

    /**
     * Clear the readline history.
     */
    private function clearHistory()
    {
        $this->readline->clearHistory();
    }

    public static function escape(string $string): string
    {
        return OutputFormatter::escape($string);
    }
}
