<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\CollectionCompetence;
use Symfony\Component\Form\AbstractType;
use App\Entity\CollectionCaracteristique;
use App\Form\CollectionCaracteristiqueType;
use App\Entity\LienCompetenceCaracteristique;
use App\Form\LienCompetenceCaracteristiqueType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)

            ->add('collectionCompetence', EntityType::class, [
                'class' => CollectionCompetence::class,
                'choice_label' => 'competence'
                ])
            ->add('collectionCaracteristique', EntityType::class, [
                'class' => CollectionCaracteristique::class,
                'choice_label' => 'caracteristique'
                ])
            ->add('lienCompetenceCaracteristiques', EntityType::class, [
                'class' => LienCompetenceCaracteristique::class,
                'choice_label' => 'lienCaracteristiqueCompetence'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Créer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
