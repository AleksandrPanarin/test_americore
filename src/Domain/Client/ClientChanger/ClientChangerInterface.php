<?php

declare(strict_types=1);

namespace App\Domain\Client\ClientChanger;

interface ClientChangerInterface
{
    public function changeClientData(ChangeClientInput $input): void;
}