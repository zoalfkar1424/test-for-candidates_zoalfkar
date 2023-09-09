<?php
namespace App\Repository;
use App\Entity\Coupon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CouponRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coupon::class);
    }
    public function getCouponBycode($couponcode)
    {
        $coupon = $this->findOneBy(['code' => $couponcode]);

        if($coupon != null)
        {
            return $coupon;
        }
        else
        {
            return null;
        }
    }
}