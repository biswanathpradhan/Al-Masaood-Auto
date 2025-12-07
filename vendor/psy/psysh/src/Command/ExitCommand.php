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

use Psy\Exception\BreakException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Exit the Psy Shell.
 *
 * Just what it says on the tin.
 */
class ExitCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('exit')
            ->setAliases(['quit', 'q'])
            ->setDefinition([])
            ->setDescription('End the current session and return to caller.')
            ->setHelp(
                <<<'HELP'
End the current session and return to caller.

e.g.
<return>>>> exit</return>
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
        throw new BreakException('Goodbye');
    }
}
