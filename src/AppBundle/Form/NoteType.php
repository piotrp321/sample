<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;
use AppBundle\Constants\Status;


class NoteType extends AbstractType
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
            ->add('content', TextareaType::class, array(
                'label' => 'Content',
                'required' => true,
                'constraints' => array(
                    new NotBlank(array('message' => 'Please fill in the field')),
                )
            ))
            ->add('isDone', ChoiceType::class, array(
                'label' => 'Is done',
                'choices' => array('Yes' => true, 'No' => false),
                'expanded' => false,
                'multiple' => false,
                'required' => true,
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
            'data_class' => 'AppBundle\Entity\Note'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_note';
    }


}
