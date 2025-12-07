<?php declare(strict_types=1);

namespace PhpParser\Lexer;

use PhpParser\Error;
use PhpParser\ErrorHandler;
use PhpParser\Lexer;
<<<<<<< HEAD
use PhpParser\Lexer\TokenEmulator\AttributeEmulator;
use PhpParser\Lexer\TokenEmulator\EnumTokenEmulator;
use PhpParser\Lexer\TokenEmulator\CoaleseEqualTokenEmulator;
use PhpParser\Lexer\TokenEmulator\ExplicitOctalEmulator;
use PhpParser\Lexer\TokenEmulator\FlexibleDocStringEmulator;
use PhpParser\Lexer\TokenEmulator\FnTokenEmulator;
use PhpParser\Lexer\TokenEmulator\MatchTokenEmulator;
use PhpParser\Lexer\TokenEmulator\NullsafeTokenEmulator;
use PhpParser\Lexer\TokenEmulator\NumericLiteralSeparatorEmulator;
=======
use PhpParser\Lexer\TokenEmulator\AsymmetricVisibilityTokenEmulator;
use PhpParser\Lexer\TokenEmulator\AttributeEmulator;
use PhpParser\Lexer\TokenEmulator\EnumTokenEmulator;
use PhpParser\Lexer\TokenEmulator\ExplicitOctalEmulator;
use PhpParser\Lexer\TokenEmulator\MatchTokenEmulator;
use PhpParser\Lexer\TokenEmulator\NullsafeTokenEmulator;
use PhpParser\Lexer\TokenEmulator\PipeOperatorEmulator;
use PhpParser\Lexer\TokenEmulator\PropertyTokenEmulator;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
use PhpParser\Lexer\TokenEmulator\ReadonlyFunctionTokenEmulator;
use PhpParser\Lexer\TokenEmulator\ReadonlyTokenEmulator;
use PhpParser\Lexer\TokenEmulator\ReverseEmulator;
use PhpParser\Lexer\TokenEmulator\TokenEmulator;
<<<<<<< HEAD

class Emulative extends Lexer
{
    const PHP_7_3 = '7.3dev';
    const PHP_7_4 = '7.4dev';
    const PHP_8_0 = '8.0dev';
    const PHP_8_1 = '8.1dev';
    const PHP_8_2 = '8.2dev';

    /** @var mixed[] Patches used to reverse changes introduced in the code */
    private $patches = [];

    /** @var TokenEmulator[] */
    private $emulators = [];

    /** @var string */
    private $targetPhpVersion;

