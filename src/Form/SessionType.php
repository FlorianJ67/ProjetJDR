<?php

namespace App\Form;

use App\Entity\Session;
use Doctrine\DBAL\Types\TextType;
use App\Form\CollectionCompetenceType;
use Symfony\Component\Form\AbstractType;
use App\Form\CollectionCaracteristiqueType;
use App\Form\LienCompetenceCaracteristiqueType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('lienCompetenceCaracteristiques', LienCompetenceCaracteristiqueType::class)
            ->add('collectionCompetence', CollectionCompetenceType::class)
            ->add('collectionCaracteristique', CollectionCaracteristiqueType::class)
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
