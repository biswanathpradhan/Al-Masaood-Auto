<?php

/**
 * This file is part of the ramsey/collection library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Ben Ramsey <ben@benramsey.com>
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Ramsey\Collection\Exception;

<<<<<<< HEAD
/**
 * Thrown when attempting to access an element that does not exist.
 */
class NoSuchElementException extends \RuntimeException
=======
use RuntimeException;

/**
 * Thrown when attempting to access an element that does not exist.
 */
class NoSuchElementException extends RuntimeException
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
{
}
