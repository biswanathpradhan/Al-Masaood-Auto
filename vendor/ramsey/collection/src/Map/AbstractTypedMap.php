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

namespace Ramsey\Collection\Map;

use Ramsey\Collection\Exception\InvalidArgumentException;
use Ramsey\Collection\Tool\TypeTrait;
use Ramsey\Collection\Tool\ValueToStringTrait;

<<<<<<< HEAD
=======
use function var_export;

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
/**
 * This class provides a basic implementation of `TypedMapInterface`, to
 * minimize the effort required to implement this interface.
 *
<<<<<<< HEAD
 * @template K
 * @template T
 * @template-extends AbstractMap<T>
 * @template-implements TypedMapInterface<T>
=======
 * @template K of array-key
 * @template T
 * @extends AbstractMap<T>
 * @implements TypedMapInterface<T>
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
 */
abstract class AbstractTypedMap extends AbstractMap implements TypedMapInterface
{
    use TypeTrait;
    use ValueToStringTrait;

    /**
     * @param K|null $offset
     * @param T $value
     *
     * @inheritDoc
<<<<<<< HEAD
     *
     * @psalm-suppress MoreSpecificImplementedParamType
=======
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function offsetSet($offset, $value): void
    {
        if ($offset === null) {
            throw new InvalidArgumentException(
                'Map elements are key/value pairs; a key must be provided for '
<<<<<<< HEAD
                . 'value ' . var_export($value, true)
=======
                . 'value ' . var_export($value, true),
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            );
        }

        if ($this->checkType($this->getKeyType(), $offset) === false) {
            throw new InvalidArgumentException(
                'Key must be of type ' . $this->getKeyType() . '; key is '
<<<<<<< HEAD
                . $this->toolValueToString($offset)
=======
                . $this->toolValueToString($offset),
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            );
        }

        if ($this->checkType($this->getValueType(), $value) === false) {
            throw new InvalidArgumentException(
                'Value must be of type ' . $this->getValueType() . '; value is '
<<<<<<< HEAD
                . $this->toolValueToString($value)
            );
        }

        /** @psalm-suppress MixedArgumentTypeCoercion */
=======
                . $this->toolValueToString($value),
            );
        }

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        parent::offsetSet($offset, $value);
    }
}
