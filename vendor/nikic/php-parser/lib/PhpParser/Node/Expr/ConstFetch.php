<?php declare(strict_types=1);

namespace PhpParser\Node\Expr;

use PhpParser\Node\Expr;
use PhpParser\Node\Name;

<<<<<<< HEAD
class ConstFetch extends Expr
{
    /** @var Name Constant name */
    public $name;
=======
class ConstFetch extends Expr {
    /** @var Name Constant name */
    public Name $name;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Constructs a const fetch node.
     *
<<<<<<< HEAD
     * @param Name  $name       Constant name
     * @param array $attributes Additional attributes
=======
     * @param Name $name Constant name
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function __construct(Name $name, array $attributes = []) {
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
        return 'Expr_ConstFetch';
    }
}
