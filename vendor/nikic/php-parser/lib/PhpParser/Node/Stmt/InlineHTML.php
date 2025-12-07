<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node\Stmt;

<<<<<<< HEAD
class InlineHTML extends Stmt
{
    /** @var string String */
    public $value;
=======
class InlineHTML extends Stmt {
    /** @var string String */
    public string $value;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Constructs an inline HTML node.
     *
<<<<<<< HEAD
     * @param string $value      String
     * @param array  $attributes Additional attributes
=======
     * @param string $value String
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function __construct(string $value, array $attributes = []) {
        $this->attributes = $attributes;
        $this->value = $value;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['value'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['value'];
    }

    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Stmt_InlineHTML';
    }
}
