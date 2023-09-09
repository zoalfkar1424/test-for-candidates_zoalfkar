<?php

namespace App\Controller;

use App\Entity\Coupon;

use App\Repository\CouponRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CrudController extends AbstractController
{
    public function index()
    {
    }
    public function store(Request $storeTaxRequest)
    {
    }

    public function show(Coupon $Coupon)
    {
    }
    public function update(Request $updateTaxRequest, $Tax)
    {
    }
    public function destroy($Tax)
    {
    }
}
