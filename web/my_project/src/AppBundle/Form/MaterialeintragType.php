<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class MaterialeintragType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
	
	var $arbeitsrapportId;
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	
    	$this->arbeitsrapportId = $options['id'];
    	
        $builder
        	->add('arbeitsrapportId', HiddenType::class, array('data' => $this->arbeitsrapportId))
            ->add('anzahl')
            ->add('materialliste', EntityType::class, array('label' => 'Material', 'class' => 'AppBundle\Entity\Materialliste', 'choice_label' => 'name', ))
    
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Materialeintrag',
        	'id' => null
        ));
    }
}
