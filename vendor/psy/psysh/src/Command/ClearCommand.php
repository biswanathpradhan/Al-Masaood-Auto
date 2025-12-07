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

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Clear the Psy Shell.
 *
 * Just what it says on the tin.
 */
class ClearCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('clear')
            ->setDefinition([])
            ->setDescription('Clear the Psy Shell screen.')
            ->setHelp(
                <<<'HELP'
Clear the Psy Shell screen.

Pro Tip: If your PHP has readline support, you should be able to use ctrl+l too!
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
        $output->write(\sprintf('%c[2J%c[0;0f', 27, 27));

        return 0;
    }
}
