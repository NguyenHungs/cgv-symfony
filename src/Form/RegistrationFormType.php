<?php

namespace App\Form;

use App\Entity\User;
use Eccube\Form\Validator\Email;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'attr' => ['class' => 'form-control form-control-user','placeholder'=>'Username'],
                'label' => false,
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'max' => 10,
                    ]),
                ],
            ]) 
            ->add('email', EmailType::class, [
                'label' => false,
                'required' => true,
                'attr' => ['class' => 'form-control form-control-user','placeholder'=>'Email Address'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a email',
                    ]),
                ],
                ])
            ->add('password', RepeatedType::class, [ 
                'type' => PasswordType::class,
                'required' => true,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'form-control form-control-user']],
                'first_options'  => [ 'label' => false,'attr' => ['class' => 'form-control form-control-user', 'placeholder'=>'Password']],
                'second_options' => [ 'label' => false,'attr' => ['class' => 'form-control form-control-user', 'placeholder'=>'Repeat password']],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => 4096,
                    ]),
                ],
            ])

            ->add('sex', ChoiceType::class, [
                'choices' => [
                    'Nam' => 0,
                    'Nữ' => 1,
                ],
                'choice_attr' => function($choice, $key, $value) {
                    if ($value == 0) {
                        return ['class' => 'form-control col-2','checked'=> true];
                    }
                    return ['class' => 'form-control col-2'];
                 },
                'expanded' => true,
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
