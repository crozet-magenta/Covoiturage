<?php

namespace VRoom\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PathType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startCity', 'entity', ['property'=>'name', 'class'=>'VRoomWebsiteBundle:City', 'label'=>'Ville de départ'])
            ->add('endCity', 'text', ['label'=>'Ville d\'arrivée'])
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
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vroom_websitebundle_path';
    }
}
