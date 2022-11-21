<?php
namespace Unit;

use App\Validators\EmptyString;
use PHPUnit\Framework\TestCase;

class EmptyStringValidatorTest extends TestCase
{
    /**
     * Needed success on validation of words
     * @throws \App\Exceptions\ValidateException
     */
    public function testValidateSuccess(): void
    {
        $result = (new EmptyString('anything words'))->validate();

        $this->assertTrue($result);
    }

    /**
     * Needed fail on validation of words
     */
    public function testValidateFail(): void
    {
        try {
            (new EmptyString(''))->validate();
            $this->fail();
        } catch (\App\Exceptions\ValidateException $exception) {
            $this->assertTrue(true);
        }
    }
}