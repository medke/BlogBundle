<?php

namespace MyApp\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('categorie', 'choice', array(
    'choices' => array('web' => 'web', 'graphics' => 'graphics', 'Entertainment' => 'Entertainment',
        'news' => 'news','movies' => 'movies','personel' => 'personel'),
)) 
            ->add('creation_date')
        ;
    }

    public function getName()
    {
        return 'article';
    }
        
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'MyApp\BlogBundle\Entity\Article',
        );
    }
}
