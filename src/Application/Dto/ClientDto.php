<?php

namespace App\Application\Dto;

use Symfony\Component\Validator\Constraints as Assert;

final class ClientDto
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 50)]
    public ?string $firstName = null;

    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 50)]
    public ?string $lastName = null;

    #[Assert\NotBlank]
    #[Assert\Range(min: 18, max: 120)]
    public ?int $age = null;

    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 50)]
    public ?string $city = null;

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 3)]
    public ?string $state = null;

    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 50)]
    public ?string $zipCode = null;

    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 50)]
    public ?string $ssn = null;

    #[Assert\NotBlank]
    public ?int $creditScore = null;

    #[Assert\NotBlank]
    #[Assert\Email]
    public ?string $email = null;
    #[Assert\NotBlank]
    public ?string $phone = null;

    #[Assert\NotBlank]
    public ?float $income = null;

}