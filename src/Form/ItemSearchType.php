<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\ItemSearch;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class ,[
                'label' => false,
                'class' => Category::class,
                'choice_label' => 'name',
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Catégories'
                ]
            ])
            ->add('tag', EntityType::class ,[
                'label' => false,
                'class' => Tag::class,
                'multiple' => true,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Tags'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ItemSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }
}
