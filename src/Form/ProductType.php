<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProductType extends AbstractType
{
    private $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['class' => 'form-control form-control-user','placeholder'=>'Name'],
                'label' => false,
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'max' => 10,
                    ]),
                ],
            ]) 
            ->add('category_id', ChoiceType::class, [
                'attr' => ['class' => 'form-control form-control-user','placeholder'=>'Name'],
                'choices'  => $this->categoryRepository->findAll(),
                'choice_label' => function(?Category $category) {
                    return $category ? ucfirst($category->getName()) : '';
                },
            ])
            ->add('image', FileType::class, [
                'attr' => ['class' => 'd-none', 'accept' => 'image/*'],
                
            ])
            ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
