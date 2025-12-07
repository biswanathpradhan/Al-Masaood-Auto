<?php declare(strict_types=1);

namespace PhpParser\Node\Expr\Cast;

use PhpParser\Node\Expr\Cast;

<<<<<<< HEAD
class Bool_ extends Cast
{
    public function getType() : string {
=======
class Bool_ extends Cast {
    // For use in "kind" attribute
    public const KIND_BOOL = 1; // "bool" syntax
    public const KIND_BOOLEAN = 2; // "boolean" syntax

    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Expr_Cast_Bool';
    }
}
