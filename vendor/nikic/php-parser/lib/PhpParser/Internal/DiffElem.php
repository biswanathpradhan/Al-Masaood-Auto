<?php declare(strict_types=1);

namespace PhpParser\Internal;

/**
 * @internal
 */
<<<<<<< HEAD
class DiffElem
{
    const TYPE_KEEP = 0;
    const TYPE_REMOVE = 1;
    const TYPE_ADD = 2;
    const TYPE_REPLACE = 3;

    /** @var int One of the TYPE_* constants */
    public $type;
=======
class DiffElem {
    public const TYPE_KEEP = 0;
    public const TYPE_REMOVE = 1;
    public const TYPE_ADD = 2;
    public const TYPE_REPLACE = 3;

    /** @var int One of the TYPE_* constants */
    public int $type;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    /** @var mixed Is null for add operations */
    public $old;
    /** @var mixed Is null for remove operations */
    public $new;

<<<<<<< HEAD
=======
    /**
     * @param int $type One of the TYPE_* constants
     * @param mixed $old Is null for add operations
     * @param mixed $new Is null for remove operations
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    public function __construct(int $type, $old, $new) {
        $this->type = $type;
        $this->old = $old;
        $this->new = $new;
    }
}
