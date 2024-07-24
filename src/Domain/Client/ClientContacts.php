<?php

declare(strict_types=1);

namespace App\Domain\Client;

use Doctrine\ORM\Mapping\Embeddable;
use InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;

#[Embeddable]
final class ClientContacts
{
    #[ORM\Column(length: 255, nullable: false)]
    private string $email;

    #[ORM\Column(length: 255, nullable: false)]
    private string $phone;

    public function __construct(string $email, string $phone)
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL, FILTER_FLAG_EMAIL_UNICODE)) {
            throw new InvalidArgumentException(sprintf('Value "%s" was expected to be a valid e-mail address.', $email));
        }

        $this->email = strtolower($email);
        $this->phone = $phone;
    }

    public function email(): string
    {
        return $this->email;
    }
}