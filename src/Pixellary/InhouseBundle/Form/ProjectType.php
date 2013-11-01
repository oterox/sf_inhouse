<?php

namespace Pixellary\InhouseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('title')
                ->add('client', 'entity', array('class'=>'Pixellary\InhouseBundle\Entity\Client', 'property'=>'title', ))
                ->add('details', 'textarea')
                ->add('total')
                ->add('paid')
                ->add('stage', 'choice', array(
                    'choices' => array(
                        '1' => 'Posible',
                        '2' => 'Started',
                        '3' => 'QA',
                        '4' => 'FInished',
                    ),
                    'multiple'  => false,
                ))
                ->add('status', 'choice', array(
                    'choices' => array(
                        '1' => 'Not started',
                        '2' => 'In progress',
                        '3' => 'Finished',
                        '4' => 'Paused',
                        '5' => 'Cancelled',
                    ),
                    'multiple'  => false,
                ))
                ->add('url')
                ->add('thumb')
                ->add('category_id', 'choice', array(
                    'choices' => array(
                        '1' => 'Wordpress',
                        '2' => 'Symfony',
                        '3' => 'Design',
                        '4' => 'Branding',
                        '5' => 'Front-end',
                    ),
                    'multiple'  => false,
                ))
                ;
    }

    public function getName()
    {
        return 'project';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Pixellary\InhouseBundle\Entity\Project',
        );
    }

}
