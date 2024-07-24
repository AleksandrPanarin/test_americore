<?php


namespace App\Application\UseCase;

use App\Application\Service\Client\UpdateClient;

interface UpdateClientUseCase
{
    public function execute(UpdateClient $command): void;
}