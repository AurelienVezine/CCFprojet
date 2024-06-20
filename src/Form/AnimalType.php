<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Habitat;
use App\Entity\Race;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom')
            ->add('description', TextareaType::class)
            ->add('imageFile', VichImageType::class, [
                'required' => false,
            ])
            ->add('etat', ChoiceType::class, [
                'choices' => [
                    'Trés malade' => 'Trés malade',
                    'Malade' => 'Malade',
                    'En guerison' => 'En guerison',
                    'Bien' => 'Bien',
                    'Trés bien' => 'Trés bien',
                    'En super forme' => 'En super forme',
                    ]
            ])
            ->add('race', EntityType::class, [
                'class' => Race::class,
                'choice_label' => 'label',
            ])
            ->add('habitat', EntityType::class, [
                'class' => Habitat::class,
                'choice_label' => 'nom',
            ])
            ->add('updatedAt', null, [
                'widget' => 'single_text',
                'label'=> 'Mis à jour le:',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
