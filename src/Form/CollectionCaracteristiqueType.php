<?php

namespace App\Form;

use App\Entity\CaracteristiqueContenu;
use Symfony\Component\Form\AbstractType;
use App\Entity\CollectionCaracteristique;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CollectionCaracteristiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('caracteristiqueContenus')
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
