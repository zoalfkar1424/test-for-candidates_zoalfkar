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
    public function index()
    {
    }

    public function getByCode($CountryTaxCode)
    {
        $countrytax = $this->countryTaxRepo->findOneBy(['code'=>$CountryTaxCode]);
        return $countrytax;
    }
    public function store(Request $storeCountrytaxRequest)
    {
    }

    public function show(Countrytax $Countrytax)
    {
    }
    public function update(Request $updateCountrytaxRequest, $Countrytax)
    {
    }
    public function destroy($Countrytax)
    {
    }
}
