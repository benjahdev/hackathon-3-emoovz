<?php

namespace AppBundle\Form;

use AppBundle\Entity\Category;
use AppBundle\Entity\Room;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StuffType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('dimension_height')
            ->add('dimension_width')
            ->add('dimension_deep')
            ->add('is_weight', CheckboxType::class, array(
                'required' => false,
                'attr' => array('class' => 'is_weight')
            ))
            ->add('is_fragile', CheckboxType::class, array(
                'required' => false,
                'attr' => array('class' => 'is_weight')
            ))
            ->add('is_custom', CheckboxType::class, array(
                'required' => false,
                'attr' => array('class' => 'is_custom')
            ))
            ->add('category', EntityType::class, array(
                'class' => Category::class,
                'choice_label' => 'name',
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Stuff'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_stuff';
    }


}
