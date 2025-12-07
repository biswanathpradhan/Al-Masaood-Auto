<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node;

<<<<<<< HEAD
class Echo_ extends Node\Stmt
{
    /** @var Node\Expr[] Expressions */
    public $exprs;
=======
class Echo_ extends Node\Stmt {
    /** @var Node\Expr[] Expressions */
    public array $exprs;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Constructs an echo node.
     *
<<<<<<< HEAD
     * @param Node\Expr[] $exprs      Expressions
     * @param array       $attributes Additional attributes
=======
     * @param Node\Expr[] $exprs Expressions
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function __construct(array $exprs, array $attributes = []) {
        $this->attributes = $attributes;
        $this->exprs = $exprs;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['exprs'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['exprs'];
    }

    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Stmt_Echo';
    }
}
