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
 * Thrown to indicate that the requested operation is not supported.
 */
class UnsupportedOperationException extends \RuntimeException
=======
use RuntimeException;

/**
 * Thrown to indicate that the requested operation is not supported.
 */
class UnsupportedOperationException extends RuntimeException
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
{
}
