<?php declare(strict_types=1);

namespace PhpParser\Node\Expr;

<<<<<<< HEAD
=======
use PhpParser\Node;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
use PhpParser\Node\Expr;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;

<<<<<<< HEAD
class ClassConstFetch extends Expr
{
    /** @var Name|Expr Class name */
    public $class;
    /** @var Identifier|Expr|Error Constant name */
    public $name;
=======
class ClassConstFetch extends Expr {
    /** @var Name|Expr Class name */
    public Node $class;
    /** @var Identifier|Expr|Error Constant name */
    public Node $name;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Constructs a class const fetch node.
     *
<<<<<<< HEAD
     * @param Name|Expr                    $class      Class name
     * @param string|Identifier|Expr|Error $name       Constant name
     * @param array                        $attributes Additional attributes
     */
    public function __construct($class, $name, array $attributes = []) {
=======
     * @param Name|Expr $class Class name
     * @param string|Identifier|Expr|Error $name Constant name
     * @param array<string, mixed> $attributes Additional attributes
     */
    public function __construct(Node $class, $name, array $attributes = []) {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        $this->attributes = $attributes;
        $this->class = $class;
        $this->name = \is_string($name) ? new Identifier($name) : $name;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['class', 'name'];
    }

    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['class', 'name'];
    }

    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Expr_ClassConstFetch';
    }
}
