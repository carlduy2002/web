<?php
namespace App\Form\Type;

use App\Entity\Shop;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Exception\Core\Type\SubmitType;
use Symfony\Component\Form\Exception\Core\Type\EmailType;
use Symfony\Component\Form\Exception\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;    
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Shop::class
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('id', TextType::class)
        ->add('Name', TextType::class)
        ->add('Email', EmailType::class)
        ->add('Address', TextType::class)
        ->add('Phone', TextType::class)
        ->add('add', SubmitType::class, [
            'label' => 'add'
        ]);
    }
}