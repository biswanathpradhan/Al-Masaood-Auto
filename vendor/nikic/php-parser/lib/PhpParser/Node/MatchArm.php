<?php declare(strict_types=1);

namespace PhpParser\Node;

use PhpParser\Node;
use PhpParser\NodeAbstract;

<<<<<<< HEAD
class MatchArm extends NodeAbstract
{
    /** @var null|Node\Expr[] */
    public $conds;
    /** @var Node\Expr */
    public $body;

    /**
     * @param null|Node\Expr[] $conds
     */
    public function __construct($conds, Node\Expr $body, array $attributes = []) {
=======
class MatchArm extends NodeAbstract {
    /** @var null|list<Node\Expr> */
    public ?array $conds;
    public Expr $body;

    /**
     * @param null|list<Node\Expr> $conds
     */
    public function __construct(?array $conds, Node\Expr $body, array $attributes = []) {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        $this->conds = $conds;
        $this->body = $body;
        $this->attributes = $attributes;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['conds', 'body'];
    }

    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['conds', 'body'];
    }

    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'MatchArm';
    }
}
