<?php declare(strict_types=1);

namespace PhpParser\Node\Scalar;

<<<<<<< HEAD
use PhpParser\Node\Expr;
use PhpParser\Node\Scalar;

class Encapsed extends Scalar
{
    /** @var Expr[] list of string parts */
    public $parts;

    /**
     * Constructs an encapsed string node.
     *
     * @param Expr[] $parts      Encaps list
     * @param array  $attributes Additional attributes
     */
    public function __construct(array $parts, array $attributes = []) {
        $this->attributes = $attributes;
        $this->parts = $parts;
    }

    public function getSubNodeNames() : array {
        return ['parts'];
    }
    
    public function getType() : string {
        return 'Scalar_Encapsed';
=======
require __DIR__ . '/InterpolatedString.php';

if (false) {
    /**
     * For classmap-authoritative support.
     *
     * @deprecated use \PhpParser\Node\Scalar\InterpolatedString instead.
     */
    class Encapsed extends InterpolatedString {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }
}
