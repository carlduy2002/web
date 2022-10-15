<?php
namespace App\Form\Type;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Shop;
use App\Entity\Supplier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class
        ]);
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('Name', TextType::class)
        ->add('Quantity', TextType::class)
        ->add('Original_Price', TextType::class, [
            'attr' => ['onkeydown'=>"javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'"
        ]
        ])
        ->add('Sale_Price', TextType::class, [
            'attr' => ['onkeydown'=>"javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'"
        ]
        ])
        // ->add('Detail', TextType::class)
        ->add('Pro_Image', FileType::class, [
            'label' => 'Image',
            'data_class' => null
        ])
        ->add('Supplier_ID', EntityType::class, [
            'class' => Supplier::class,
            'choice_label' => 'id',
            'label' => 'Supplier'
        ])
        ->add('Shop_ID', EntityType::class, [
            'class' => Shop::class,
            'choice_label' => 'id',
            'label' => 'Shop'
        ])
        ->add('Category_ID', EntityType::class, [
            'class' => Category::class,
            'choice_label' => 'id',
            'label' => 'Category'
        ])
        ->add('Status', TextType::class)
        ->add('add', SubmitType::class, [
            'label' => 'add'
        ]);

    }
}
?>