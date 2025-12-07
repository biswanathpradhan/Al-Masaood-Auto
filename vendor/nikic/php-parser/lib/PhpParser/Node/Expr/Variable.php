<?php declare(strict_types=1);

namespace PhpParser\Node\Expr;

use PhpParser\Node\Expr;

<<<<<<< HEAD
class Variable extends Expr
{
=======
class Variable extends Expr {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    /** @var string|Expr Name */
    public $name;

    /**
     * Constructs a variable node.
     *
<<<<<<< HEAD
     * @param string|Expr $name       Name
     * @param array       $attributes Additional attributes
=======
     * @param string|Expr $name Name
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function __construct($name, array $attributes = []) {
        $this->attributes = $attributes;
        $this->name = $name;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['name'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['name'];
    }

    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Expr_Variable';
    }
}
