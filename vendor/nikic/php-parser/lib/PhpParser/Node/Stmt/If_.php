<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node;

<<<<<<< HEAD
class If_ extends Node\Stmt
{
    /** @var Node\Expr Condition expression */
    public $cond;
    /** @var Node\Stmt[] Statements */
    public $stmts;
    /** @var ElseIf_[] Elseif clauses */
    public $elseifs;
    /** @var null|Else_ Else clause */
    public $else;
=======
class If_ extends Node\Stmt {
    /** @var Node\Expr Condition expression */
    public Node\Expr $cond;
    /** @var Node\Stmt[] Statements */
    public array $stmts;
    /** @var ElseIf_[] Elseif clauses */
    public array $elseifs;
    /** @var null|Else_ Else clause */
    public ?Else_ $else;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Constructs an if node.
     *
<<<<<<< HEAD
     * @param Node\Expr $cond       Condition
     * @param array     $subNodes   Array of the following optional subnodes:
     *                              'stmts'   => array(): Statements
     *                              'elseifs' => array(): Elseif clauses
     *                              'else'    => null   : Else clause
     * @param array     $attributes Additional attributes
=======
     * @param Node\Expr $cond Condition
     * @param array{
     *     stmts?: Node\Stmt[],
     *     elseifs?: ElseIf_[],
     *     else?: Else_|null,
     * } $subNodes Array of the following optional subnodes:
     *             'stmts'   => array(): Statements
     *             'elseifs' => array(): Elseif clauses
     *             'else'    => null   : Else clause
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function __construct(Node\Expr $cond, array $subNodes = [], array $attributes = []) {
        $this->attributes = $attributes;
        $this->cond = $cond;
        $this->stmts = $subNodes['stmts'] ?? [];
        $this->elseifs = $subNodes['elseifs'] ?? [];
        $this->else = $subNodes['else'] ?? null;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['cond', 'stmts', 'elseifs', 'else'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['cond', 'stmts', 'elseifs', 'else'];
    }

    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Stmt_If';
    }
}
