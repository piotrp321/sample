<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;
use AppBundle\Constants\Status;
use AppBundle\Constants\Sleeve;

class ShirtType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name', TextType::class, array(
                'label' => 'Name',
                'required' => true,
                'constraints' => array(
                    new NotBlank(array('message' => 'Please fill in the field')),
                )
            ))
            ->add('description', TextareaType::class, array(
                'label' => 'Description',
                'required' => true,
                'constraints' => array(
                    new NotBlank(array('message' => 'Please fill in the field')),
                )
            ))
            ->add('quantity', NumberType::class, array(
                'label' => 'Quantity',
                'required' => true,
                'constraints' => array(
                    new NotBlank(array('message' => 'Please fill in the field')),
                )
            ))
            ->add('price', NumberType::class, array(
                'label' => 'Price',
                'required' => true,
                'constraints' => array(
                    new NotBlank(array('message' => 'Please fill in the field')),
                )
            ))
            ->add('sleeve', ChoiceType::class, array(
                'label' => 'Sleeve type',
                'choices' => array_flip(Sleeve::getSleeves()),
                'expanded' => false,
                'multiple' => false,
                'required' => true,
                'constraints' => array(
                    new NotBlank(array('message' => 'Please fill in the field')),
                )
            ))
            ->add('status', ChoiceType::class, array(
                'label' => 'Status',
                'choices' => array_flip(Status::getStatuses()),
                'expanded' => false,
                'multiple' => false,
                'required' => true,
                'constraints' => array(
                    new NotBlank(array('message' => 'Please fill in the field')),
                )
            ));

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Shirt'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_shirt';
    }

}
