<?php declare(strict_types=1);

namespace PhpParser\Node\Expr\Cast;

use PhpParser\Node\Expr\Cast;

<<<<<<< HEAD
class String_ extends Cast
{
    public function getType() : string {
=======
class String_ extends Cast {
    // For use in "kind" attribute
    public const KIND_STRING = 1; // "string" syntax
    public const KIND_BINARY = 2; // "binary" syntax

    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Expr_Cast_String';
    }
}
