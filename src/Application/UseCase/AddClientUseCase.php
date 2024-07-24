<?php

namespace App\Application\UseCase;

use App\Application\Service\Client\AddClient;

interface AddClientUseCase
{
    public function execute(AddClient $command): void;
}