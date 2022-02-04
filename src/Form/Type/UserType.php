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
        $builder
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)
            ->add('username', TextType::class)
            ->add('roles', ChoiceType::class, [
                'label' => 'Vous êtes:',
                'multiple' => true,
                'expanded' => true,
                'choices' => array_flip(User::ROLES_TYPES)
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}