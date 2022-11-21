<?php
namespace App;

use App\Exceptions\ValidateException;
use App\Validators\ClosedParentheses;
use App\Validators\EmptyString;
use Exception;

class HttpController
{
    private string $callableName;
    private array $request;

    public function __construct()
    {
        // Take only the first part of the url as a postfix of the controller method
        $uri = ucwords(mb_strtolower(explode('/', $_SERVER['REQUEST_URI'])[1]));
        // REQUEST_METHOD controller method prefix
        $method = mb_strtolower($_SERVER['REQUEST_METHOD']);

        // Save callable and request
        $this->callableName = $method . $uri;
        $this->request = $_REQUEST;
    }

    /**
     * Запускает обработку запроса
     */
    public function run()
    {
        if (!in_array($this->callableName, get_class_methods($this))){
            header('HTTP/1.1 404 Not Found');
            echo 'Not Found';
            exit;
        }

        try {
            $this->{$this->callableName}();
        } catch (ValidateException $exception) {
            header('HTTP/1.1 400 Bad Request');
            echo $exception->getMessage();
            exit;
        }
    }

    /**
     * validate request by rules
     * Rule type: ['request_param' => [Validator1::class, Validator2::class]]
     * @param $rules
     * @throws \App\Exceptions\ValidateException
     */
    public function validate($rules)
    {
        foreach ($rules as $param => $rule) {
            if (!in_array($param, array_keys($this->request))) {
                throw new ValidateException("Has no param $param in request");
            }

            foreach ($rule as $validator) {
                (new $validator($this->request[$param]))->validate();
            }
        }
    }

    /**
     * Closed Parentheses Validation Page Method
     * @throws \App\Exceptions\ValidateException
     */
    public function postParentheses()
    {
        $validationRules = [
            'string' => [
                EmptyString::class,
                ClosedParentheses::class
            ]
        ];

        $this->validate($validationRules);

        header('HTTP/1.1 200 OK');
        echo 'OK';
        exit;
    }
}