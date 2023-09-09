<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\CalculatorType;
use App\Form\PaymentFormType;
use App\Repository\CountrytaxRepository;
use App\Repository\CouponRepository;
use App\Repository\ProductRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $countryRepo;
    private $productRepo;
    private $couponRepo;
    public function __construct(ProductRepository $productrep,CountrytaxRepository $countryrep,CouponRepository $couponrep)
    {
        $this->countryRepo = $countryrep;
        $this->couponRepo = $couponrep;
        $this->productRepo=$productrep;
    }
    #[Route('/index', name: 'index')]
    public function index()
    {
        $form = $this->createForm(PaymentFormType::class);

        return $this->render('index.html.twig', [
            'form' => $form->createView(),
        ]);

    }
    public function store(Request $storeProductRequest)
    {
    }

    public function show(Product $Product)
    {
    }
    public function update(Request $updateProductRequest, $Product)
    {
    }
    public function destroy($Product)
    {
    }

}
