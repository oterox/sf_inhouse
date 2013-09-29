<?php

namespace Pixellary\InhouseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('title')
                ->add('details', 'textarea')
                ->add('assignee', 'choice', array(
                    'choices' => array(
                        '1' => 'Javier Otero',
                        '2' => 'Kendra Schaefer',
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
                ->add('priority', 'choice', array(
                    'choices' => array(
                        '1' => 'Low',
                        '2' => 'Normal',
                        '3' => 'High',
                    ),
                    'multiple'  => false,
                ))
                ->add('project_id')
                ->add('created', 'date')
                //->add('taskProgress', 'percent', array('type' => 'integer' ))
        ;
    }

    public function getName()
    {
        return 'task';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Pixellary\InhouseBundle\Entity\Task',
        );
    }

}
