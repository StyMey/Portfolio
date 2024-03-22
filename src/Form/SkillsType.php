<?php

namespace App\Form;

use App\Entity\Skills;
use App\Entity\Projects;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SkillsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'name'
                ],
                'label' => 'Nom du skill',
                'label_attr' => [
                    'class' => 'name_label'
                ],
            ])
            ->add('cathegory', TextType::class, [
                'attr' => [
                    'class' => 'category'
                ],
                'label' => 'Catégorie',
                'label_attr' => [
                    'class' => 'cat_label'
                ],
            ])
            /*{#->add('projects', EntityType::class, [
                'class' => Projects::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])*/
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ],
                'label' => 'Valider'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Skills::class,
        ]);
    }
}
