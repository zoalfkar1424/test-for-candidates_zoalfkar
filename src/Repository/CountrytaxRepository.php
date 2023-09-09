<?php
namespace App\Repository;

use App\Entity\Countrytax;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CountrytaxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Countrytax::class);
    }
    public function getCountryBycode($countryid)
    {
        $country = $this->findOneBy(['code' => $countryid]);
        if($country != null)
        {
            return $country;
        }
        else
        {
            return null;
        }
    }
}