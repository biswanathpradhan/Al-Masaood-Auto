<?php declare(strict_types=1);

namespace PhpParser\Node\Expr\BinaryOp;

use PhpParser\Node\Expr\BinaryOp;

<<<<<<< HEAD
class LogicalOr extends BinaryOp
{
    public function getOperatorSigil() : string {
        return 'or';
    }
    
    public function getType() : string {
=======
class LogicalOr extends BinaryOp {
    public function getOperatorSigil(): string {
        return 'or';
    }

    public function getType(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return 'Expr_BinaryOp_LogicalOr';
    }
}
