<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node;

/**
 * Represents statements of type "expr;"
 */
<<<<<<< HEAD
class Expression extends Node\Stmt
{
    /** @var Node\Expr Expression */
    public $expr;
=======
class Expression extends Node\Stmt {
    /** @var Node\Expr Expression */
    public Node\Expr $expr;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Constructs an expression statement.
     *
<<<<<<< HEAD
     * @param Node\Expr $expr       Expression
     * @param array     $attributes Additional attributes
=======
     * @param Node\Expr $expr Expression
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function __construct(Node\Expr $expr, array $attributes = []) {
        $this->attributes = $attributes;
        $this->expr = $expr;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['expr'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['expr'];
    }

    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Stmt_Expression';
    }
}
