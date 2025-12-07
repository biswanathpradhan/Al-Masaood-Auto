<?php declare(strict_types=1);

namespace PhpParser\Node\Scalar\MagicConst;

use PhpParser\Node\Scalar\MagicConst;

<<<<<<< HEAD
class Line extends MagicConst
{
    public function getName() : string {
        return '__LINE__';
    }
    
    public function getType() : string {
=======
class Line extends MagicConst {
    public function getName(): string {
        return '__LINE__';
    }

    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Scalar_MagicConst_Line';
    }
}
