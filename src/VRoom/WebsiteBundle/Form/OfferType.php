<?php

namespace VRoom\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Date;

class OfferType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', null, ['label'=>'Date de départ', 'years' => range(date("Y"), date("Y")+3), 'date_widget'=>'single_text', 'time_widget'=>'single_text'])
            ->add('seats', null, ['label'=>'Nombre de places'])
            ->add('price', null, ['label'=>'Prix'])
            ->add('path', new PathType(), ['em'=>$options['em'], 'label'=>' '])
            ->add('Envoyer', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'VRoom\WebsiteBundle\Entity\Offer'
        ]);
        $resolver->setRequired([
            'em',
        ]);
        $resolver->setAllowedTypes([
            'em' => 'Doctrine\Common\Persistence\ObjectManager',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vroom_websitebundle_offer';
    }
}
