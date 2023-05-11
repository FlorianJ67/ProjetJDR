<?php

namespace App\Form;

use App\Entity\CharacterStats;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class CharacterStatsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('info', CollectionType::class)
            ->add('caracteristique', CollectionType::class, [
                // each entry in the array will be an "email" field
                'entry_type' => TextType::class,
                // these options are passed to each "email" type
                'entry_options' => [
                    'attr' => ['class' => 'session'],
                ],
            ])
            ->add('competence', CollectionType::class)
            ->add('inventaire', CollectionType::class)
            ->add('statsAdditionnel', CollectionType::class)
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CharacterStats::class,
        ]);
    }
}
