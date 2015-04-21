<?php

namespace MyApp\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CommentsType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('user',null,array('label'=>'name'))
            ->add('email')
            ->add('content',null,array('label'=>'comment'))
            
            
        ;
    }

    public function getName()
    {
        return 'comments';
    }
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'MyApp\BlogBundle\Entity\Comments',
        );
    }
}
