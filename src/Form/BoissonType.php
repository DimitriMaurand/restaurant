<?php

namespace App\Form;

use App\Entity\Allergene;
use App\Entity\Boisson;
use App\Entity\CategorieBoisson;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BoissonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => ['class' => 'block w-full mb-4 mt-2  rounded-md border-0 py-1.5 text-gray-900 shadow ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6'],
            ])
            ->add('appelation', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'block w-full mb-4 mt-2  rounded-md border-0 py-1.5 text-gray-900 shadow ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6'],
            ])
            ->add('annee', IntegerType::class, [
                'required' => false,
                'attr' => [

                    'class' => 'block w-full mb-4 mt-2 rounded-md border-0 py-1.5 text-gray-900 shadow ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text sm:leading-6',
                    'value' => 2000,
                ],
            ])
            ->add('composition', TextareaType::class, [
                'attr' => ['rows' => '10', 'class' => 'block w-full row-20 mb-4 mt-2 rounded-md border-0 py-1.5 text-gray-900 shadow ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6'],
                'required' => false,
            ])
            ->add('volume', NumberType::class, [
                'attr' => ['class' => 'block w-full mb-4 mt-2 rounded-md border-0 py-1.5 text-gray-900 shadow ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text sm:leading-6'],
            ])
            ->add(
                'prix',
                MoneyType::class,
                [
                    'currency' => 'EUR',
                    'attr' => [
                        'class' => 'block w-full mb-4 mt-2 rounded-md border-0 py-1.5 text-gray-900 shadow ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text sm:leading-6',
                    ],
                ]
            )
            ->add('estAlcolisee', CheckboxType::class, [

                'required' => false,
                'attr' => ['class' => 'block  mb-4 mt-2  py-1.5  shadow ring-1 ring-inset ring-gray-300  focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text sm:leading-6'],
            ])
            ->add('disponible', CheckboxType::class, [

                'required' => false,
                'attr' => ['class' => 'block  mb-4 mt-2  py-1.5  shadow ring-1 ring-inset ring-gray-300  focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text sm:leading-6'],
            ])
            ->add('allergenes', EntityType::class, [
                'class' => Allergene::class,
                'choice_label' => 'nom',
                'multiple' => true,

                'attr' => ['class' => 'block w-full mb-4 mt-2 rounded-md border-0 py-1.5 text-gray-900 shadow ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6'],

            ])
            ->add('categorieBoisson', EntityType::class, [
                'class' => CategorieBoisson::class,
                'choice_label' => 'nom',
                'attr' => ['class' => 'block w-full mb-4 mt-2 rounded-md border-0 py-1.5 text-gray-900 shadow ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6'],

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Boisson::class,
        ]);
    }
}
