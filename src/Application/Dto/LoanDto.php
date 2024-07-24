<?php

declare(strict_types=1);

namespace App\Application\Dto;

use Symfony\Component\Validator\Constraints as Assert;
final class LoanDto
{
    #[Assert\NotBlank]
    #[Assert\Uuid]
    public ?string $clientId = null;

    #[Assert\NotBlank]
    public ?string $type = null;

    #[Assert\NotBlank]
    public ?int $loanTerm = null;

    #[Assert\NotBlank]
    public ?string $amount = null;
}