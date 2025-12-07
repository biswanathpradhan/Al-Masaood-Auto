<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

<<<<<<< HEAD
use PhpParser\Node;

class ClassConst extends Node\Stmt
{
    /** @var int Modifiers */
    public $flags;
    /** @var Node\Const_[] Constant declarations */
    public $consts;
    /** @var Node\AttributeGroup[] PHP attribute groups */
    public $attrGroups;
    /** @var Node\Identifier|Node\Name|Node\ComplexType|null Type declaration */
    public $type;
=======
use PhpParser\Modifiers;
use PhpParser\Node;

class ClassConst extends Node\Stmt {
    /** @var int Modifiers */
    public int $flags;
    /** @var Node\Const_[] Constant declarations */
    public array $consts;
    /** @var Node\AttributeGroup[] PHP attribute groups */
    public array $attrGroups;
    /** @var Node\Identifier|Node\Name|Node\ComplexType|null Type declaration */
    public ?Node $type;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Constructs a class const list node.
     *
<<<<<<< HEAD
     * @param Node\Const_[]                                          $consts     Constant declarations
     * @param int                                                    $flags      Modifiers
     * @param array                                                  $attributes Additional attributes
     * @param Node\AttributeGroup[]                                  $attrGroups PHP attribute groups
     * @param null|string|Node\Identifier|Node\Name|Node\ComplexType $type       Type declaration
=======
     * @param Node\Const_[] $consts Constant declarations
     * @param int $flags Modifiers
     * @param array<string, mixed> $attributes Additional attributes
     * @param list<Node\AttributeGroup> $attrGroups PHP attribute groups
     * @param null|Node\Identifier|Node\Name|Node\ComplexType $type Type declaration
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function __construct(
        array $consts,
        int $flags = 0,
        array $attributes = [],
        array $attrGroups = [],
<<<<<<< HEAD
        $type = null
=======
        ?Node $type = null
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    ) {
        $this->attributes = $attributes;
        $this->flags = $flags;
        $this->consts = $consts;
        $this->attrGroups = $attrGroups;
<<<<<<< HEAD
        $this->type = \is_string($type) ? new Node\Identifier($type) : $type;
    }

    public function getSubNodeNames() : array {
=======
        $this->type = $type;
    }

    public function getSubNodeNames(): array {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return ['attrGroups', 'flags', 'type', 'consts'];
    }

    /**
     * Whether constant is explicitly or implicitly public.
<<<<<<< HEAD
     *
     * @return bool
     */
    public function isPublic() : bool {
        return ($this->flags & Class_::MODIFIER_PUBLIC) !== 0
            || ($this->flags & Class_::VISIBILITY_MODIFIER_MASK) === 0;
=======
     */
    public function isPublic(): bool {
        return ($this->flags & Modifiers::PUBLIC) !== 0
            || ($this->flags & Modifiers::VISIBILITY_MASK) === 0;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Whether constant is protected.
<<<<<<< HEAD
     *
     * @return bool
     */
    public function isProtected() : bool {
        return (bool) ($this->flags & Class_::MODIFIER_PROTECTED);
=======
     */
    public function isProtected(): bool {
        return (bool) ($this->flags & Modifiers::PROTECTED);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Whether constant is private.
<<<<<<< HEAD
     *
     * @return bool
     */
    public function isPrivate() : bool {
        return (bool) ($this->flags & Class_::MODIFIER_PRIVATE);
=======
     */
    public function isPrivate(): bool {
        return (bool) ($this->flags & Modifiers::PRIVATE);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Whether constant is final.
<<<<<<< HEAD
     *
     * @return bool
     */
    public function isFinal() : bool {
        return (bool) ($this->flags & Class_::MODIFIER_FINAL);
    }

    public function getType() : string {
=======
     */
    public function isFinal(): bool {
        return (bool) ($this->flags & Modifiers::FINAL);
    }

    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Stmt_ClassConst';
    }
}
