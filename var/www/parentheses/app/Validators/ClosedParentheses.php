<?php
namespace App\Validators;

use App\Contracts\Validator;
use App\Exceptions\ValidateException;

/**
 * Validation for the correctness of the number of open and closed brackets
 */
class ClosedParentheses implements Validator
{
    /** @var string Checked text */
    private string $txt;

    public function __construct(string $txt)
    {
        $this->txt = $txt;
    }

    /**
     * @inheritdoc
     */
    function validate(): bool
    {
        $openParentheses = 0;

        foreach (str_split($this->txt) as $i => $char) {
            if ($char == '(') {
                $openParentheses++;
            } else if ($char == ')') {
                $openParentheses--;
            }

            if ($openParentheses < 0) {
                $leftText = substr($this->txt, 0, $i);
                $rightText = substr($this->txt, -1, strlen($this->txt) - $i);
                throw new ValidateException("Not opened parentheses in '{$leftText}*here*{$rightText}'");
            }
        }

        if ($openParentheses > 0) {
            throw new ValidateException("Not closed parentheses in '{$this->txt}*here*'");
        }

        return true;
    }
}