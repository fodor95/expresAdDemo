<?php

namespace Expres\DemoAdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlogPostsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content', 'textarea', array(
                    'attr' => array(
                    'class' => 'tinymce')))
            ->add('date', 'date', array(
                'placeholder' => array('year' => 'Year', 'month' => 'Month', 'day' => 'Day'),
                'data' => new \DateTime("now")
                ))
            ->add('tags','text')
            ->add('blogcategories')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Expres\DemoAdminBundle\Entity\BlogPosts'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'expres_demoadminbundle_blogposts';
    }
}
