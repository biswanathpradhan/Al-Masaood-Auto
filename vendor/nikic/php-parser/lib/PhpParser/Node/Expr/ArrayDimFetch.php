<?php declare(strict_types=1);

namespace PhpParser\Node\Expr;

use PhpParser\Node\Expr;

<<<<<<< HEAD
class ArrayDimFetch extends Expr
{
    /** @var Expr Variable */
    public $var;
    /** @var null|Expr Array index / dim */
    public $dim;
=======
class ArrayDimFetch extends Expr {
    /** @var Expr Variable */
    public Expr $var;
    /** @var null|Expr Array index / dim */
    public ?Expr $dim;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Constructs an array index fetch node.
     *
<<<<<<< HEAD
     * @param Expr      $var        Variable
     * @param null|Expr $dim        Array index / dim
     * @param array     $attributes Additional attributes
=======
     * @param Expr $var Variable
     * @param null|Expr $dim Array index / dim
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function __construct(Expr $var, ?Expr $dim = null, array $attributes = []) {
        $this->attributes = $attributes;
        $this->var = $var;
        $this->dim = $dim;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['var', 'dim'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['var', 'dim'];
    }

    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Expr_ArrayDimFetch';
    }
}
