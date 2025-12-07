<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node;

<<<<<<< HEAD
class Case_ extends Node\Stmt
{
    /** @var null|Node\Expr Condition (null for default) */
    public $cond;
    /** @var Node\Stmt[] Statements */
    public $stmts;
=======
class Case_ extends Node\Stmt {
    /** @var null|Node\Expr Condition (null for default) */
    public ?Node\Expr $cond;
    /** @var Node\Stmt[] Statements */
    public array $stmts;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Constructs a case node.
     *
<<<<<<< HEAD
     * @param null|Node\Expr $cond       Condition (null for default)
     * @param Node\Stmt[]    $stmts      Statements
     * @param array          $attributes Additional attributes
     */
    public function __construct($cond, array $stmts = [], array $attributes = []) {
=======
     * @param null|Node\Expr $cond Condition (null for default)
     * @param Node\Stmt[] $stmts Statements
     * @param array<string, mixed> $attributes Additional attributes
     */
    public function __construct(?Node\Expr $cond, array $stmts = [], array $attributes = []) {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        $this->attributes = $attributes;
        $this->cond = $cond;
        $this->stmts = $stmts;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['cond', 'stmts'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['cond', 'stmts'];
    }

    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Stmt_Case';
    }
}
