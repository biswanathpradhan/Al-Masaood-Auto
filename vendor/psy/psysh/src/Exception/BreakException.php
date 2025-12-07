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

namespace Psy\Exception;

/**
 * A break exception, used for halting the Psy Shell.
 */
class BreakException extends \Exception implements Exception
{
<<<<<<< HEAD
    private $rawMessage;
=======
    private string $rawMessage;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function __construct($message = '', $code = 0, \Throwable $previous = null)
=======
    public function __construct($message = '', $code = 0, ?\Throwable $previous = null)
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    {
        $this->rawMessage = $message;
        parent::__construct(\sprintf('Exit:  %s', $message), $code, $previous);
    }

    /**
     * Return a raw (unformatted) version of the error message.
     */
    public function getRawMessage(): string
    {
        return $this->rawMessage;
    }

    /**
     * Throws BreakException.
     *
     * Since `throw` can not be inserted into arbitrary expressions, it wraps with function call.
     *
<<<<<<< HEAD
     * @throws BreakException
     */
    public static function exitShell()
    {
        throw new self('Goodbye');
=======
     * @param int|string|null $status Exit status code or message
     *
     * @throws BreakException
     */
    public static function exitShell($status = 0)
    {
        throw new self(\is_string($status) ? $status : 'Goodbye', \is_int($status) ? $status : 0);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }
}
