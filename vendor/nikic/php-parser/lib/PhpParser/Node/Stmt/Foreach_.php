<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node;

<<<<<<< HEAD
class Foreach_ extends Node\Stmt
{
    /** @var Node\Expr Expression to iterate */
    public $expr;
    /** @var null|Node\Expr Variable to assign key to */
    public $keyVar;
    /** @var bool Whether to assign value by reference */
    public $byRef;
    /** @var Node\Expr Variable to assign value to */
    public $valueVar;
    /** @var Node\Stmt[] Statements */
    public $stmts;
=======
class Foreach_ extends Node\Stmt {
    /** @var Node\Expr Expression to iterate */
    public Node\Expr $expr;
    /** @var null|Node\Expr Variable to assign key to */
    public ?Node\Expr $keyVar;
    /** @var bool Whether to assign value by reference */
    public bool $byRef;
    /** @var Node\Expr Variable to assign value to */
    public Node\Expr $valueVar;
    /** @var Node\Stmt[] Statements */
    public array $stmts;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Constructs a foreach node.
     *
<<<<<<< HEAD
     * @param Node\Expr $expr       Expression to iterate
     * @param Node\Expr $valueVar   Variable to assign value to
     * @param array     $subNodes   Array of the following optional subnodes:
     *                              'keyVar' => null   : Variable to assign key to
     *                              'byRef'  => false  : Whether to assign value by reference
     *                              'stmts'  => array(): Statements
     * @param array     $attributes Additional attributes
=======
     * @param Node\Expr $expr Expression to iterate
     * @param Node\Expr $valueVar Variable to assign value to
     * @param array{
     *     keyVar?: Node\Expr|null,
     *     byRef?: bool,
     *     stmts?: Node\Stmt[],
     * } $subNodes Array of the following optional subnodes:
     *             'keyVar' => null   : Variable to assign key to
     *             'byRef'  => false  : Whether to assign value by reference
     *             'stmts'  => array(): Statements
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function __construct(Node\Expr $expr, Node\Expr $valueVar, array $subNodes = [], array $attributes = []) {
        $this->attributes = $attributes;
        $this->expr = $expr;
        $this->keyVar = $subNodes['keyVar'] ?? null;
        $this->byRef = $subNodes['byRef'] ?? false;
        $this->valueVar = $valueVar;
        $this->stmts = $subNodes['stmts'] ?? [];
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['expr', 'keyVar', 'byRef', 'valueVar', 'stmts'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['expr', 'keyVar', 'byRef', 'valueVar', 'stmts'];
    }

    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Stmt_Foreach';
    }
}
