<?php

namespace App\Form;

use App\DTO\ContactDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function    symfony\component\translation\t;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => t('Nom'),
                'empty_data' => '',
            ])
            ->add('email', EmailType::class, [
                'label' => t('Email'),
                'empty_data' => '',
            ])
            ->add('title', TextType::class, [
                'label' => t('Titre'),
                'empty_data' => '',
            ])
            ->add('message', TextareaType::class, [
                'label' => t('Message'),
                'empty_data' => '',
            ])
            ->add('submit', SubmitType::class, [
                'label' => t('Envoyer'),
                'attr' => ['class' => 'btn btn-outline-dark mt-4']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactDTO::class,
        ]);
    }
}
