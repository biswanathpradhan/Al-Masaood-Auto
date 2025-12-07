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

use PhpParser\NodeTraverser;
use PhpParser\PrettyPrinter\Standard as Printer;
use Psy\Command\TimeitCommand\TimeitVisitor;
use Psy\Input\CodeArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class TimeitCommand.
 */
class TimeitCommand extends Command
{
    const RESULT_MSG = '<info>Command took %.6f seconds to complete.</info>';
    const AVG_RESULT_MSG = '<info>Command took %.6f seconds on average (%.6f median; %.6f total) to complete.</info>';

    // All times stored as nanoseconds!
<<<<<<< HEAD
    private static $useHrtime;
    private static $start = null;
    private static $times = [];

    private $parser;
    private $traverser;
    private $printer;
=======
    private static ?int $start = null;
    private static array $times = [];

    private CodeArgumentParser $parser;
    private NodeTraverser $traverser;
    private Printer $printer;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * {@inheritdoc}
     */
    public function __construct($name = null)
    {
<<<<<<< HEAD
        // @todo Remove microtime use after we drop support for PHP < 7.3
        self::$useHrtime = \function_exists('hrtime');

        $this->parser = new CodeArgumentParser();

=======
        $this->parser = new CodeArgumentParser();

        // @todo Pass visitor directly to once we drop support for PHP-Parser 4.x
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        $this->traverser = new NodeTraverser();
        $this->traverser->addVisitor(new TimeitVisitor());

        $this->printer = new Printer();

        parent::__construct($name);
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('timeit')
            ->setDefinition([
                new InputOption('num', 'n', InputOption::VALUE_REQUIRED, 'Number of iterations.'),
                new CodeArgument('code', CodeArgument::REQUIRED, 'Code to execute.'),
            ])
            ->setDescription('Profiles with a timer.')
            ->setHelp(
                <<<'HELP'
Time profiling for functions and commands.

e.g.
<return>>>> timeit sleep(1)</return>
<return>>>> timeit -n1000 $closure()</return>
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
        $code = $input->getArgument('code');
        $num = (int) ($input->getOption('num') ?: 1);
        $shell = $this->getApplication();
=======
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $code = $input->getArgument('code');
        $num = (int) ($input->getOption('num') ?: 1);

        $shell = $this->getShell();
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

        $instrumentedCode = $this->instrumentCode($code);

        self::$times = [];

        do {
<<<<<<< HEAD
            $_ = $shell->execute($instrumentedCode);
=======
            $_ = $shell->execute($instrumentedCode, true);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            $this->ensureEndMarked();
        } while (\count(self::$times) < $num);

        $shell->writeReturnValue($_);

        $times = self::$times;
        self::$times = [];

        if ($num === 1) {
<<<<<<< HEAD
=======
            // @phpstan-ignore-next-line offsetAccess.nonOffsetAccessible (guaranteed by loop: count($times) >= $num)
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            $output->writeln(\sprintf(self::RESULT_MSG, $times[0] / 1e+9));
        } else {
            $total = \array_sum($times);
            \rsort($times);
<<<<<<< HEAD
            $median = $times[\round($num / 2)];
=======
            // @phpstan-ignore-next-line offsetAccess.nonOffsetAccessible (guaranteed by loop: count($times) >= $num)
            $median = $times[(int) \round($num / 2)];
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

            $output->writeln(\sprintf(self::AVG_RESULT_MSG, ($total / $num) / 1e+9, $median / 1e+9, $total / 1e+9));
        }

        return 0;
    }

    /**
     * Internal method for marking the start of timeit execution.
     *
     * A static call to this method will be injected at the start of the timeit
     * input code to instrument the call. We will use the saved start time to
     * more accurately calculate time elapsed during execution.
     */
    public static function markStart()
    {
<<<<<<< HEAD
        self::$start = self::$useHrtime ? \hrtime(true) : (\microtime(true) * 1e+6);
=======
        self::$start = \hrtime(true);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Internal method for marking the end of timeit execution.
     *
     * A static call to this method is injected by TimeitVisitor at the end
     * of the timeit input code to instrument the call.
     *
     * Note that this accepts an optional $ret parameter, which is used to pass
     * the return value of the last statement back out of timeit. This saves us
     * a bunch of code rewriting shenanigans.
     *
     * @param mixed $ret
     *
     * @return mixed it just passes $ret right back
     */
    public static function markEnd($ret = null)
    {
<<<<<<< HEAD
        self::$times[] = (self::$useHrtime ? \hrtime(true) : (\microtime(true) * 1e+6)) - self::$start;
=======
        self::$times[] = \hrtime(true) - self::$start;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        self::$start = null;

        return $ret;
    }

    /**
     * Ensure that the end of code execution was marked.
     *
     * The end *should* be marked in the instrumented code, but just in case
     * we'll add a fallback here.
     */
    private function ensureEndMarked()
    {
        if (self::$start !== null) {
            self::markEnd();
        }
    }

    /**
     * Instrument code for timeit execution.
     *
     * This inserts `markStart` and `markEnd` calls to ensure that (reasonably)
     * accurate times are recorded for just the code being executed.
     */
    private function instrumentCode(string $code): string
    {
        return $this->printer->prettyPrint($this->traverser->traverse($this->parser->parse($code)));
    }
}
