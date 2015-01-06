<?php

namespace VRoom\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OfferType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', null, ['label'=>'Date de départ'])
            ->add('seats', null, ['label'=>'Nombre de places'])
            ->add('price', null, ['label'=>'Prix'])
            ->add('path', new PathType())
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'VRoom\WebsiteBundle\Entity\Offer'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vroom_websitebundle_offer';
    }
}
