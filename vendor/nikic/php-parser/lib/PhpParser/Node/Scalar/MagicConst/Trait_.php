<?php declare(strict_types=1);

namespace PhpParser\Node\Scalar\MagicConst;

use PhpParser\Node\Scalar\MagicConst;

<<<<<<< HEAD
class Trait_ extends MagicConst
{
    public function getName() : string {
        return '__TRAIT__';
    }
    
    public function getType() : string {
=======
class Trait_ extends MagicConst {
    public function getName(): string {
        return '__TRAIT__';
    }

    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Scalar_MagicConst_Trait';
    }
}
