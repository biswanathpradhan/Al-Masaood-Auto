<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node;

<<<<<<< HEAD
class Switch_ extends Node\Stmt
{
    /** @var Node\Expr Condition */
    public $cond;
    /** @var Case_[] Case list */
    public $cases;
=======
class Switch_ extends Node\Stmt {
    /** @var Node\Expr Condition */
    public Node\Expr $cond;
    /** @var Case_[] Case list */
    public array $cases;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Constructs a case node.
     *
<<<<<<< HEAD
     * @param Node\Expr $cond       Condition
     * @param Case_[]   $cases      Case list
     * @param array     $attributes Additional attributes
=======
     * @param Node\Expr $cond Condition
     * @param Case_[] $cases Case list
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function __construct(Node\Expr $cond, array $cases, array $attributes = []) {
        $this->attributes = $attributes;
        $this->cond = $cond;
        $this->cases = $cases;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['cond', 'cases'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['cond', 'cases'];
    }

    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Stmt_Switch';
    }
}
