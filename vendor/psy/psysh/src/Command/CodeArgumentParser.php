<?php

/*
 * This file is part of Psy Shell.
 *
<<<<<<< HEAD
 * (c) 2012-2023 Justin Hileman
=======
 * (c) 2012-2025 Justin Hileman
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\Command;

use PhpParser\Parser;
use Psy\Exception\ParseErrorException;
use Psy\ParserFactory;

/**
 * Class CodeArgumentParser.
 */
class CodeArgumentParser
{
<<<<<<< HEAD
    private $parser;

    public function __construct(Parser $parser = null)
=======
    private Parser $parser;

    public function __construct(?Parser $parser = null)
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    {
        $this->parser = $parser ?? (new ParserFactory())->createParser();
    }

    /**
     * Lex and parse a string of code into statements.
     *
     * This is intended for code arguments, so the code string *should not* start with <?php
     *
     * @throws ParseErrorException
     *
     * @return array Statements
     */
    public function parse(string $code): array
    {
        $code = '<?php '.$code;

        try {
            return $this->parser->parse($code);
        } catch (\PhpParser\Error $e) {
            if (\strpos($e->getMessage(), 'unexpected EOF') === false) {
                throw ParseErrorException::fromParseError($e);
            }

            // If we got an unexpected EOF, let's try it again with a semicolon.
            try {
                return $this->parser->parse($code.';');
            } catch (\PhpParser\Error $_e) {
                // Throw the original error, not the semicolon one.
                throw ParseErrorException::fromParseError($e);
            }
        }
    }
}
