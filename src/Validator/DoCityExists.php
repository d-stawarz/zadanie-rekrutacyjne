<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class DoCityExists extends Constraint
{
    public string $message = 'Nie znaleziono takiego miasta. Prosimy spróbować ponownie.';
    // If the constraint has configuration options, define them as public properties
    public string $mode = 'strict';

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}