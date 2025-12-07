<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node;

<<<<<<< HEAD
class Continue_ extends Node\Stmt
{
    /** @var null|Node\Expr Number of loops to continue */
    public $num;
=======
class Continue_ extends Node\Stmt {
    /** @var null|Node\Expr Number of loops to continue */
    public ?Node\Expr $num;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Constructs a continue node.
     *
<<<<<<< HEAD
     * @param null|Node\Expr $num        Number of loops to continue
     * @param array          $attributes Additional attributes
=======
     * @param null|Node\Expr $num Number of loops to continue
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function __construct(?Node\Expr $num = null, array $attributes = []) {
        $this->attributes = $attributes;
        $this->num = $num;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['num'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['num'];
    }

    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Stmt_Continue';
    }
}