    /**
     * @param mixed[] $options Lexer options. In addition to the usual options,
     *                         accepts a 'phpVersion' string that specifies the
     *                         version to emulate. Defaults to newest supported.
     */
    public function __construct(array $options = [])
    {
        $this->targetPhpVersion = $options['phpVersion'] ?? Emulative::PHP_8_2;
        unset($options['phpVersion']);

        parent::__construct($options);

        $emulators = [
            new FlexibleDocStringEmulator(),
            new FnTokenEmulator(),
            new MatchTokenEmulator(),
            new CoaleseEqualTokenEmulator(),
            new NumericLiteralSeparatorEmulator(),
=======
use PhpParser\Lexer\TokenEmulator\VoidCastEmulator;
use PhpParser\PhpVersion;
use PhpParser\Token;

class Emulative extends Lexer {
    /** @var array{int, string, string}[] Patches used to reverse changes introduced in the code */
    private array $patches = [];

    /** @var list<TokenEmulator> */
    private array $emulators = [];

    private PhpVersion $targetPhpVersion;

    private PhpVersion $hostPhpVersion;

    /**
     * @param PhpVersion|null $phpVersion PHP version to emulate. Defaults to newest supported.
     */
    public function __construct(?PhpVersion $phpVersion = null) {
        $this->targetPhpVersion = $phpVersion ?? PhpVersion::getNewestSupported();
        $this->hostPhpVersion = PhpVersion::getHostVersion();

        $emulators = [
            new MatchTokenEmulator(),
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            new NullsafeTokenEmulator(),
            new AttributeEmulator(),
            new EnumTokenEmulator(),
            new ReadonlyTokenEmulator(),
            new ExplicitOctalEmulator(),
            new ReadonlyFunctionTokenEmulator(),
<<<<<<< HEAD
=======
            new PropertyTokenEmulator(),
            new AsymmetricVisibilityTokenEmulator(),
            new PipeOperatorEmulator(),
            new VoidCastEmulator(),
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        ];

        // Collect emulators that are relevant for the PHP version we're running
        // and the PHP version we're targeting for emulation.
        foreach ($emulators as $emulator) {
            $emulatorPhpVersion = $emulator->getPhpVersion();
            if ($this->isForwardEmulationNeeded($emulatorPhpVersion)) {
                $this->emulators[] = $emulator;
<<<<<<< HEAD
            } else if ($this->isReverseEmulationNeeded($emulatorPhpVersion)) {
=======
            } elseif ($this->isReverseEmulationNeeded($emulatorPhpVersion)) {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
                $this->emulators[] = new ReverseEmulator($emulator);
            }
        }
    }

<<<<<<< HEAD
    public function startLexing(string $code, ?ErrorHandler $errorHandler = null) {
        $emulators = array_filter($this->emulators, function($emulator) use($code) {
=======
    public function tokenize(string $code, ?ErrorHandler $errorHandler = null): array {
        $emulators = array_filter($this->emulators, function ($emulator) use ($code) {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            return $emulator->isEmulationNeeded($code);
        });

        if (empty($emulators)) {
            // Nothing to emulate, yay
<<<<<<< HEAD
            parent::startLexing($code, $errorHandler);
            return;
=======
            return parent::tokenize($code, $errorHandler);
        }

        if ($errorHandler === null) {
            $errorHandler = new ErrorHandler\Throwing();
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        }

        $this->patches = [];
        foreach ($emulators as $emulator) {
            $code = $emulator->preprocessCode($code, $this->patches);
        }

        $collector = new ErrorHandler\Collecting();
<<<<<<< HEAD
        parent::startLexing($code, $collector);
        $this->sortPatches();
        $this->fixupTokens();
=======
        $tokens = parent::tokenize($code, $collector);
        $this->sortPatches();
        $tokens = $this->fixupTokens($tokens);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

        $errors = $collector->getErrors();
        if (!empty($errors)) {
            $this->fixupErrors($errors);
            foreach ($errors as $error) {
                $errorHandler->handleError($error);
            }
        }

        foreach ($emulators as $emulator) {
<<<<<<< HEAD
            $this->tokens = $emulator->emulate($code, $this->tokens);
        }
    }

    private function isForwardEmulationNeeded(string $emulatorPhpVersion): bool {
        return version_compare(\PHP_VERSION, $emulatorPhpVersion, '<')
            && version_compare($this->targetPhpVersion, $emulatorPhpVersion, '>=');
    }

    private function isReverseEmulationNeeded(string $emulatorPhpVersion): bool {
        return version_compare(\PHP_VERSION, $emulatorPhpVersion, '>=')
            && version_compare($this->targetPhpVersion, $emulatorPhpVersion, '<');
    }

    private function sortPatches()
    {
        // Patches may be contributed by different emulators.
        // Make sure they are sorted by increasing patch position.
        usort($this->patches, function($p1, $p2) {
=======
            $tokens = $emulator->emulate($code, $tokens);
        }

        return $tokens;
    }

    private function isForwardEmulationNeeded(PhpVersion $emulatorPhpVersion): bool {
        return $this->hostPhpVersion->older($emulatorPhpVersion)
            && $this->targetPhpVersion->newerOrEqual($emulatorPhpVersion);
    }

    private function isReverseEmulationNeeded(PhpVersion $emulatorPhpVersion): bool {
        return $this->hostPhpVersion->newerOrEqual($emulatorPhpVersion)
            && $this->targetPhpVersion->older($emulatorPhpVersion);
    }

    private function sortPatches(): void {
        // Patches may be contributed by different emulators.
        // Make sure they are sorted by increasing patch position.
        usort($this->patches, function ($p1, $p2) {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            return $p1[0] <=> $p2[0];
        });
    }

<<<<<<< HEAD
    private function fixupTokens()
    {
        if (\count($this->patches) === 0) {
            return;
=======
    /**
     * @param list<Token> $tokens
     * @return list<Token>
     */
    private function fixupTokens(array $tokens): array {
        if (\count($this->patches) === 0) {
            return $tokens;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        }

        // Load first patch
        $patchIdx = 0;
<<<<<<< HEAD

        list($patchPos, $patchType, $patchText) = $this->patches[$patchIdx];

        // We use a manual loop over the tokens, because we modify the array on the fly
        $pos = 0;
        for ($i = 0, $c = \count($this->tokens); $i < $c; $i++) {
            $token = $this->tokens[$i];
            if (\is_string($token)) {
                if ($patchPos === $pos) {
                    // Only support replacement for string tokens.
                    assert($patchType === 'replace');
                    $this->tokens[$i] = $patchText;

                    // Fetch the next patch
                    $patchIdx++;
                    if ($patchIdx >= \count($this->patches)) {
                        // No more patches, we're done
                        return;
                    }
                    list($patchPos, $patchType, $patchText) = $this->patches[$patchIdx];
                }

                $pos += \strlen($token);
                continue;
            }

            $len = \strlen($token[1]);
            $posDelta = 0;
=======
        list($patchPos, $patchType, $patchText) = $this->patches[$patchIdx];

        // We use a manual loop over the tokens, because we modify the array on the fly
        $posDelta = 0;
        $lineDelta = 0;
        for ($i = 0, $c = \count($tokens); $i < $c; $i++) {
            $token = $tokens[$i];
            $pos = $token->pos;
            $token->pos += $posDelta;
            $token->line += $lineDelta;
            $localPosDelta = 0;
            $len = \strlen($token->text);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            while ($patchPos >= $pos && $patchPos < $pos + $len) {
                $patchTextLen = \strlen($patchText);
                if ($patchType === 'remove') {
                    if ($patchPos === $pos && $patchTextLen === $len) {
                        // Remove token entirely
<<<<<<< HEAD
                        array_splice($this->tokens, $i, 1, []);
=======
                        array_splice($tokens, $i, 1, []);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
                        $i--;
                        $c--;
                    } else {
                        // Remove from token string
<<<<<<< HEAD
                        $this->tokens[$i][1] = substr_replace(
                            $token[1], '', $patchPos - $pos + $posDelta, $patchTextLen
                        );
                        $posDelta -= $patchTextLen;
                    }
                } elseif ($patchType === 'add') {
                    // Insert into the token string
                    $this->tokens[$i][1] = substr_replace(
                        $token[1], $patchText, $patchPos - $pos + $posDelta, 0
                    );
                    $posDelta += $patchTextLen;
                } else if ($patchType === 'replace') {
                    // Replace inside the token string
                    $this->tokens[$i][1] = substr_replace(
                        $token[1], $patchText, $patchPos - $pos + $posDelta, $patchTextLen
=======
                        $token->text = substr_replace(
                            $token->text, '', $patchPos - $pos + $localPosDelta, $patchTextLen
                        );
                        $localPosDelta -= $patchTextLen;
                    }
                    $lineDelta -= \substr_count($patchText, "\n");
                } elseif ($patchType === 'add') {
                    // Insert into the token string
                    $token->text = substr_replace(
                        $token->text, $patchText, $patchPos - $pos + $localPosDelta, 0
                    );
                    $localPosDelta += $patchTextLen;
                    $lineDelta += \substr_count($patchText, "\n");
                } elseif ($patchType === 'replace') {
                    // Replace inside the token string
                    $token->text = substr_replace(
                        $token->text, $patchText, $patchPos - $pos + $localPosDelta, $patchTextLen
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
                    );
                } else {
                    assert(false);
                }

                // Fetch the next patch
                $patchIdx++;
                if ($patchIdx >= \count($this->patches)) {
<<<<<<< HEAD
                    // No more patches, we're done
                    return;
                }

                list($patchPos, $patchType, $patchText) = $this->patches[$patchIdx];

                // Multiple patches may apply to the same token. Reload the current one to check
                // If the new patch applies
                $token = $this->tokens[$i];
            }

            $pos += $len;
        }

        // A patch did not apply
        assert(false);
=======
                    // No more patches. However, we still need to adjust position.
                    $patchPos = \PHP_INT_MAX;
                    break;
                }

                list($patchPos, $patchType, $patchText) = $this->patches[$patchIdx];
            }

            $posDelta += $localPosDelta;
        }
        return $tokens;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Fixup line and position information in errors.
     *
     * @param Error[] $errors
     */
<<<<<<< HEAD
    private function fixupErrors(array $errors) {
=======
    private function fixupErrors(array $errors): void {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        foreach ($errors as $error) {
            $attrs = $error->getAttributes();

            $posDelta = 0;
            $lineDelta = 0;
            foreach ($this->patches as $patch) {
                list($patchPos, $patchType, $patchText) = $patch;
                if ($patchPos >= $attrs['startFilePos']) {
                    // No longer relevant
                    break;
                }

                if ($patchType === 'add') {
                    $posDelta += strlen($patchText);
                    $lineDelta += substr_count($patchText, "\n");
<<<<<<< HEAD
                } else if ($patchType === 'remove') {
=======
                } elseif ($patchType === 'remove') {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
                    $posDelta -= strlen($patchText);
                    $lineDelta -= substr_count($patchText, "\n");
                }
            }

            $attrs['startFilePos'] += $posDelta;
            $attrs['endFilePos'] += $posDelta;
            $attrs['startLine'] += $lineDelta;
            $attrs['endLine'] += $lineDelta;
            $error->setAttributes($attrs);
        }
    }
}
