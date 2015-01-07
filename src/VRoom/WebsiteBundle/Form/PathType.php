<?php

namespace VRoom\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use VRoom\WebsiteBundle\Form\DataTransformer\StringToCityTransformer;

class PathType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new StringToCityTransformer($options['em']);
        $builder->add(
            $builder->create('startCity', 'text', ['label'=>'Ville de départ'] )
                    ->addModelTransformer($transformer)
        );
        $builder->add(
            $builder->create('endCity'  , 'text', ['label'=>'Ville d\'arrivée'])
                    ->addModelTransformer($transformer)
        );
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'VRoom\WebsiteBundle\Entity\Path'
        ));
        $resolver->setRequired(array(
            'em',
        ));
        $resolver->setAllowedTypes(array(
            'em' => 'Doctrine\Common\Persistence\ObjectManager',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vroom_websitebundle_path';
    }
}
