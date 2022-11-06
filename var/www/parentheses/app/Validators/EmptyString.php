<?php
namespace App\Validators;

use App\Contracts\Validator;
use App\Exceptions\ValidateException;

/**
 * Validation of non-empty strings
 */
class EmptyString implements Validator
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
        if ($this->txt === '') {
            throw new ValidateException('String is empty');
        }

        return true;
    }
}