<?php declare(strict_types=1);

namespace PhpParser;

<<<<<<< HEAD
class Error extends \RuntimeException
{
    protected $rawMessage;
    protected $attributes;
=======
class Error extends \RuntimeException {
    protected string $rawMessage;
    /** @var array<string, mixed> */
    protected array $attributes;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Creates an Exception signifying a parse error.
     *
<<<<<<< HEAD
     * @param string    $message    Error message
     * @param array|int $attributes Attributes of node/token where error occurred
     *                              (or start line of error -- deprecated)
     */
    public function __construct(string $message, $attributes = []) {
        $this->rawMessage = $message;
        if (is_array($attributes)) {
            $this->attributes = $attributes;
        } else {
            $this->attributes = ['startLine' => $attributes];
        }
=======
     * @param string $message Error message
     * @param array<string, mixed> $attributes Attributes of node/token where error occurred
     */
    public function __construct(string $message, array $attributes = []) {
        $this->rawMessage = $message;
        $this->attributes = $attributes;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        $this->updateMessage();
    }

    /**
     * Gets the error message
     *
     * @return string Error message
     */
<<<<<<< HEAD
    public function getRawMessage() : string {
=======
    public function getRawMessage(): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return $this->rawMessage;
    }

    /**
     * Gets the line the error starts in.
     *
     * @return int Error start line
<<<<<<< HEAD
     */
    public function getStartLine() : int {
=======
     * @phpstan-return -1|positive-int
     */
    public function getStartLine(): int {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return $this->attributes['startLine'] ?? -1;
    }

    /**
     * Gets the line the error ends in.
     *
     * @return int Error end line
<<<<<<< HEAD
     */
    public function getEndLine() : int {
=======
     * @phpstan-return -1|positive-int
     */
    public function getEndLine(): int {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return $this->attributes['endLine'] ?? -1;
    }

    /**
     * Gets the attributes of the node/token the error occurred at.
     *
<<<<<<< HEAD
     * @return array
     */
    public function getAttributes() : array {
=======
     * @return array<string, mixed>
     */
    public function getAttributes(): array {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return $this->attributes;
    }

    /**
     * Sets the attributes of the node/token the error occurred at.
     *
<<<<<<< HEAD
     * @param array $attributes
     */
    public function setAttributes(array $attributes) {
=======
     * @param array<string, mixed> $attributes
     */
    public function setAttributes(array $attributes): void {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        $this->attributes = $attributes;
        $this->updateMessage();
    }

    /**
     * Sets the line of the PHP file the error occurred in.
     *
     * @param string $message Error message
     */
<<<<<<< HEAD
    public function setRawMessage(string $message) {
=======
    public function setRawMessage(string $message): void {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        $this->rawMessage = $message;
        $this->updateMessage();
    }

    /**
     * Sets the line the error starts in.
     *
     * @param int $line Error start line
     */
<<<<<<< HEAD
    public function setStartLine(int $line) {
=======
    public function setStartLine(int $line): void {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        $this->attributes['startLine'] = $line;
        $this->updateMessage();
    }

    /**
     * Returns whether the error has start and end column information.
     *
     * For column information enable the startFilePos and endFilePos in the lexer options.
<<<<<<< HEAD
     *
     * @return bool
     */
    public function hasColumnInfo() : bool {
=======
     */
    public function hasColumnInfo(): bool {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return isset($this->attributes['startFilePos'], $this->attributes['endFilePos']);
    }

    /**
     * Gets the start column (1-based) into the line where the error started.
     *
     * @param string $code Source code of the file
<<<<<<< HEAD
     * @return int
     */
    public function getStartColumn(string $code) : int {
=======
     */
    public function getStartColumn(string $code): int {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        if (!$this->hasColumnInfo()) {
            throw new \RuntimeException('Error does not have column information');
        }

        return $this->toColumn($code, $this->attributes['startFilePos']);
    }

    /**
     * Gets the end column (1-based) into the line where the error ended.
     *
     * @param string $code Source code of the file
<<<<<<< HEAD
     * @return int
     */
    public function getEndColumn(string $code) : int {
=======
     */
    public function getEndColumn(string $code): int {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        if (!$this->hasColumnInfo()) {
            throw new \RuntimeException('Error does not have column information');
        }

        return $this->toColumn($code, $this->attributes['endFilePos']);
    }

    /**
     * Formats message including line and column information.
     *
     * @param string $code Source code associated with the error, for calculation of the columns
     *
     * @return string Formatted message
     */
<<<<<<< HEAD
    public function getMessageWithColumnInfo(string $code) : string {
=======
    public function getMessageWithColumnInfo(string $code): string {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return sprintf(
            '%s from %d:%d to %d:%d', $this->getRawMessage(),
            $this->getStartLine(), $this->getStartColumn($code),
            $this->getEndLine(), $this->getEndColumn($code)
        );
    }

    /**
     * Converts a file offset into a column.
     *
     * @param string $code Source code that $pos indexes into
<<<<<<< HEAD
     * @param int    $pos  0-based position in $code
     *
     * @return int 1-based column (relative to start of line)
     */
    private function toColumn(string $code, int $pos) : int {
=======
     * @param int $pos 0-based position in $code
     *
     * @return int 1-based column (relative to start of line)
     */
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

    /**
     * Updates the exception message after a change to rawMessage or rawLine.
     */
<<<<<<< HEAD
    protected function updateMessage() {
=======
    protected function updateMessage(): void {
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        $this->message = $this->rawMessage;

        if (-1 === $this->getStartLine()) {
            $this->message .= ' on unknown line';
        } else {
            $this->message .= ' on line ' . $this->getStartLine();
        }
    }
}
