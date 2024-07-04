<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\RapportVeterinaire;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportVeterinaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            ->add('detail',  ChoiceType::class, [
                'choices' => [
                    'Trés malade' => 'Trés malade',
                    'Malade' => 'Malade',
                    'En guerison' => 'En guerison',
                    'Bien' => 'Bien',
                    'Trés bien' => 'Trés bien',
                    'En super forme' => 'En super forme',
                ]
            ])

            ->add('foodoffered')
            ->add('foodquantity')
            ->add('conditiondetails')
            ->add('animal', EntityType::class, [
                'class' => Animal::class,
                'choice_label' => 'prenom',
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'lastname',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RapportVeterinaire::class,
        ]);
    }
}
