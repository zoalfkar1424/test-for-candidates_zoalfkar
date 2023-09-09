<?php

namespace App\Controller;

use App\Entity\Countrytax;
use App\Entity\Coupon;
use App\Entity\Product;
use App\Entity\Transaction;
use App\Repository\CountrytaxRepository;
use App\Repository\CouponRepository;
use App\Repository\ProductRepository;
use ContainerEYVi0xe\getConsole_ErrorListenerService;
use Doctrine\ORM\EntityManagerInterface;
use PaymentProcessor\PaypalPaymentProcessor;
use PaymentProcessor\StripePaymentProcessor;
use SebastianBergmann\ObjectReflector\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;
use function Symfony\Component\VarDumper\Dumper\esc;

class TransactionController extends AbstractController
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
    public function calculatePrice($price,$tax,$coupon)
    {
        if($coupon!=null) {
            if($coupon->getType()==0) {
                return $price + $tax * $price * 0.01 - $coupon->getVal();
            }
            else
            {
                $priceAfterTax = $price + $tax * $price * 0.01;
                return $priceAfterTax - $coupon->getVal() * $priceAfterTax * 0.01;
            }
        }
        else{
            return $price + $tax * $price * 0.01;
        }
    }
    public function returnJson($success,$message,$data,$code):JsonResponse
    {
        return new JsonResponse(['success' => $success, 'message' => $message,'data'=>$data, 'code' =>$code ]);
    }
    public function checkProduct($productid)
    {
            return $this->productRepo->getProductByid($productid);
    }
    public function checkCoupon($couponCode)
    {
        return $this->couponRepo->getCouponBycode($couponCode);
    }
    public function checkCountrytax($taxNumber)
    {
            if(strlen($taxNumber)>1) {

                $InputTaxCodeCountry = u($taxNumber)->truncate(2);

                $InputTaxCodeDigits = u($taxNumber)->slice(2, strlen($taxNumber));

                $country = $this->countryRepo->getCountryBycode($InputTaxCodeCountry);
                if ($this->checkTaxnum($country, $InputTaxCodeDigits)) {
                    return $country;
                } else {
                    return null;
                }
            }
            else
            {
                return null;
            }
    }
    public function checkTaxnum($country,$InputTaxCodeDigits)
    {
        if($country!=null) {
            $countryYPart = $country->getYpart();
            $countryXPart = $country->getXpart();

            $inputYPart = u($InputTaxCodeDigits)->truncate($countryYPart);
            $inputXPart = u($InputTaxCodeDigits)->slice($countryYPart, strlen($InputTaxCodeDigits));

            if ($countryXPart == strlen($inputXPart)) {
                if ((strlen($inputYPart) ==0 || \ctype_alpha("" . $inputYPart)) && is_numeric("" . $inputXPart)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        else
            return false;
    }
    #[Route('Transaction/getPrice', name: 'getPrice',methods: ['POST'])]
    public function getPrice(Request $storeTransactionRequest) :JsonResponse
    {
        $productid = $storeTransactionRequest->get('product');
        $taxNumber = $storeTransactionRequest->get('taxNumber');
        $couponCode = $storeTransactionRequest->get('couponCode');
        $couponval = 0;
        $product= $this->checkProduct($productid);
        if($product==null)
        {
            return $this->returnJson(false, 'check your product number', null, '400');
        }
        if($couponCode!=null) {
            $coupon = $this->checkCoupon($couponCode);
            if($coupon!=null)
            {
                $couponval=$coupon->getVal();
            }
            else
            {
                return $this->returnJson(false, 'check your Coupon Code', null, '400');
            }
        }
        $countrytax = $this->checkCountrytax($taxNumber);
        if($countrytax != null) {
            $finalprice = $this->calculatePrice($product->getPrice(), $countrytax->getTaxval(), $coupon);
            return $this->returnJson(true, 'Price: ', $finalprice, '200');
        }
        else
        {
            return $this->returnJson(false, 'check your Tax Number', null, '400');
        }
    }
    #[Route('Transaction/payment', name: 'payment',methods: ['POST'])]
    public function paymentrequest(Request $storeTransactionRequest):JsonResponse
    {
        $paymentProcessor = $storeTransactionRequest->get('paymentProcessor');
        $price = $storeTransactionRequest->get('price');

        if($price>0 && $paymentProcessor != null) {
            if ($paymentProcessor == "paypal") {
                $paypal = new PaypalPaymentProcessor();
                try {
                    $paypal->pay($price);
                    return $this->returnJson(true, 'Paypal Paid Successfully', $price, '200');
                }
                catch (\Exception $exception)
                {
                    return $this->returnJson(false,  $exception->getMessage(), null, '400');
                }

            } else if($paymentProcessor == "stripe") {

                $strip = new StripePaymentProcessor();

                if ($strip->processPayment($price)) {
                    return $this->returnJson(true, 'Stripe Paid Successfully', $price, '200');
                } else {
                    return $this->returnJson(false, 'check Price', null, '400');
                }

            }
            else{
                return $this->returnJson(false, 'check Input', null, '400');
            }
        }
        else
        {
            return $this->returnJson(false, 'check Input', null, '400');
        }

    }


    public function index()
    {
    }


    public function show(Transaction $Transaction)
    {
    }
    public function update(Request $updateTransactionRequest, $Transaction)
    {
    }
    public function destroy($Transaction)
    {
    }

}
