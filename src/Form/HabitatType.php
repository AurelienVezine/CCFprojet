<?php

namespace App\Form;

use App\Entity\Habitat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class HabitatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description', TextareaType::class)
            ->add('imageFile', VichImageType::class, [
                'required' => false,
            ])
            ->add('commentaire',)
            ->add('etat', ChoiceType::class, [
                'choices' => [
                    'En super mauvais état' => 'En super mauvais état',
                    'Trés Mauvais' => 'Trés Mauvais',
                    'Mauvais' => 'Mauvais',
                    'Bien' => 'Bien',
                    'Trés bien' => 'Trés bien',
                    'En super état' => 'En super état',
                ]
            ])
            ->add('CreatedAt', null, [
                'widget' => 'single_text',
                'label'=> 'Mis à jour le:',
            ])
            ->add('save', SubmitType::class, ['label' => 'Enregistrer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Habitat::class,
        ]);
    }
}
