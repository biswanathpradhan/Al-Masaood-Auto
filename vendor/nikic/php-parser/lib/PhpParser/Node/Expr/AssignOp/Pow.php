<?php declare(strict_types=1);

namespace PhpParser\Node\Expr\AssignOp;

use PhpParser\Node\Expr\AssignOp;

<<<<<<< HEAD
class Pow extends AssignOp
{
    public function getType() : string {
=======
class Pow extends AssignOp {
    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Expr_AssignOp_Pow';
    }
}
