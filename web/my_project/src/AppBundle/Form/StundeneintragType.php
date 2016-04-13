<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\DateType;

class StundeneintragType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        
        	->add('datum', DateType::class, array('input'  => 'datetime','widget' => 'choice',))
        	->add('mitarbeiterliste', EntityType::class, array( 'class' => 'AppBundle\Entity\Mitarbeiterliste', 'choice_label' => 'name', ))
            ->add('leistung')
            ->add('std')
            ->add('beitragProStd')
        	//->add('beitragProStd', 'text', array('label' => 'Field','data' => 'Default value'))
            ->add('total');
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Stundeneintrag'
        ));
    }
}
