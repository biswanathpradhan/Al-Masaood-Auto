<?php declare(strict_types=1);

namespace PhpParser\Node\Expr\AssignOp;

use PhpParser\Node\Expr\AssignOp;

<<<<<<< HEAD
class BitwiseAnd extends AssignOp
{
    public function getType() : string {
=======
class BitwiseAnd extends AssignOp {
    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Expr_AssignOp_BitwiseAnd';
    }
}
