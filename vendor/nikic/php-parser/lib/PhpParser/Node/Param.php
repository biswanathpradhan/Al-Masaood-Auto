<?php declare(strict_types=1);

namespace PhpParser\Node;

<<<<<<< HEAD
use PhpParser\NodeAbstract;

class Param extends NodeAbstract
{
    /** @var null|Identifier|Name|ComplexType Type declaration */
    public $type;
    /** @var bool Whether parameter is passed by reference */
    public $byRef;
    /** @var bool Whether this is a variadic argument */
    public $variadic;
    /** @var Expr\Variable|Expr\Error Parameter variable */
    public $var;
    /** @var null|Expr Default value */
    public $default;
    /** @var int */
    public $flags;
    /** @var AttributeGroup[] PHP attribute groups */
    public $attrGroups;
=======
use PhpParser\Modifiers;
use PhpParser\Node;
use PhpParser\NodeAbstract;

class Param extends NodeAbstract {
    /** @var null|Identifier|Name|ComplexType Type declaration */
    public ?Node $type;
    /** @var bool Whether parameter is passed by reference */
    public bool $byRef;
    /** @var bool Whether this is a variadic argument */
    public bool $variadic;
    /** @var Expr\Variable|Expr\Error Parameter variable */
    public Expr $var;
    /** @var null|Expr Default value */
    public ?Expr $default;
    /** @var int Optional visibility flags */
    public int $flags;
    /** @var AttributeGroup[] PHP attribute groups */
    public array $attrGroups;
    /** @var PropertyHook[] Property hooks for promoted properties */
    public array $hooks;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Constructs a parameter node.
     *
<<<<<<< HEAD
     * @param Expr\Variable|Expr\Error                $var        Parameter variable
     * @param null|Expr                               $default    Default value
     * @param null|string|Identifier|Name|ComplexType $type       Type declaration
     * @param bool                                    $byRef      Whether is passed by reference
     * @param bool                                    $variadic   Whether this is a variadic argument
     * @param array                                   $attributes Additional attributes
     * @param int                                     $flags      Optional visibility flags
     * @param AttributeGroup[]                        $attrGroups PHP attribute groups
     */
    public function __construct(
        $var, ?Expr $default = null, $type = null,
        bool $byRef = false, bool $variadic = false,
        array $attributes = [],
        int $flags = 0,
        array $attrGroups = []
    ) {
        $this->attributes = $attributes;
        $this->type = \is_string($type) ? new Identifier($type) : $type;
=======
     * @param Expr\Variable|Expr\Error $var Parameter variable
     * @param null|Expr $default Default value
     * @param null|Identifier|Name|ComplexType $type Type declaration
     * @param bool $byRef Whether is passed by reference
     * @param bool $variadic Whether this is a variadic argument
     * @param array<string, mixed> $attributes Additional attributes
     * @param int $flags Optional visibility flags
     * @param list<AttributeGroup> $attrGroups PHP attribute groups
     * @param PropertyHook[] $hooks Property hooks for promoted properties
     */
    public function __construct(
        Expr $var, ?Expr $default = null, ?Node $type = null,
        bool $byRef = false, bool $variadic = false,
        array $attributes = [],
        int $flags = 0,
        array $attrGroups = [],
        array $hooks = []
    ) {
        $this->attributes = $attributes;
        $this->type = $type;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        $this->byRef = $byRef;
        $this->variadic = $variadic;
        $this->var = $var;
        $this->default = $default;
        $this->flags = $flags;
        $this->attrGroups = $attrGroups;
<<<<<<< HEAD
    }

    public function getSubNodeNames() : array {
        return ['attrGroups', 'flags', 'type', 'byRef', 'variadic', 'var', 'default'];
    }

    public function getType() : string {
        return 'Param';
    }
=======
        $this->hooks = $hooks;
    }

    public function getSubNodeNames(): array {
        return ['attrGroups', 'flags', 'type', 'byRef', 'variadic', 'var', 'default', 'hooks'];
    }

    public function getType(): string {
        return 'Param';
    }

    /**
     * Whether this parameter uses constructor property promotion.
     */
    public function isPromoted(): bool {
        return $this->flags !== 0 || $this->hooks !== [];
    }

    public function isFinal(): bool {
        return (bool) ($this->flags & Modifiers::FINAL);
    }

    public function isPublic(): bool {
        $public = (bool) ($this->flags & Modifiers::PUBLIC);
        if ($public) {
            return true;
        }

        if (!$this->isPromoted()) {
            return false;
        }

        return ($this->flags & Modifiers::VISIBILITY_MASK) === 0;
    }

    public function isProtected(): bool {
        return (bool) ($this->flags & Modifiers::PROTECTED);
    }

    public function isPrivate(): bool {
        return (bool) ($this->flags & Modifiers::PRIVATE);
    }

    public function isReadonly(): bool {
        return (bool) ($this->flags & Modifiers::READONLY);
    }

    /**
     * Whether the promoted property has explicit public(set) visibility.
     */
    public function isPublicSet(): bool {
        return (bool) ($this->flags & Modifiers::PUBLIC_SET);
    }

    /**
     * Whether the promoted property has explicit protected(set) visibility.
     */
    public function isProtectedSet(): bool {
        return (bool) ($this->flags & Modifiers::PROTECTED_SET);
    }

    /**
     * Whether the promoted property has explicit private(set) visibility.
     */
    public function isPrivateSet(): bool {
        return (bool) ($this->flags & Modifiers::PRIVATE_SET);
    }
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
}
