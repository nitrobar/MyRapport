<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


class StundeneintragType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

	var $arbeitsrapportId;
	
    public function buildForm(FormBuilderInterface $builder,array $options)
    {
    	  	
    	$this->arbeitsrapportId = $options['id'];	
   	
        $builder
        	->add('arbeitsrapportId', HiddenType::class, array('data' => $this->arbeitsrapportId))
        	->add('datum', DateType::class, array('input'  => 'datetime','widget' => 'choice',))
        	->add('mitarbeiterliste', EntityType::class, array('label' => 'Mitarbeiter', 'class' => 'AppBundle\Entity\Mitarbeiterliste', 'choice_label' => 'name', ))
            ->add('leistung')
            ->add('std', TextType::class, array('label' => 'Stunden',))        
          ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Stundeneintrag',
        	'id' => null
        ));
    }
}
