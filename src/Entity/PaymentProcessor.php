<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PaymentProcessorRepository;

#[ORM\Entity(repositoryClass: PaymentProcessorRepository::class)]
#[ORM\Table(name: 'paymentProcessor')]
class PaymentProcessor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private int $id;
    #[ORM\Column()]
    private string $name;
    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }

}
