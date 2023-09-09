<?php

namespace App\Entity;


use App\Repository\TransactionRepository;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity(repositoryClass: TransactionRepository::class)]
#[ORM\Table(name: 'transactions')]
class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private int $id;
    #[ORM\Column()]
    private int $productid;
    #[ORM\Column()]
    private int $countrytaxid;
    #[ORM\Column()]
    private int $couponid;
    #[ORM\Column()]
    private int $paymentProcessorid;

}
