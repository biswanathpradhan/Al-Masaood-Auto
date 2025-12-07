<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

<<<<<<< HEAD
use PhpParser\Node;

class PropertyProperty extends Node\Stmt
{
    /** @var Node\VarLikeIdentifier Name */
    public $name;
    /** @var null|Node\Expr Default */
    public $default;

    /**
     * Constructs a class property node.
     *
     * @param string|Node\VarLikeIdentifier $name       Name
     * @param null|Node\Expr                $default    Default value
     * @param array                         $attributes Additional attributes
     */
    public function __construct($name, ?Node\Expr $default = null, array $attributes = []) {
        $this->attributes = $attributes;
        $this->name = \is_string($name) ? new Node\VarLikeIdentifier($name) : $name;
        $this->default = $default;
    }

    public function getSubNodeNames() : array {
        return ['name', 'default'];
    }
    
    public function getType() : string {
        return 'Stmt_PropertyProperty';
=======
use PhpParser\Node\PropertyItem;

require __DIR__ . '/../PropertyItem.php';

if (false) {
    /**
     * For classmap-authoritative support.
     *
     * @deprecated use \PhpParser\Node\PropertyItem instead.
     */
    class PropertyProperty extends PropertyItem {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }
}
