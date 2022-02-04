<?php
/**
 * Created by PhpStorm.
 * User: starwox
 * Date: 03/02/2022
 * Time: 19:04
 */

namespace App\Form\Type;


use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use function Symfony\Component\Form\ChoiceList\label;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['hidden']) {
            $rolesTypes = array_flip(User::ROLES_TYPES);
            $rolesUsers = array_flip(User::ROLES_USER);
            $choices = array_merge($rolesTypes, $rolesUsers);
        } else {
            $choices = array_flip(User::ROLES_TYPES);
        }

        $builder
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
            ])
            ->add('username', TextType::class, [
                'label' => 'Pseudonyme'
            ])
            ->add('roles', ChoiceType::class, [
                'label' => 'Vous êtes:',
                'multiple' => true,
                'expanded' => true,
                'choices' => $choices
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'hidden' => false,
        ]);
    }
}