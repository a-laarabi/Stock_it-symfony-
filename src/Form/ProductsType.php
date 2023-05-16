<?php

namespace App\Form;

use App\Entity\Products;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



use function PHPSTORM_META\type;

class ProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('productPicture')
            /*
            ->add('productPicture', TextType::class, [
                'row_attr' => ['class' => 'mb-3'],
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ])
            */
            ->add('productPicture', FileType::class, [
                'row_attr' => ['class' => 'mb-3'],
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ])


            ->add('productName', null, [
                'row_attr' => ['class' => 'mb-3'],
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ])
            ->add('quantity', null, [
                'row_attr' => ['class' => 'mb-3'],
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ])
            ->add('price', null, [
                'row_attr' => ['class' => 'mb-3'],
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ])

            /*
            ->add('created_at', null, [
                'row_attr' => ['class' => 'mb-3'],
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ])
            */

            ->add('productDescription', null, [
                'row_attr' => ['class' => 'mb-3'],
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ])
            ->add('type', null, [
                'row_attr' => ['class' => 'mb-3'],
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ])
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'type',
                'row_attr' => ['class' => 'mb-3'],
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // 'data_class' => null,
            'data_class' => Products::class,
        ]);
    }
}
