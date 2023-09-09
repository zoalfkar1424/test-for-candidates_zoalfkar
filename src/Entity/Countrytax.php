<?php

namespace App\Entity;
use App\Repository\CountrytaxRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity(repositoryClass: CountrytaxRepository::class)]
#[ORM\Table(name: 'countriestaxes')]
class Countrytax
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private int $id;
    #[ORM\Column()]
    private string $name;
    #[ORM\Column()]
    private string $code;
    #[ORM\Column()]
    private int $xpart;
    #[ORM\Column()]
    private int $ypart;
    #[ORM\Column()]
    private float $taxval;

    public function getId(): int
    {
        return $this->id;
    }
    public function getCode(): string
    {
        return $this->code;
    }
    public function getXpart(): int
    {
        return $this->xpart;
    }
    public function getYpart(): string
    {
        return $this->ypart;
    }
    public function getTaxval(): float
    {
        return $this->taxval;
    }
    public function getName(): string
    {
        return $this->name;
    }

}
