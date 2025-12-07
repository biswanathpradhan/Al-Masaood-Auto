<?php declare(strict_types=1);

namespace PhpParser\Builder;

use PhpParser\Builder;
use PhpParser\BuilderHelpers;
<<<<<<< HEAD
use PhpParser\Node;
use PhpParser\Node\Stmt;

class TraitUseAdaptation implements Builder
{
    const TYPE_UNDEFINED  = 0;
    const TYPE_ALIAS      = 1;
    const TYPE_PRECEDENCE = 2;

    /** @var int Type of building adaptation */
    protected $type;

    protected $trait;
    protected $method;

    protected $modifier = null;
    protected $alias = null;

    protected $insteadof = [];
=======
use PhpParser\Modifiers;
use PhpParser\Node;
use PhpParser\Node\Stmt;

class TraitUseAdaptation implements Builder {
    private const TYPE_UNDEFINED  = 0;
    private const TYPE_ALIAS      = 1;
    private const TYPE_PRECEDENCE = 2;

    protected int $type;
    protected ?Node\Name $trait;
    protected Node\Identifier $method;
    protected ?int $modifier = null;
    protected ?Node\Identifier $alias = null;
    /** @var Node\Name[] */
    protected array $insteadof = [];
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Creates a trait use adaptation builder.
     *
<<<<<<< HEAD
     * @param Node\Name|string|null  $trait  Name of adaptated trait
     * @param Node\Identifier|string $method Name of adaptated method
=======
     * @param Node\Name|string|null $trait Name of adapted trait
     * @param Node\Identifier|string $method Name of adapted method
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function __construct($trait, $method) {
        $this->type = self::TYPE_UNDEFINED;

<<<<<<< HEAD
        $this->trait = is_null($trait)? null: BuilderHelpers::normalizeName($trait);
=======
        $this->trait = is_null($trait) ? null : BuilderHelpers::normalizeName($trait);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        $this->method = BuilderHelpers::normalizeIdentifier($method);
    }

    /**
     * Sets alias of method.
     *
<<<<<<< HEAD
     * @param Node\Identifier|string $alias Alias for adaptated method
=======
     * @param Node\Identifier|string $alias Alias for adapted method
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function as($alias) {
        if ($this->type === self::TYPE_UNDEFINED) {
            $this->type = self::TYPE_ALIAS;
        }

        if ($this->type !== self::TYPE_ALIAS) {
            throw new \LogicException('Cannot set alias for not alias adaptation buider');
        }

<<<<<<< HEAD
        $this->alias = $alias;
=======
        $this->alias = BuilderHelpers::normalizeIdentifier($alias);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return $this;
    }

    /**
<<<<<<< HEAD
     * Sets adaptated method public.
=======
     * Sets adapted method public.
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function makePublic() {
<<<<<<< HEAD
        $this->setModifier(Stmt\Class_::MODIFIER_PUBLIC);
=======
        $this->setModifier(Modifiers::PUBLIC);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return $this;
    }

    /**
<<<<<<< HEAD
     * Sets adaptated method protected.
=======
     * Sets adapted method protected.
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function makeProtected() {
<<<<<<< HEAD
        $this->setModifier(Stmt\Class_::MODIFIER_PROTECTED);
=======
        $this->setModifier(Modifiers::PROTECTED);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return $this;
    }

    /**
<<<<<<< HEAD
     * Sets adaptated method private.
=======
     * Sets adapted method private.
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function makePrivate() {
<<<<<<< HEAD
        $this->setModifier(Stmt\Class_::MODIFIER_PRIVATE);
=======
        $this->setModifier(Modifiers::PRIVATE);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return $this;
    }

    /**
     * Adds overwritten traits.
     *
     * @param Node\Name|string ...$traits Traits for overwrite
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function insteadof(...$traits) {
        if ($this->type === self::TYPE_UNDEFINED) {
            if (is_null($this->trait)) {
                throw new \LogicException('Precedence adaptation must have trait');
            }

            $this->type = self::TYPE_PRECEDENCE;
        }

        if ($this->type !== self::TYPE_PRECEDENCE) {
            throw new \LogicException('Cannot add overwritten traits for not precedence adaptation buider');
        }

        foreach ($traits as $trait) {
            $this->insteadof[] = BuilderHelpers::normalizeName($trait);
        }

        return $this;
    }

<<<<<<< HEAD
    protected function setModifier(int $modifier) {
=======
    protected function setModifier(int $modifier): void {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        if ($this->type === self::TYPE_UNDEFINED) {
            $this->type = self::TYPE_ALIAS;
        }

        if ($this->type !== self::TYPE_ALIAS) {
            throw new \LogicException('Cannot set access modifier for not alias adaptation buider');
        }

        if (is_null($this->modifier)) {
            $this->modifier = $modifier;
        } else {
            throw new \LogicException('Multiple access type modifiers are not allowed');
        }
    }

    /**
     * Returns the built node.
     *
     * @return Node The built node
     */
<<<<<<< HEAD
    public function getNode() : Node {
=======
    public function getNode(): Node {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        switch ($this->type) {
            case self::TYPE_ALIAS:
                return new Stmt\TraitUseAdaptation\Alias($this->trait, $this->method, $this->modifier, $this->alias);
            case self::TYPE_PRECEDENCE:
                return new Stmt\TraitUseAdaptation\Precedence($this->trait, $this->method, $this->insteadof);
            default:
                throw new \LogicException('Type of adaptation is not defined');
        }
    }
}
