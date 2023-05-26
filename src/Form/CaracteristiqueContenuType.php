<?php

namespace App\Form;


use App\Entity\Caracteristique;
use App\Entity\CaracteristiqueContenu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class CaracteristiqueContenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isMain', CheckboxType::class, [
                'label' => 'Principal',
                'required' => false
            ])
            ->add('valueMax', IntegerType::class, [
                'label' => 'Valeur Max (optionel)',
                'required' => false
            ])
            ->add('caracteristique', EntityType::class, [
                'class' => Caracteristique::class,
                'label' => 'Caractéristique :'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Créer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CaracteristiqueContenu::class,
        ]);
    }
}
