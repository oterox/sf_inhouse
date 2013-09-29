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
                ->add('assignee')
                ->add('status')
                ->add('priority')
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
