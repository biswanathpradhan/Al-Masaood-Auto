<?php declare(strict_types=1);

namespace PhpParser;

<<<<<<< HEAD
use PhpParser\Node\Expr\Include_;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\GroupUse;
use PhpParser\Node\Stmt\Use_;
use PhpParser\Node\Stmt\UseUse;

class NodeDumper
{
    private $dumpComments;
    private $dumpPositions;
    private $code;
=======
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\Include_;
use PhpParser\Node\Expr\List_;
use PhpParser\Node\Scalar\Int_;
use PhpParser\Node\Scalar\InterpolatedString;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\GroupUse;
use PhpParser\Node\Stmt\Use_;
use PhpParser\Node\UseItem;

class NodeDumper {
    private bool $dumpComments;
    private bool $dumpPositions;
    private bool $dumpOtherAttributes;
    private ?string $code;
    private string $res;
    private string $nl;

    private const IGNORE_ATTRIBUTES = [
        'comments' => true,
        'startLine' => true,
        'endLine' => true,
        'startFilePos' => true,
        'endFilePos' => true,
        'startTokenPos' => true,
        'endTokenPos' => true,
    ];
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Constructs a NodeDumper.
     *
     * Supported options:
     *  * bool dumpComments: Whether comments should be dumped.
     *  * bool dumpPositions: Whether line/offset information should be dumped. To dump offset
     *                        information, the code needs to be passed to dump().
<<<<<<< HEAD
=======
     *  * bool dumpOtherAttributes: Whether non-comment, non-position attributes should be dumped.
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     *
     * @param array $options Options (see description)
     */
    public function __construct(array $options = []) {
        $this->dumpComments = !empty($options['dumpComments']);
        $this->dumpPositions = !empty($options['dumpPositions']);
<<<<<<< HEAD
=======
        $this->dumpOtherAttributes = !empty($options['dumpOtherAttributes']);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Dumps a node or array.
     *
<<<<<<< HEAD
     * @param array|Node  $node Node or array to dump
=======
     * @param array|Node $node Node or array to dump
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * @param string|null $code Code corresponding to dumped AST. This only needs to be passed if
     *                          the dumpPositions option is enabled and the dumping of node offsets
     *                          is desired.
     *
     * @return string Dumped value
     */
<<<<<<< HEAD
    public function dump($node, ?string $code = null) : string {
        $this->code = $code;
        return $this->dumpRecursive($node);
    }

    protected function dumpRecursive($node) {
        if ($node instanceof Node) {
            $r = $node->getType();
            if ($this->dumpPositions && null !== $p = $this->dumpPosition($node)) {
                $r .= $p;
            }
            $r .= '(';

            foreach ($node->getSubNodeNames() as $key) {
                $r .= "\n    " . $key . ': ';

                $value = $node->$key;
                if (null === $value) {
                    $r .= 'null';
                } elseif (false === $value) {
                    $r .= 'false';
                } elseif (true === $value) {
                    $r .= 'true';
                } elseif (is_scalar($value)) {
                    if ('flags' === $key || 'newModifier' === $key) {
                        $r .= $this->dumpFlags($value);
                    } elseif ('type' === $key && $node instanceof Include_) {
                        $r .= $this->dumpIncludeType($value);
                    } elseif ('type' === $key
                            && ($node instanceof Use_ || $node instanceof UseUse || $node instanceof GroupUse)) {
                        $r .= $this->dumpUseType($value);
                    } else {
                        $r .= $value;
                    }
                } else {
                    $r .= str_replace("\n", "\n    ", $this->dumpRecursive($value));
                }
            }

            if ($this->dumpComments && $comments = $node->getComments()) {
                $r .= "\n    comments: " . str_replace("\n", "\n    ", $this->dumpRecursive($comments));
            }
        } elseif (is_array($node)) {
            $r = 'array(';

            foreach ($node as $key => $value) {
                $r .= "\n    " . $key . ': ';

                if (null === $value) {
                    $r .= 'null';
                } elseif (false === $value) {
                    $r .= 'false';
                } elseif (true === $value) {
                    $r .= 'true';
                } elseif (is_scalar($value)) {
                    $r .= $value;
                } else {
                    $r .= str_replace("\n", "\n    ", $this->dumpRecursive($value));
                }
            }
        } elseif ($node instanceof Comment) {
            return $node->getReformattedText();
        } else {
            throw new \InvalidArgumentException('Can only dump nodes and arrays.');
        }

        return $r . "\n)";
    }

    protected function dumpFlags($flags) {
        $strs = [];
        if ($flags & Class_::MODIFIER_PUBLIC) {
            $strs[] = 'MODIFIER_PUBLIC';
        }
        if ($flags & Class_::MODIFIER_PROTECTED) {
            $strs[] = 'MODIFIER_PROTECTED';
        }
        if ($flags & Class_::MODIFIER_PRIVATE) {
            $strs[] = 'MODIFIER_PRIVATE';
        }
        if ($flags & Class_::MODIFIER_ABSTRACT) {
            $strs[] = 'MODIFIER_ABSTRACT';
        }
        if ($flags & Class_::MODIFIER_STATIC) {
            $strs[] = 'MODIFIER_STATIC';
        }
        if ($flags & Class_::MODIFIER_FINAL) {
            $strs[] = 'MODIFIER_FINAL';
        }
        if ($flags & Class_::MODIFIER_READONLY) {
            $strs[] = 'MODIFIER_READONLY';
=======
    public function dump($node, ?string $code = null): string {
        $this->code = $code;
        $this->res = '';
        $this->nl = "\n";
        $this->dumpRecursive($node, false);
        return $this->res;
    }

    /** @param mixed $node */
    protected function dumpRecursive($node, bool $indent = true): void {
        if ($indent) {
            $this->nl .= "    ";
        }
        if ($node instanceof Node) {
            $this->res .= $node->getType();
            if ($this->dumpPositions && null !== $p = $this->dumpPosition($node)) {
                $this->res .= $p;
            }
            $this->res .= '(';

            foreach ($node->getSubNodeNames() as $key) {
                $this->res .= "$this->nl    " . $key . ': ';

                $value = $node->$key;
                if (\is_int($value)) {
                    if ('flags' === $key || 'newModifier' === $key) {
                        $this->res .= $this->dumpFlags($value);
                        continue;
                    }
                    if ('type' === $key && $node instanceof Include_) {
                        $this->res .= $this->dumpIncludeType($value);
                        continue;
                    }
                    if ('type' === $key
                            && ($node instanceof Use_ || $node instanceof UseItem || $node instanceof GroupUse)) {
                        $this->res .= $this->dumpUseType($value);
                        continue;
                    }
                }
                $this->dumpRecursive($value);
            }

            if ($this->dumpComments && $comments = $node->getComments()) {
                $this->res .= "$this->nl    comments: ";
                $this->dumpRecursive($comments);
            }

            if ($this->dumpOtherAttributes) {
                foreach ($node->getAttributes() as $key => $value) {
                    if (isset(self::IGNORE_ATTRIBUTES[$key])) {
                        continue;
                    }

                    $this->res .= "$this->nl    $key: ";
                    if (\is_int($value)) {
                        if ('kind' === $key) {
                            if ($node instanceof Int_) {
                                $this->res .= $this->dumpIntKind($value);
                                continue;
                            }
                            if ($node instanceof String_ || $node instanceof InterpolatedString) {
                                $this->res .= $this->dumpStringKind($value);
                                continue;
                            }
                            if ($node instanceof Array_) {
                                $this->res .= $this->dumpArrayKind($value);
                                continue;
                            }
                            if ($node instanceof List_) {
                                $this->res .= $this->dumpListKind($value);
                                continue;
                            }
                        }
                    }
                    $this->dumpRecursive($value);
                }
            }
            $this->res .= "$this->nl)";
        } elseif (\is_array($node)) {
            $this->res .= 'array(';
            foreach ($node as $key => $value) {
                $this->res .= "$this->nl    " . $key . ': ';
                $this->dumpRecursive($value);
            }
            $this->res .= "$this->nl)";
        } elseif ($node instanceof Comment) {
            $this->res .= \str_replace("\n", $this->nl, $node->getReformattedText());
        } elseif (\is_string($node)) {
            $this->res .= \str_replace("\n", $this->nl, $node);
        } elseif (\is_int($node) || \is_float($node)) {
            $this->res .= $node;
        } elseif (null === $node) {
            $this->res .= 'null';
        } elseif (false === $node) {
            $this->res .= 'false';
        } elseif (true === $node) {
            $this->res .= 'true';
        } else {
            throw new \InvalidArgumentException('Can only dump nodes and arrays.');
        }
        if ($indent) {
            $this->nl = \substr($this->nl, 0, -4);
        }
    }

    protected function dumpFlags(int $flags): string {
        $strs = [];
        if ($flags & Modifiers::PUBLIC) {
            $strs[] = 'PUBLIC';
        }
        if ($flags & Modifiers::PROTECTED) {
            $strs[] = 'PROTECTED';
        }
        if ($flags & Modifiers::PRIVATE) {
            $strs[] = 'PRIVATE';
        }
        if ($flags & Modifiers::ABSTRACT) {
            $strs[] = 'ABSTRACT';
        }
        if ($flags & Modifiers::STATIC) {
            $strs[] = 'STATIC';
        }
        if ($flags & Modifiers::FINAL) {
            $strs[] = 'FINAL';
        }
        if ($flags & Modifiers::READONLY) {
            $strs[] = 'READONLY';
        }
        if ($flags & Modifiers::PUBLIC_SET) {
            $strs[] = 'PUBLIC_SET';
        }
        if ($flags & Modifiers::PROTECTED_SET) {
            $strs[] = 'PROTECTED_SET';
        }
        if ($flags & Modifiers::PRIVATE_SET) {
            $strs[] = 'PRIVATE_SET';
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        }

        if ($strs) {
            return implode(' | ', $strs) . ' (' . $flags . ')';
        } else {
<<<<<<< HEAD
            return $flags;
        }
    }

    protected function dumpIncludeType($type) {
        $map = [
=======
            return (string) $flags;
        }
    }

    /** @param array<int, string> $map */
    private function dumpEnum(int $value, array $map): string {
        if (!isset($map[$value])) {
            return (string) $value;
        }
        return $map[$value] . ' (' . $value . ')';
    }

    private function dumpIncludeType(int $type): string {
        return $this->dumpEnum($type, [
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            Include_::TYPE_INCLUDE      => 'TYPE_INCLUDE',
            Include_::TYPE_INCLUDE_ONCE => 'TYPE_INCLUDE_ONCE',
            Include_::TYPE_REQUIRE      => 'TYPE_REQUIRE',
            Include_::TYPE_REQUIRE_ONCE => 'TYPE_REQUIRE_ONCE',
<<<<<<< HEAD
        ];

        if (!isset($map[$type])) {
            return $type;
        }
        return $map[$type] . ' (' . $type . ')';
    }

    protected function dumpUseType($type) {
        $map = [
=======
        ]);
    }

    private function dumpUseType(int $type): string {
        return $this->dumpEnum($type, [
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            Use_::TYPE_UNKNOWN  => 'TYPE_UNKNOWN',
            Use_::TYPE_NORMAL   => 'TYPE_NORMAL',
            Use_::TYPE_FUNCTION => 'TYPE_FUNCTION',
            Use_::TYPE_CONSTANT => 'TYPE_CONSTANT',
<<<<<<< HEAD
        ];

        if (!isset($map[$type])) {
            return $type;
        }
        return $map[$type] . ' (' . $type . ')';
=======
        ]);
    }

    private function dumpIntKind(int $kind): string {
        return $this->dumpEnum($kind, [
            Int_::KIND_BIN => 'KIND_BIN',
            Int_::KIND_OCT => 'KIND_OCT',
            Int_::KIND_DEC => 'KIND_DEC',
            Int_::KIND_HEX => 'KIND_HEX',
        ]);
    }

    private function dumpStringKind(int $kind): string {
        return $this->dumpEnum($kind, [
            String_::KIND_SINGLE_QUOTED => 'KIND_SINGLE_QUOTED',
            String_::KIND_DOUBLE_QUOTED => 'KIND_DOUBLE_QUOTED',
            String_::KIND_HEREDOC => 'KIND_HEREDOC',
            String_::KIND_NOWDOC => 'KIND_NOWDOC',
        ]);
    }

    private function dumpArrayKind(int $kind): string {
        return $this->dumpEnum($kind, [
            Array_::KIND_LONG => 'KIND_LONG',
            Array_::KIND_SHORT => 'KIND_SHORT',
        ]);
    }

    private function dumpListKind(int $kind): string {
        return $this->dumpEnum($kind, [
            List_::KIND_LIST => 'KIND_LIST',
            List_::KIND_ARRAY => 'KIND_ARRAY',
        ]);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Dump node position, if possible.
     *
     * @param Node $node Node for which to dump position
     *
     * @return string|null Dump of position, or null if position information not available
     */
<<<<<<< HEAD
    protected function dumpPosition(Node $node) {
=======
    protected function dumpPosition(Node $node): ?string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        if (!$node->hasAttribute('startLine') || !$node->hasAttribute('endLine')) {
            return null;
        }

        $start = $node->getStartLine();
        $end = $node->getEndLine();
        if ($node->hasAttribute('startFilePos') && $node->hasAttribute('endFilePos')
            && null !== $this->code
        ) {
            $start .= ':' . $this->toColumn($this->code, $node->getStartFilePos());
            $end .= ':' . $this->toColumn($this->code, $node->getEndFilePos());
        }
        return "[$start - $end]";
    }

    // Copied from Error class
<<<<<<< HEAD
    private function toColumn($code, $pos) {
=======
    private function toColumn(string $code, int $pos): int {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        if ($pos > strlen($code)) {
            throw new \RuntimeException('Invalid position information');
        }

        $lineStartPos = strrpos($code, "\n", $pos - strlen($code));
        if (false === $lineStartPos) {
            $lineStartPos = -1;
        }

        return $pos - $lineStartPos;
    }
}
