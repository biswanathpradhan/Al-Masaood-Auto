<?php declare(strict_types=1);

namespace PhpParser\Node\Expr;

use PhpParser\Node\Expr;
<<<<<<< HEAD

class ShellExec extends Expr
{
    /** @var array Encapsed string array */
    public $parts;
=======
use PhpParser\Node\InterpolatedStringPart;

class ShellExec extends Expr {
    /** @var (Expr|InterpolatedStringPart)[] Interpolated string array */
    public array $parts;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Constructs a shell exec (backtick) node.
     *
<<<<<<< HEAD
     * @param array $parts      Encapsed string array
     * @param array $attributes Additional attributes
=======
     * @param (Expr|InterpolatedStringPart)[] $parts Interpolated string array
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function __construct(array $parts, array $attributes = []) {
        $this->attributes = $attributes;
        $this->parts = $parts;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['parts'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['parts'];
    }

    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Expr_ShellExec';
    }
}
