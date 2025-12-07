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
 * A "fatal error" Exception for Psy.
 */
class FatalErrorException extends \ErrorException implements Exception
{
<<<<<<< HEAD
    private $rawMessage;
=======
    private string $rawMessage;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Create a fatal error.
     *
     * @param string          $message  (default: "")
     * @param int             $code     (default: 0)
     * @param int             $severity (default: 1)
     * @param string|null     $filename (default: null)
     * @param int|null        $lineno   (default: null)
     * @param \Throwable|null $previous (default: null)
     */
<<<<<<< HEAD
    public function __construct($message = '', $code = 0, $severity = 1, $filename = null, $lineno = null, \Throwable $previous = null)
=======
    public function __construct($message = '', $code = 0, $severity = 1, $filename = null, $lineno = null, ?\Throwable $previous = null)
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    {
        // Since these are basically always PHP Parser Node line numbers, treat -1 as null.
        if ($lineno === -1) {
            $lineno = null;
        }

        $this->rawMessage = $message;
<<<<<<< HEAD
        $message = \sprintf('PHP Fatal error:  %s in %s on line %d', $message, $filename ?: "eval()'d code", $lineno);
        parent::__construct($message, $code, $severity, $filename, $lineno, $previous);
=======
        $message = \sprintf('PHP Fatal error:  %s in %s on line %d', $message, $filename ?: "eval()'d code", $lineno ?? 0);
        parent::__construct($message, $code, $severity, $filename ?? '', $lineno ?? 0, $previous);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Return a raw (unformatted) version of the error message.
     */
    public function getRawMessage(): string
    {
        return $this->rawMessage;
    }
}
