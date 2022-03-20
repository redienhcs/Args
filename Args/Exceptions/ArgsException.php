<?php
namespace Redienhcs\Args\Exceptions;

use Exception;

class ArgsException extends Exception
{
    private string $errorArgumentId = '\0';
    private String $errorParameter = '';
    private int $errorCode = self::OK;

    const OK = 1;
    const UNEXPECTED_ARGUMENT = 2;
    const MISSING_STRING = 3;
    const INVALID_INTEGER = 4;
    const MISSING_INTEGER = 5;
    const INVALID_DOUBLE = 6;
    const MISSING_DOUBLE = 7;
    const INVALID_ARGUMENT_NAME = 8;
    const INVALID_ARGUMENT_FORMAT = 9;

    public function __construct(int $errorCode, string $errorArgumentId, string $errorParameter)
    {
        $this->errorCode = $errorCode;
        $this->errorParameter = $errorParameter;
        $this->errorArgumentId = $errorArgumentId;
    }

    public function getErrorArgumentId(): string
    {
        return $this->errorArgumentId;
    }

    public function setErrorArgumentId(string $errorArgumentId)
    {
        $this->errorArgumentId = $errorArgumentId;
    }
    public function getErrorParameter(): string
    {
        return $this->errorParameter;
    }

    public function setErrorParameter(string $errorParameter)
    {
        $this->errorParameter = $errorParameter;
    }

    public function  getErrorCode(): int
    {
        return $this->errorCode;
    }

    public function setErrorCode(int $errorCode)
    {

        $this->errorCode = $errorCode;
    }

    public function errorMessage(): string
    {
        switch ($this->errorCode) {
            case self::OK:
                return "TILT: Should not get here.";
            case self::UNEXPECTED_ARGUMENT:
                return "Argument -{$this->errorArgumentId} unexpected.";
            case self::INVALID_ARGUMENT_NAME:
                return "'{$this->errorArgumentId}' is not a valid argument name.";
            case self::INVALID_ARGUMENT_FORMAT:
                return "'{$this->errorParameter}' is not a valid argument format.";
        }

        return "";
    }
}
