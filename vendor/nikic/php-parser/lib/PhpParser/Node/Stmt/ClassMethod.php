<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

<<<<<<< HEAD
use PhpParser\Node;
use PhpParser\Node\FunctionLike;

class ClassMethod extends Node\Stmt implements FunctionLike
{
    /** @var int Flags */
    public $flags;
    /** @var bool Whether to return by reference */
    public $byRef;
    /** @var Node\Identifier Name */
    public $name;
    /** @var Node\Param[] Parameters */
    public $params;
    /** @var null|Node\Identifier|Node\Name|Node\ComplexType Return type */
    public $returnType;
    /** @var Node\Stmt[]|null Statements */
    public $stmts;
    /** @var Node\AttributeGroup[] PHP attribute groups */
    public $attrGroups;

    private static $magicNames = [
=======
use PhpParser\Modifiers;
use PhpParser\Node;
use PhpParser\Node\FunctionLike;

class ClassMethod extends Node\Stmt implements FunctionLike {
    /** @var int Flags */
    public int $flags;
    /** @var bool Whether to return by reference */
    public bool $byRef;
    /** @var Node\Identifier Name */
    public Node\Identifier $name;
    /** @var Node\Param[] Parameters */
    public array $params;
    /** @var null|Node\Identifier|Node\Name|Node\ComplexType Return type */
    public ?Node $returnType;
    /** @var Node\Stmt[]|null Statements */
    public ?array $stmts;
    /** @var Node\AttributeGroup[] PHP attribute groups */
    public array $attrGroups;

    /** @var array<string, bool> */
    private static array $magicNames = [
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        '__construct'   => true,
        '__destruct'    => true,
        '__call'        => true,
        '__callstatic'  => true,
        '__get'         => true,
        '__set'         => true,
        '__isset'       => true,
        '__unset'       => true,
        '__sleep'       => true,
        '__wakeup'      => true,
        '__tostring'    => true,
        '__set_state'   => true,
        '__clone'       => true,
        '__invoke'      => true,
        '__debuginfo'   => true,
        '__serialize'   => true,
        '__unserialize' => true,
    ];

    /**
     * Constructs a class method node.
     *
     * @param string|Node\Identifier $name Name
<<<<<<< HEAD
     * @param array $subNodes   Array of the following optional subnodes:
     *                          'flags       => MODIFIER_PUBLIC: Flags
     *                          'byRef'      => false          : Whether to return by reference
     *                          'params'     => array()        : Parameters
     *                          'returnType' => null           : Return type
     *                          'stmts'      => array()        : Statements
     *                          'attrGroups' => array()        : PHP attribute groups
     * @param array $attributes Additional attributes
=======
     * @param array{
     *     flags?: int,
     *     byRef?: bool,
     *     params?: Node\Param[],
     *     returnType?: null|Node\Identifier|Node\Name|Node\ComplexType,
     *     stmts?: Node\Stmt[]|null,
     *     attrGroups?: Node\AttributeGroup[],
     * } $subNodes Array of the following optional subnodes:
     *             'flags       => 0              : Flags
     *             'byRef'      => false          : Whether to return by reference
     *             'params'     => array()        : Parameters
     *             'returnType' => null           : Return type
     *             'stmts'      => array()        : Statements
     *             'attrGroups' => array()        : PHP attribute groups
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function __construct($name, array $subNodes = [], array $attributes = []) {
        $this->attributes = $attributes;
        $this->flags = $subNodes['flags'] ?? $subNodes['type'] ?? 0;
        $this->byRef = $subNodes['byRef'] ?? false;
        $this->name = \is_string($name) ? new Node\Identifier($name) : $name;
        $this->params = $subNodes['params'] ?? [];
<<<<<<< HEAD
        $returnType = $subNodes['returnType'] ?? null;
        $this->returnType = \is_string($returnType) ? new Node\Identifier($returnType) : $returnType;
=======
        $this->returnType = $subNodes['returnType'] ?? null;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        $this->stmts = array_key_exists('stmts', $subNodes) ? $subNodes['stmts'] : [];
        $this->attrGroups = $subNodes['attrGroups'] ?? [];
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['attrGroups', 'flags', 'byRef', 'name', 'params', 'returnType', 'stmts'];
    }

    public function returnsByRef() : bool {
        return $this->byRef;
    }

    public function getParams() : array {
=======
    public function getSubNodeNames(): array {
        return ['attrGroups', 'flags', 'byRef', 'name', 'params', 'returnType', 'stmts'];
    }

    public function returnsByRef(): bool {
        return $this->byRef;
    }

    public function getParams(): array {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return $this->params;
    }

    public function getReturnType() {
        return $this->returnType;
    }

<<<<<<< HEAD
    public function getStmts() {
        return $this->stmts;
    }

    public function getAttrGroups() : array {
=======
    public function getStmts(): ?array {
        return $this->stmts;
    }

    public function getAttrGroups(): array {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return $this->attrGroups;
    }

    /**
     * Whether the method is explicitly or implicitly public.
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
     * Whether the method is protected.
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
     * Whether the method is private.
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
     * Whether the method is abstract.
<<<<<<< HEAD
     *
     * @return bool
     */
    public function isAbstract() : bool {
        return (bool) ($this->flags & Class_::MODIFIER_ABSTRACT);
=======
     */
    public function isAbstract(): bool {
        return (bool) ($this->flags & Modifiers::ABSTRACT);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Whether the method is final.
<<<<<<< HEAD
     *
     * @return bool
     */
    public function isFinal() : bool {
        return (bool) ($this->flags & Class_::MODIFIER_FINAL);
=======
     */
    public function isFinal(): bool {
        return (bool) ($this->flags & Modifiers::FINAL);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Whether the method is static.
<<<<<<< HEAD
     *
     * @return bool
     */
    public function isStatic() : bool {
        return (bool) ($this->flags & Class_::MODIFIER_STATIC);
=======
     */
    public function isStatic(): bool {
        return (bool) ($this->flags & Modifiers::STATIC);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Whether the method is magic.
<<<<<<< HEAD
     *
     * @return bool
     */
    public function isMagic() : bool {
        return isset(self::$magicNames[$this->name->toLowerString()]);
    }

    public function getType() : string {
=======
     */
    public function isMagic(): bool {
        return isset(self::$magicNames[$this->name->toLowerString()]);
    }

    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Stmt_ClassMethod';
    }
}
