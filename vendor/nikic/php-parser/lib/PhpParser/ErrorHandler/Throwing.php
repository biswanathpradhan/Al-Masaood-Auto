<?php declare(strict_types=1);

namespace PhpParser\ErrorHandler;

use PhpParser\Error;
use PhpParser\ErrorHandler;

/**
 * Error handler that handles all errors by throwing them.
 *
 * This is the default strategy used by all components.
 */
<<<<<<< HEAD
class Throwing implements ErrorHandler
{
    public function handleError(Error $error) {
=======
class Throwing implements ErrorHandler {
    public function handleError(Error $error): void {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        throw $error;
    }
}
