<?php
namespace App\Form;

use App\Entity\PaymentProcessor;
use App\Entity\Product;
use App\Entity\Transaction;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;

class PaymentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) :void
    {
        $builder
            ->add('product', EntityType::class, array(
                'class' => Product::class,
                'choice_label'=> 'name',
                'placeholder' => 'Product Name',
                'attr' =>['class' => 'form-control',
                ]))
            ->add('taxNumber', TextType::class, [
                'label' => 'Tax Number',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('couponCode', TextType::class, [
                'label' => 'Coupon',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('paymentProcessor', EntityType::class, array(
                'class' => PaymentProcessor::class,
                'choice_label'=> 'name',
                'placeholder' => 'Payment Processor',
                'choice_value'=> 'name',
                'attr' =>['class' => 'form-control'
                ]))
            ->add('sendbtn', SubmitType::class, [
            'label' => 'Send',
            'attr' => ['class' => 'form-control'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Transaction::class,
        ]);
    }
}