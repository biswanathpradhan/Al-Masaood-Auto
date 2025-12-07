<?php declare(strict_types=1);

namespace PhpParser\Node;

<<<<<<< HEAD
use PhpParser\NodeAbstract;

class IntersectionType extends ComplexType
{
    /** @var (Identifier|Name)[] Types */
    public $types;
=======
class IntersectionType extends ComplexType {
    /** @var (Identifier|Name)[] Types */
    public array $types;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Constructs an intersection type.
     *
<<<<<<< HEAD
     * @param (Identifier|Name)[] $types      Types
     * @param array               $attributes Additional attributes
=======
     * @param (Identifier|Name)[] $types Types
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function __construct(array $types, array $attributes = []) {
        $this->attributes = $attributes;
        $this->types = $types;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['types'];
    }

    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['types'];
    }

    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'IntersectionType';
    }
}
