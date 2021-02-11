<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Nom de l\'utilisateur']
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Prénom de l\'utilisateur']
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Email de l\'utilisateur']
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Mot de passe de l\'utilisateur']
            ])
            ->add('num_intervenant', TextType::class, [
                'label' => 'Numéro d\'intervenant',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Numéro d\'intervenant de l\'utilisateur']
            ])
            ->add('portable', TextType::class, array('required' => false), [
                'label' => 'Numéro de téléphone portable',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Numéro de téléphone portable de l\'utilisateur']
            ])
            ->add('fixe', TextType::class, array('required' => false), [
                'label' => 'Numéro de téléphone fixe',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Numéro de téléphone fixe de l\'utilisateur']
            ])
            ->add('TypeDuContrat', ChoiceType::class, [
                'label' => 'Type de Contrat',
                'attr' => ['class' => 'form-control'],
                'choices' => [
                    'CDD' => 'CDD',
                    'CDI' => 'CDI',
                    'Contrat d\'apprentissage' => 'Contrat d\'apprentissage',
                    'Contrat de professionnalisation' => 'Contrat de professionnalisation'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
