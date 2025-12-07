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

namespace Ramsey\Collection;

use Ramsey\Collection\Exception\InvalidArgumentException;
use Ramsey\Collection\Exception\NoSuchElementException;
use Ramsey\Collection\Tool\TypeTrait;
use Ramsey\Collection\Tool\ValueToStringTrait;

/**
 * This class provides a basic implementation of `QueueInterface`, to minimize
 * the effort required to implement this interface.
 *
 * @template T
<<<<<<< HEAD
 * @template-extends AbstractArray<T>
 * @template-implements QueueInterface<T>
=======
 * @extends AbstractArray<T>
 * @implements QueueInterface<T>
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
 */
class Queue extends AbstractArray implements QueueInterface
{
    use TypeTrait;
    use ValueToStringTrait;

    /**
     * The type of elements stored in this queue.
     *
     * A queue's type is immutable once it is set. For this reason, this
     * property is set private.
<<<<<<< HEAD
     *
     * @var string
     */
    private $queueType;

    /**
     * The index of the head of the queue.
     *
     * @var int
     */
    protected $index = 0;
=======
     */
    private string $queueType;

    /**
     * The index of the head of the queue.
     */
    protected int $index = 0;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Constructs a queue object of the specified type, optionally with the
     * specified data.
     *
     * @param string $queueType The type (FQCN) associated with this queue.
     * @param array<array-key, T> $data The initial items to store in the collection.
     */
    public function __construct(string $queueType, array $data = [])
    {
        $this->queueType = $queueType;
        parent::__construct($data);
    }

    /**
     * {@inheritDoc}
     *
     * Since arbitrary offsets may not be manipulated in a queue, this method
     * serves only to fulfill the `ArrayAccess` interface requirements. It is
     * invoked by other operations when adding values to the queue.
<<<<<<< HEAD
=======
     *
     * @throws InvalidArgumentException if $value is of the wrong type
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function offsetSet($offset, $value): void
    {
        if ($this->checkType($this->getType(), $value) === false) {
            throw new InvalidArgumentException(
                'Value must be of type ' . $this->getType() . '; value is '
<<<<<<< HEAD
                . $this->toolValueToString($value)
=======
                . $this->toolValueToString($value),
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            );
        }

        $this->data[] = $value;
    }

    /**
<<<<<<< HEAD
=======
     * @throws InvalidArgumentException if $value is of the wrong type
     *
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * @inheritDoc
     */
    public function add($element): bool
    {
        $this[] = $element;

        return true;
    }

    /**
     * @inheritDoc
     */
    public function element()
    {
        $element = $this->peek();

        if ($element === null) {
            throw new NoSuchElementException(
<<<<<<< HEAD
                'Can\'t return element from Queue. Queue is empty.'
=======
                'Can\'t return element from Queue. Queue is empty.',
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            );
        }

        return $element;
    }

    /**
     * @inheritDoc
     */
    public function offer($element): bool
    {
        try {
            return $this->add($element);
        } catch (InvalidArgumentException $e) {
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function peek()
    {
        if ($this->count() === 0) {
            return null;
        }

        return $this[$this->index];
    }

    /**
     * @inheritDoc
     */
    public function poll()
    {
        if ($this->count() === 0) {
            return null;
        }

        $head = $this[$this->index];

        unset($this[$this->index]);
        $this->index++;

        return $head;
    }

    /**
     * @inheritDoc
     */
    public function remove()
    {
        $head = $this->poll();

        if ($head === null) {
            throw new NoSuchElementException('Can\'t return element from Queue. Queue is empty.');
        }

        return $head;
    }

    public function getType(): string
    {
        return $this->queueType;
    }
}
