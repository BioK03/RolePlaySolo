<?php

namespace RolePlaySolo\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ClientPassType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder->add('password', 'password');
    }

    public function getName()
    {
        return 'clientPassword';
    }
}