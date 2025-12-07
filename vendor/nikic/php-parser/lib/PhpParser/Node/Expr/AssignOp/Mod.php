<?php declare(strict_types=1);

namespace PhpParser\Node\Expr\AssignOp;

use PhpParser\Node\Expr\AssignOp;

<<<<<<< HEAD
class Mod extends AssignOp
{
    public function getType() : string {
=======
class Mod extends AssignOp {
    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Expr_AssignOp_Mod';
    }
}
