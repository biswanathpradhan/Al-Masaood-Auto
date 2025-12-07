<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node;

<<<<<<< HEAD
class Namespace_ extends Node\Stmt
{
    /* For use in the "kind" attribute */
    const KIND_SEMICOLON = 1;
    const KIND_BRACED = 2;

    /** @var null|Node\Name Name */
    public $name;
=======
class Namespace_ extends Node\Stmt {
    /* For use in the "kind" attribute */
    public const KIND_SEMICOLON = 1;
    public const KIND_BRACED = 2;

    /** @var null|Node\Name Name */
    public ?Node\Name $name;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    /** @var Node\Stmt[] Statements */
    public $stmts;

    /**
     * Constructs a namespace node.
     *
<<<<<<< HEAD
     * @param null|Node\Name   $name       Name
     * @param null|Node\Stmt[] $stmts      Statements
     * @param array            $attributes Additional attributes
     */
    public function __construct(?Node\Name $name = null, $stmts = [], array $attributes = []) {
=======
     * @param null|Node\Name $name Name
     * @param null|Node\Stmt[] $stmts Statements
     * @param array<string, mixed> $attributes Additional attributes
     */
    public function __construct(?Node\Name $name = null, ?array $stmts = [], array $attributes = []) {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        $this->attributes = $attributes;
        $this->name = $name;
        $this->stmts = $stmts;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['name', 'stmts'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['name', 'stmts'];
    }

    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Stmt_Namespace';
    }
}
