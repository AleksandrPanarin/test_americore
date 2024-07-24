<?php


namespace App\Application\UseCase;

use App\Application\Service\Loan\IssueLoan;

interface IssueLoanUseCase
{
    public function execute(IssueLoan $command): void;
}
