<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function    symfony\component\translation\t;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => t("Email"),
            ])
            ->add('roles', ChoiceType::class, [
                'label' => t("Roles"),
                'expanded' => true,
                'multiple' => true,
                'required' => true,
                'choices' => [
                    'Vétérinaire' => 'ROLE_VETERINAIRE',
                    'Employer' => 'ROLE_EMPLOYER',
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => t("Mot de passe"),
                'hash_property_path' => 'password',
                'mapped' => false,
            ])
            ->add('lastname', null,[
                'label' => t("Nom"),
            ])
            ->add('firstname', null,[
                'label' => t("Prénom"),
            ])
            ->add('submit', SubmitType::class, [
                'label' => t('Enregistrer'),
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
