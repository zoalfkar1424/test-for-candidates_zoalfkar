<?php
namespace App\Repository;

use App\Entity\Countrytax;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }
    public function getProductByid($productid)
    {
        $product =  $this->find($productid);
        if($product != null)
        {
            return $product;
        }
        else
        {
            return null;
        }

    }
}