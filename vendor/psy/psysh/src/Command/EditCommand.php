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
use Psy\Context;
use Psy\ContextAware;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class EditCommand extends Command implements ContextAware
{
<<<<<<< HEAD
    /**
     * @var string
     */
    private $runtimeDir = '';

    /**
     * @var Context
     */
    private $context;
=======
    private string $runtimeDir = '';
    private Context $context;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Constructor.
     *
     * @param string      $runtimeDir The directory to use for temporary files
     * @param string|null $name       The name of the command; passing null means it must be set in configure()
     *
     * @throws \Symfony\Component\Console\Exception\LogicException When the command name is empty
     */
    public function __construct($runtimeDir, $name = null)
    {
        parent::__construct($name);

        $this->runtimeDir = $runtimeDir;
    }

    protected function configure()
    {
        $this
            ->setName('edit')
            ->setDefinition([
                new InputArgument('file', InputArgument::OPTIONAL, 'The file to open for editing. If this is not given, edits a temporary file.', null),
                new InputOption(
                    'exec',
                    'e',
                    InputOption::VALUE_NONE,
                    'Execute the file content after editing. This is the default when a file name argument is not given.',
                    null
                ),
                new InputOption(
                    'no-exec',
                    'E',
                    InputOption::VALUE_NONE,
                    'Do not execute the file content after editing. This is the default when a file name argument is given.',
                    null
                ),
            ])
            ->setDescription('Open an external editor. Afterwards, get produced code in input buffer.')
            ->setHelp('Set the EDITOR environment variable to something you\'d like to use.');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int 0 if everything went fine, or an exit code
     *
     * @throws \InvalidArgumentException when both exec and no-exec flags are given or if a given variable is not found in the current context
     * @throws \UnexpectedValueException if file_get_contents on the edited file returns false instead of a string
     */
<<<<<<< HEAD
    protected function execute(InputInterface $input, OutputInterface $output)
=======
    protected function execute(InputInterface $input, OutputInterface $output): int
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    {
        if ($input->getOption('exec') &&
            $input->getOption('no-exec')) {
            throw new \InvalidArgumentException('The --exec and --no-exec flags are mutually exclusive');
        }

        $filePath = $this->extractFilePath($input->getArgument('file'));

        $execute = $this->shouldExecuteFile(
            $input->getOption('exec'),
            $input->getOption('no-exec'),
            $filePath
        );

        $shouldRemoveFile = false;

        if ($filePath === null) {
<<<<<<< HEAD
=======
            ConfigPaths::ensureDir($this->runtimeDir);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            $filePath = \tempnam($this->runtimeDir, 'psysh-edit-command');
            $shouldRemoveFile = true;
        }

        $editedContent = $this->editFile($filePath, $shouldRemoveFile);

        if ($execute) {
<<<<<<< HEAD
            $this->getApplication()->addInput($editedContent);
=======
            $this->getShell()->addInput($editedContent);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        }

        return 0;
    }

    /**
     * @param bool        $execOption
     * @param bool        $noExecOption
     * @param string|null $filePath
     */
<<<<<<< HEAD
    private function shouldExecuteFile(bool $execOption, bool $noExecOption, string $filePath = null): bool
=======
    private function shouldExecuteFile(bool $execOption, bool $noExecOption, ?string $filePath = null): bool
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    {
        if ($execOption) {
            return true;
        }

        if ($noExecOption) {
            return false;
        }

        // By default, code that is edited is executed if there was no given input file path
        return $filePath === null;
    }

    /**
     * @param string|null $fileArgument
     *
     * @return string|null The file path to edit, null if the input was null, or the value of the referenced variable
     *
     * @throws \InvalidArgumentException If the variable is not found in the current context
     */
<<<<<<< HEAD
    private function extractFilePath(string $fileArgument = null)
=======
    private function extractFilePath(?string $fileArgument = null)
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    {
        // If the file argument was a variable, get it from the context
        if ($fileArgument !== null &&
            $fileArgument !== '' &&
            $fileArgument[0] === '$') {
            $fileArgument = $this->context->get(\preg_replace('/^\$/', '', $fileArgument));
        }

        return $fileArgument;
    }

    /**
     * @param string $filePath
     * @param bool   $shouldRemoveFile
     *
     * @throws \UnexpectedValueException if file_get_contents on $filePath returns false instead of a string
     */
    private function editFile(string $filePath, bool $shouldRemoveFile): string
    {
        $escapedFilePath = \escapeshellarg($filePath);
        $editor = (isset($_SERVER['EDITOR']) && $_SERVER['EDITOR']) ? $_SERVER['EDITOR'] : 'nano';

        $pipes = [];
        $proc = \proc_open("{$editor} {$escapedFilePath}", [\STDIN, \STDOUT, \STDERR], $pipes);
        \proc_close($proc);

        $editedContent = @\file_get_contents($filePath);

        if ($shouldRemoveFile) {
            @\unlink($filePath);
        }

        if ($editedContent === false) {
            throw new \UnexpectedValueException("Reading {$filePath} returned false");
        }

        return $editedContent;
    }

    /**
     * Set the Context reference.
     *
     * @param Context $context
     */
    public function setContext(Context $context)
    {
        $this->context = $context;
    }
}
