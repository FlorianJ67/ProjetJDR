<?php

namespace App\Form;

use App\Form\CaracteristiqueContenuType;
use Symfony\Component\Form\AbstractType;
use App\Entity\CollectionCaracteristique;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CollectionCaracteristiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isMain')
            ->add('caracteristiqueContenus', CaracteristiqueContenuType::class)
            ->add('submit', SubmitType::class, [
                'label' => 'Créer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CollectionCaracteristique::class,
        ]);
    }
}
