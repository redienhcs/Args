<?php
namespace Redienhcs\Args\Classes;

use DomainException;

class Args
{
    private array $marshalers = [];
    private $previousMarshaler;

    /**
     * @throws ArgsException
     */
    public function __construct(string $schema, array $args)
    {
        unset($args[0]);
        $this->parseSchema($schema);
        $this->parseArgumentstrings($args);
    }

    /**
     * @throws ArgsException
     */
    private function parseSchema(string $schema)
    {
        foreach (explode(',', $schema) as $element) {
            if (strlen($element) > 0) {
                $this->parseSchemaElement(trim($element));
            }
        }
    }

    /**
     * @throws ArgsException
     */
    private function parseSchemaElement(string $element)
    {
        $this->validateSchemaElementId($element);

        $this->marshalers[$element] =  new MixedArgumentMashaler($element);
    }

    private function validateSchemaElementId($elementId)
    {
        if (!ctype_alpha($elementId)) {
            throw new DomainException('Nome de argumento inválido.');
        }
    }

    private function parseArgumentstrings($args)
    {

        foreach ($args as $arg) {

            if ($arg[0] == "-") {
                $this->parseArgumentCharacters(substr($arg, 1));
            } else {
                $this->previousMarshaler->setValue($arg);
            }
        }
    }

    /**
     * @throws ArgsException
     */
    private function parseArgumentCharacters(string $argChars)
    {
        if (!isset($this->marshalers[$argChars])) {
            throw new DomainException('Argumento informado não está registrado para processamento: ' . $argChars);
        }

        /** @var ArgumentMarshaler $m */
        $m = $this->marshalers[$argChars];

        $this->previousMarshaler = $m;
    }

    public function has(string $argumentName): bool
    {
        return isset($this->marshalers[$argumentName]);
    }

    /**
     * @throws ArgsException
     */
    public function getArgument(string $argumentName)
    {
        if (!isset($this->marshalers[$argumentName])) {
            throw new DomainException('Argumento informado não está registrado para processamento: ' . $argumentName);
        }

        return $this->marshalers[$argumentName]->getValue();
    }
}
