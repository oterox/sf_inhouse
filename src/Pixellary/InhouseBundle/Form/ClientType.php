<?php

namespace Pixellary\InhouseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('title')
                ->add('notes', 'textarea')
                ->add('country')
        ;
    }

    public function getName()
    {
        return 'client';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Pixellary\InhouseBundle\Entity\Client',
        );
    }

}
