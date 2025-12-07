<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node;

<<<<<<< HEAD
class Const_ extends Node\Stmt
{
    /** @var Node\Const_[] Constant declarations */
    public $consts;
=======
class Const_ extends Node\Stmt {
    /** @var Node\Const_[] Constant declarations */
    public array $consts;
    /** @var Node\AttributeGroup[] PHP attribute groups */
    public array $attrGroups;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Constructs a const list node.
     *
<<<<<<< HEAD
     * @param Node\Const_[] $consts     Constant declarations
     * @param array         $attributes Additional attributes
     */
    public function __construct(array $consts, array $attributes = []) {
        $this->attributes = $attributes;
        $this->consts = $consts;
    }

    public function getSubNodeNames() : array {
        return ['consts'];
    }
    
    public function getType() : string {
=======
     * @param Node\Const_[] $consts Constant declarations
     * @param array<string, mixed> $attributes Additional attributes
     * @param list<Node\AttributeGroup> $attrGroups PHP attribute groups
     */
    public function __construct(
        array $consts,
        array $attributes = [],
        array $attrGroups = []
    ) {
        $this->attributes = $attributes;
        $this->attrGroups = $attrGroups;
        $this->consts = $consts;
    }

    public function getSubNodeNames(): array {
        return ['attrGroups', 'consts'];
    }

    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Stmt_Const';
    }
}
