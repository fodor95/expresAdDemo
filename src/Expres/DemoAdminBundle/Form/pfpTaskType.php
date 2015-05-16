<?php

namespace Expres\DemoAdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class pfpTaskType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('created')
            ->add('name')
            ->add('shortDescribtion')
            ->add('header')
            ->add('progress')
            ->add('projectID')
            ->add('stateID')
            ->add('place')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Expres\DemoAdminBundle\Entity\pfpTask'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'expres_demoadminbundle_pfptask';
    }
}
