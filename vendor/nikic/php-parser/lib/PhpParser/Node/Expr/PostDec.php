<?php declare(strict_types=1);

namespace PhpParser\Node\Expr;

use PhpParser\Node\Expr;

<<<<<<< HEAD
class PostDec extends Expr
{
    /** @var Expr Variable */
    public $var;
=======
class PostDec extends Expr {
    /** @var Expr Variable */
    public Expr $var;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Constructs a post decrement node.
     *
<<<<<<< HEAD
     * @param Expr  $var        Variable
     * @param array $attributes Additional attributes
=======
     * @param Expr $var Variable
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function __construct(Expr $var, array $attributes = []) {
        $this->attributes = $attributes;
        $this->var = $var;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['var'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['var'];
    }

    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Expr_PostDec';
    }
}
