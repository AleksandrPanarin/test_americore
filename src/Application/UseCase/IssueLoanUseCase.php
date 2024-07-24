<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\Service\Loan\IssueLoan;

interface IssueLoanUseCase
{
    public function execute(IssueLoan $command): void;
}
