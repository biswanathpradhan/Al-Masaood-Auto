<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node;

<<<<<<< HEAD
class Finally_ extends Node\Stmt
{
    /** @var Node\Stmt[] Statements */
    public $stmts;
=======
class Finally_ extends Node\Stmt {
    /** @var Node\Stmt[] Statements */
    public array $stmts;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Constructs a finally node.
     *
<<<<<<< HEAD
     * @param Node\Stmt[] $stmts      Statements
     * @param array       $attributes Additional attributes
=======
     * @param Node\Stmt[] $stmts Statements
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function __construct(array $stmts = [], array $attributes = []) {
        $this->attributes = $attributes;
        $this->stmts = $stmts;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['stmts'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['stmts'];
    }

    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Stmt_Finally';
    }
}
