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
use Psy\Exception\RuntimeException;
=======
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
use Psy\Output\ShellOutput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Interact with the current code buffer.
 *
 * Shows and clears the buffer for the current multi-line expression.
 */
class BufferCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('buffer')
            ->setAliases(['buf'])
            ->setDefinition([
                new InputOption('clear', '', InputOption::VALUE_NONE, 'Clear the current buffer.'),
            ])
            ->setDescription('Show (or clear) the contents of the code input buffer.')
            ->setHelp(
                <<<'HELP'
Show the contents of the code buffer for the current multi-line expression.

Optionally, clear the buffer by passing the <info>--clear</info> option.
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
    {
        $app = $this->getApplication();
        if (!$app instanceof \Psy\Shell) {
            throw new RuntimeException('Buffer command requires a \Psy\Shell application');
        }

        $buf = $app->getCodeBuffer();
        if ($input->getOption('clear')) {
            $app->resetCodeBuffer();
=======
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $shell = $this->getShell();

        $buf = $shell->getCodeBuffer();
        if ($input->getOption('clear')) {
            $shell->resetCodeBuffer();
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            $output->writeln($this->formatLines($buf, 'urgent'), ShellOutput::NUMBER_LINES);
        } else {
            $output->writeln($this->formatLines($buf), ShellOutput::NUMBER_LINES);
        }

        return 0;
    }

    /**
     * A helper method for wrapping buffer lines in `<urgent>` and `<return>` formatter strings.
     *
     * @param array  $lines
     * @param string $type  (default: 'return')
     *
     * @return array Formatted strings
     */
    protected function formatLines(array $lines, string $type = 'return'): array
    {
        $template = \sprintf('<%s>%%s</%s>', $type, $type);

        return \array_map(function ($line) use ($template) {
            return \sprintf($template, $line);
        }, $lines);
    }
}
