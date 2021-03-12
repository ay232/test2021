<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class ValidationException extends Exception
{
    /**
     * @var
     */
    private $validationErrors;

    public function __construct($validationErrors)
    {
        parent::__construct("Ошибка валидации", 0, null);
        $this->validationErrors = $validationErrors;
    }

    /**
     * @return array
     */
    public function getValidationErrors()
    {
        return $this->validationErrors;
    }

}
