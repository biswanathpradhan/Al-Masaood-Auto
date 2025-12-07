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
use Psy\Input\CodeArgument;
=======
use Psy\Exception\RuntimeException;
use Psy\Input\CodeArgument;
use Psy\Output\ShellOutput;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
use Psy\VarDumper\Presenter;
use Psy\VarDumper\PresenterAware;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Dump an object or primitive.
 *
 * This is like var_dump but *way* awesomer.
 */
class DumpCommand extends ReflectingCommand implements PresenterAware
{
<<<<<<< HEAD
    private $presenter;
=======
    private Presenter $presenter;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * PresenterAware interface.
     *
     * @param Presenter $presenter
     */
    public function setPresenter(Presenter $presenter)
    {
        $this->presenter = $presenter;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('dump')
            ->setDefinition([
                new CodeArgument('target', CodeArgument::REQUIRED, 'A target object or primitive to dump.'),
                new InputOption('depth', '', InputOption::VALUE_REQUIRED, 'Depth to parse.', 10),
                new InputOption('all', 'a', InputOption::VALUE_NONE, 'Include private and protected methods and properties.'),
            ])
            ->setDescription('Dump an object or primitive.')
            ->setHelp(
                <<<'HELP'
Dump an object or primitive.

This is like var_dump but <strong>way</strong> awesomer.

e.g.
<return>>>> dump $_</return>
<return>>>> dump $someVar</return>
<return>>>> dump $stuff->getAll()</return>
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
=======
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!$output instanceof ShellOutput) {
            throw new RuntimeException('DumpCommand requires a ShellOutput');
        }

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        $depth = $input->getOption('depth');
        $target = $this->resolveCode($input->getArgument('target'));
        $output->page($this->presenter->present($target, $depth, $input->getOption('all') ? Presenter::VERBOSE : 0));

        if (\is_object($target)) {
            $this->setCommandScopeVariables(new \ReflectionObject($target));
        }

        return 0;
    }
<<<<<<< HEAD

    /**
     * @deprecated Use `resolveCode` instead
     *
     * @param string $name
     *
     * @return mixed
     */
    protected function resolveTarget(string $name)
    {
        @\trigger_error('`resolveTarget` is deprecated; use `resolveCode` instead.', \E_USER_DEPRECATED);

        return $this->resolveCode($name);
    }
=======
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
}
