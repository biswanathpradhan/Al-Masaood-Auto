<?php declare(strict_types=1);

namespace PhpParser\Node\Scalar;

<<<<<<< HEAD
use PhpParser\Node\Scalar;

class EncapsedStringPart extends Scalar
{
    /** @var string String value */
    public $value;

    /**
     * Constructs a node representing a string part of an encapsed string.
     *
     * @param string $value      String value
     * @param array  $attributes Additional attributes
     */
    public function __construct(string $value, array $attributes = []) {
        $this->attributes = $attributes;
        $this->value = $value;
    }

    public function getSubNodeNames() : array {
        return ['value'];
    }
    
    public function getType() : string {
        return 'Scalar_EncapsedStringPart';
=======
use PhpParser\Node\InterpolatedStringPart;

require __DIR__ . '/../InterpolatedStringPart.php';

if (false) {
    /**
     * For classmap-authoritative support.
     *
     * @deprecated use \PhpParser\Node\InterpolatedStringPart instead.
     */
    class EncapsedStringPart extends InterpolatedStringPart {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }
}
