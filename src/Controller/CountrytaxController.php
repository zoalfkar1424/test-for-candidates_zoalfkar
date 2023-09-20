<?php

namespace App\Controller;
use App\Entity\Countrytax;
use App\Repository\CountrytaxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CountrytaxController extends AbstractController
{
    private $countryTaxRepo;
    public function __construct(CountrytaxRepository $repository)
    {
        $this->countryTaxRepo = $repository;
    }

    public function getByCode($CountryTaxCode)
    {
        $countrytax = $this->countryTaxRepo->findOneBy(['code'=>$CountryTaxCode]);
        return $countrytax;
    }
}
