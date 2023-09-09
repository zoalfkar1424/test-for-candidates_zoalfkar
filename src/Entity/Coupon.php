<?php

namespace App\Entity;
use App\Repository\CouponRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CouponRepository::class)]
#[ORM\Table(name: 'coupons')]
class Coupon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private int $id;
    #[ORM\Column(length:3)]
    private string $code;
    #[ORM\Column()]
    private bool $type;
    #[ORM\Column()]
    private float $val;

    public function getId(): int
    {
        return $this->id;
    }
    public function getCode(): string
    {
        return $this->code;
    }
    public function getType(): bool
    {
        return $this->type;
    }
    public function getVal(): int
    {
        return $this->val;
    }

}
