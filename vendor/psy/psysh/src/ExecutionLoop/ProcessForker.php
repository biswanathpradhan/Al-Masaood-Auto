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

namespace Psy\ExecutionLoop;

use Psy\Context;
use Psy\Exception\BreakException;
<<<<<<< HEAD
use Psy\Shell;
=======
use Psy\Exception\InterruptException;
use Psy\Shell;
use Psy\Util\DependencyChecker;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

/**
 * An execution loop listener that forks the process before executing code.
 *
 * This is awesome, as the session won't die prematurely if user input includes
 * a fatal error, such as redeclaring a class or function.
 */
class ProcessForker extends AbstractListener
{
<<<<<<< HEAD
    private $savegame;
    private $up;

    private static $pcntlFunctions = [
=======
    private ?int $savegame = null;
    /** @var resource */
    private $up;
    private bool $sigintHandlerInstalled = false;
    private bool $restoreStty = false;

    public const PCNTL_FUNCTIONS = [
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        'pcntl_fork',
        'pcntl_signal_dispatch',
        'pcntl_signal',
        'pcntl_waitpid',
        'pcntl_wexitstatus',
    ];

<<<<<<< HEAD
    private static $posixFunctions = [
=======
    public const POSIX_FUNCTIONS = [
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        'posix_getpid',
        'posix_kill',
    ];

    /**
     * Process forker is supported if pcntl and posix extensions are available.
     */
    public static function isSupported(): bool
    {
<<<<<<< HEAD
        return self::isPcntlSupported() && !self::disabledPcntlFunctions() && self::isPosixSupported() && !self::disabledPosixFunctions();
=======
        return DependencyChecker::functionsAvailable(self::PCNTL_FUNCTIONS)
            && DependencyChecker::functionsAvailable(self::POSIX_FUNCTIONS);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Verify that all required pcntl functions are, in fact, available.
<<<<<<< HEAD
     */
    public static function isPcntlSupported(): bool
    {
        foreach (self::$pcntlFunctions as $func) {
            if (!\function_exists($func)) {
                return false;
            }
        }

        return true;
=======
     *
     * @deprecated
     */
    public static function isPcntlSupported(): bool
    {
        return DependencyChecker::functionsAvailable(self::PCNTL_FUNCTIONS);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Check whether required pcntl functions are disabled.
<<<<<<< HEAD
     */
    public static function disabledPcntlFunctions()
    {
        return self::checkDisabledFunctions(self::$pcntlFunctions);
=======
     *
     * @deprecated
     */
    public static function disabledPcntlFunctions()
    {
        return DependencyChecker::functionsDisabled(self::PCNTL_FUNCTIONS);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Verify that all required posix functions are, in fact, available.
<<<<<<< HEAD
     */
    public static function isPosixSupported(): bool
    {
        foreach (self::$posixFunctions as $func) {
            if (!\function_exists($func)) {
                return false;
            }
        }

        return true;
=======
     *
     * @deprecated
     */
    public static function isPosixSupported(): bool
    {
        return DependencyChecker::functionsAvailable(self::POSIX_FUNCTIONS);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Check whether required posix functions are disabled.
<<<<<<< HEAD
     */
    public static function disabledPosixFunctions()
    {
        return self::checkDisabledFunctions(self::$posixFunctions);
    }

    private static function checkDisabledFunctions(array $functions): array
    {
        return \array_values(\array_intersect($functions, \array_map('strtolower', \array_map('trim', \explode(',', \ini_get('disable_functions'))))));
=======
     *
     * @deprecated
     */
    public static function disabledPosixFunctions()
    {
        return DependencyChecker::functionsDisabled(self::POSIX_FUNCTIONS);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Forks into a main and a loop process.
     *
     * The loop process will handle the evaluation of all instructions, then
     * return its state via a socket upon completion.
     *
     * @param Shell $shell
     */
    public function beforeRun(Shell $shell)
    {
<<<<<<< HEAD
        list($up, $down) = \stream_socket_pair(\STREAM_PF_UNIX, \STREAM_SOCK_STREAM, \STREAM_IPPROTO_IP);

=======
        // Temporarily disable socket timeout for IPC sockets, to avoid losing our child process
        // communication after 60 seconds.
        $originalTimeout = @\ini_set('default_socket_timeout', '-1');

        list($up, $down) = \stream_socket_pair(\STREAM_PF_UNIX, \STREAM_SOCK_STREAM, \STREAM_IPPROTO_IP);

        if ($originalTimeout !== false) {
            @\ini_set('default_socket_timeout', $originalTimeout);
        }

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        if (!$up) {
            throw new \RuntimeException('Unable to create socket pair');
        }

        $pid = \pcntl_fork();
        if ($pid < 0) {
            throw new \RuntimeException('Unable to start execution loop');
        } elseif ($pid > 0) {
<<<<<<< HEAD
            // This is the main thread. We'll just wait for a while.
=======
            // This is the main (parent) process. Install SIGINT handler and wait for child.
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

            // We won't be needing this one.
            \fclose($up);

<<<<<<< HEAD
=======
            // Install SIGINT handler in parent to interrupt child
            \pcntl_async_signals(true);
            $interrupted = false;
            $sigintHandlerInstalled = \pcntl_signal(\SIGINT, function () use (&$interrupted, $pid) {
                $interrupted = true;
                // Send SIGINT to child so it can handle interruption gracefully
                \posix_kill($pid, \SIGINT);
            });

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            // Wait for a return value from the loop process.
            $read = [$down];
            $write = null;
            $except = null;

            do {
<<<<<<< HEAD
=======
                if ($interrupted) {
                    // Wait for child to exit (it should handle SIGINT gracefully)
                    \pcntl_waitpid($pid, $status);

                    // Try to read any final output from child before it exited
                    $content = @\stream_get_contents($down);
                    \fclose($down);

                    if ($sigintHandlerInstalled) {
                        \pcntl_signal(\SIGINT, \SIG_DFL);
                    }

                    $this->clearStdinBuffer();

                    // Restore scope variables and exit code if child sent any
                    // If child didn't send data, use the actual process exit status
                    $exitCode = \pcntl_wexitstatus($status);
                    if ($content) {
                        $data = @\unserialize($content);
                        if (\is_array($data) && isset($data['exitCode'], $data['scopeVars'])) {
                            $exitCode = $data['exitCode'];
                            $shell->setScopeVariables($data['scopeVars']);
                        }
                    }

                    throw new BreakException('Exiting main thread', $exitCode);
                }

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
                $n = @\stream_select($read, $write, $except, null);

                if ($n === 0) {
                    throw new \RuntimeException('Process timed out waiting for execution loop');
                }

                if ($n === false) {
                    $err = \error_get_last();
                    if (!isset($err['message']) || \stripos($err['message'], 'interrupted system call') === false) {
                        $msg = $err['message'] ?
                            \sprintf('Error waiting for execution loop: %s', $err['message']) :
                            'Error waiting for execution loop';
                        throw new \RuntimeException($msg);
                    }
                }
            } while ($n < 1);

            $content = \stream_get_contents($down);
            \fclose($down);

<<<<<<< HEAD
            if ($content) {
                $shell->setScopeVariables(@\unserialize($content));
            }

            throw new BreakException('Exiting main thread');
=======
            // Wait for child to exit and get its exit status
            \pcntl_waitpid($pid, $status);

            // Restore default SIGINT handler
            if ($sigintHandlerInstalled) {
                \pcntl_signal(\SIGINT, \SIG_DFL);
            }

            // If child didn't send data, use the actual process exit status
            $exitCode = \pcntl_wexitstatus($status);
            if ($content) {
                $data = @\unserialize($content);
                if (\is_array($data) && isset($data['exitCode'], $data['scopeVars'])) {
                    $exitCode = $data['exitCode'];
                    $shell->setScopeVariables($data['scopeVars']);
                }
            }

            throw new BreakException('Exiting main thread', $exitCode);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        }

        // This is the child process. It's going to do all the work.
        if (!@\cli_set_process_title('psysh (loop)')) {
            // Fall back to `setproctitle` if that wasn't succesful.
            if (\function_exists('setproctitle')) {
                @\setproctitle('psysh (loop)');
            }
        }

        // We won't be needing this one.
        \fclose($down);

        // Save this; we'll need to close it in `afterRun`
        $this->up = $up;
    }

    /**
<<<<<<< HEAD
=======
     * Install SIGINT handler before executing user code.
     */
    public function onExecute(Shell $shell, string $code)
    {
        // Only handle SIGINT in the child process
        if (isset($this->up)) {
            // Ensure signal processing is enabled so Ctrl-C can interrupt execution
            if (@\posix_isatty(\STDIN)) {
                @\shell_exec('stty isig 2>/dev/null');
                $this->restoreStty = true;
            }

            \pcntl_async_signals(true);

            // Install SIGINT handler that throws exception during execution
            \pcntl_signal(\SIGINT, function () {
                throw new InterruptException('Ctrl+C');
            });
        }

        return null;
    }

    /**
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * Create a savegame at the start of each loop iteration.
     *
     * @param Shell $shell
     */
    public function beforeLoop(Shell $shell)
    {
        $this->createSavegame();
    }

    /**
     * Clean up old savegames at the end of each loop iteration.
     *
<<<<<<< HEAD
     * @param Shell $shell
     */
    public function afterLoop(Shell $shell)
    {
=======
     * Restores terminal state and clears stdin if execution was interrupted.
     */
    public function afterLoop(Shell $shell)
    {
        // Only handle cleanup in child process
        if (isset($this->up)) {
            // Restore default SIGINT handler after execution
            if (!$this->sigintHandlerInstalled) {
                \pcntl_signal(\SIGINT, \SIG_DFL);
            }

            // Restore terminal to raw mode after execution
            // This prevents Ctrl-C at the prompt from generating SIGINT
            if ($this->restoreStty) {
                @\shell_exec('stty -isig 2>/dev/null');
                $this->restoreStty = false;
            }
        }

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        // if there's an old savegame hanging around, let's kill it.
        if (isset($this->savegame)) {
            \posix_kill($this->savegame, \SIGKILL);
            \pcntl_signal_dispatch();
        }
    }

    /**
     * After the REPL session ends, send the scope variables back up to the main
     * thread (if this is a child thread).
     *
<<<<<<< HEAD
     * @param Shell $shell
     */
    public function afterRun(Shell $shell)
    {
        // We're a child thread. Send the scope variables back up to the main thread.
        if (isset($this->up)) {
            \fwrite($this->up, $this->serializeReturn($shell->getScopeVariables(false)));
            \fclose($this->up);
=======
     * {@inheritdoc}
     */
    public function afterRun(Shell $shell, int $exitCode = 0)
    {
        // We're a child thread. Send the scope variables and exit code back up to the main thread.
        if (isset($this->up)) {
            $data = $this->serializeReturn($exitCode, $shell->getScopeVariables(false));

            // Suppress errors in case the pipe is broken (e.g., if parent was interrupted)
            @\fwrite($this->up, $data);
            @\fclose($this->up);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

            \posix_kill(\posix_getpid(), \SIGKILL);
        }
    }

    /**
     * Create a savegame fork.
     *
     * The savegame contains the current execution state, and can be resumed in
     * the event that the worker dies unexpectedly (for example, by encountering
     * a PHP fatal error).
     */
    private function createSavegame()
    {
        // the current process will become the savegame
        $this->savegame = \posix_getpid();

        $pid = \pcntl_fork();
        if ($pid < 0) {
            throw new \RuntimeException('Unable to create savegame fork');
        } elseif ($pid > 0) {
            // we're the savegame now... let's wait and see what happens
            \pcntl_waitpid($pid, $status);

            // worker exited cleanly, let's bail
            if (!\pcntl_wexitstatus($status)) {
                \posix_kill(\posix_getpid(), \SIGKILL);
            }

            // worker didn't exit cleanly, we'll need to have another go
<<<<<<< HEAD
=======
            // @phan-suppress-next-line PhanPossiblyInfiniteRecursionSameParams - recursion exits via posix_kill above
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            $this->createSavegame();
        }
    }

    /**
<<<<<<< HEAD
     * Serialize all serializable return values.
=======
     * Clear stdin buffer after interruption, in case SIGINT left the stream in a bad state.
     */
    private function clearStdinBuffer(): void
    {
        if (!\defined('STDIN') || !\is_resource(\STDIN)) {
            return;
        }

        // Check if the stream is still usable
        $meta = @\stream_get_meta_data(\STDIN);
        if (!$meta || ($meta['eof'] ?? false)) {
            return;
        }

        // Drain any buffered input, suppressing I/O errors
        @\stream_set_blocking(\STDIN, false);
        while (@\fgetc(\STDIN) !== false) {
        }
        @\stream_set_blocking(\STDIN, true);
    }

    /**
     * Serialize exit code and scope variables for transmission to parent process.
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     *
     * A naïve serialization will run into issues if there is a Closure or
     * SimpleXMLElement (among other things) in scope when exiting the execution
     * loop. We'll just ignore these unserializable classes, and serialize what
     * we can.
     *
<<<<<<< HEAD
     * @param array $return
     */
    private function serializeReturn(array $return): string
    {
        $serializable = [];

        foreach ($return as $key => $value) {
=======
     * @param int   $exitCode  Exit code from the child process
     * @param array $scopeVars Scope variables to serialize
     *
     * @return string Serialized data array containing exitCode and scopeVars
     */
    private function serializeReturn(int $exitCode, array $scopeVars): string
    {
        $serializable = [];

        foreach ($scopeVars as $key => $value) {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            // No need to return magic variables
            if (Context::isSpecialVariableName($key)) {
                continue;
            }

            // Resources and Closures don't error, but they don't serialize well either.
            if (\is_resource($value) || $value instanceof \Closure) {
                continue;
            }

<<<<<<< HEAD
            if (\version_compare(\PHP_VERSION, '8.1', '>=') && $value instanceof \UnitEnum) {
=======
            if (\PHP_VERSION_ID >= 80100 && $value instanceof \UnitEnum) {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
                // Enums defined in the REPL session can't be unserialized.
                $ref = new \ReflectionObject($value);
                if (\strpos($ref->getFileName(), ": eval()'d code") !== false) {
                    continue;
                }
            }

            try {
                @\serialize($value);
                $serializable[$key] = $value;
            } catch (\Throwable $e) {
                // we'll just ignore this one...
            }
        }

<<<<<<< HEAD
        return @\serialize($serializable);
=======
        return @\serialize([
            'exitCode'  => $exitCode,
            'scopeVars' => $serializable,
        ]);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }
}
