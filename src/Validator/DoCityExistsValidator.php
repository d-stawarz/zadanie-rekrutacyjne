<?php

namespace App\Validator;

use App\Service\Api\GeoCodeEarth\GeoCodeApiClient;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

#[\Attribute]
class DoCityExistsValidator extends ConstraintValidator
{
    public function __construct(private readonly GeoCodeApiClient $geoCodeApiClient) { }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$this->geoCodeApiClient->doCityExists($value->getLat(), $value->getLon())) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}