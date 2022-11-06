<?php
namespace App\Contracts;

interface Validator
{
    /**
     * Validate params in construct method and return bool or validation exception
     * @return bool
     * @throws \App\Exceptions\ValidateException
     */
    function validate(): bool;
}