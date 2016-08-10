<?php

namespace FP\Kata\Validator;

class SameType extends AbstractValidator
{
    const TYPE_MESSAGE  = 'All values have to be the same type';
    const CLASS_MESSAGE = 'All values have to be the same class';

    private $types   = array();
    private $classes = array();

    public function __construct(array $values)
    {
        foreach ($values as $value) {
            if ('object' === gettype($value)) {
                $this->classes[] = get_class($value);
            }
            $this->types[] = gettype($value);
        }
    }

    public function isValid() : bool
    {
        if (count(array_unique($this->types)) === 1) {
            if (count($this->classes) > 0) {
                return $this->identicalObject();
            }
            return true;
        }

        $this->errors[] = self::TYPE_MESSAGE;
        return false;
    }

    private function identicalObject() : bool
    {
        if (count(array_unique($this->classes)) === 1) {
            return true;
        } else {
            $this->errors[] = self::CLASS_MESSAGE;
            return false;
        }
    }
}