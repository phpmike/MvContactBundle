<?php
namespace Mv\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class ContactType
 *
 * @package Mv\ContactBundle\Form
 * @author Michaël VEROUX
 */
class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @author Michaël VEROUX
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', 'text', array('label' => 'form.contact.nom'));
        $builder->add('email', 'text', array('label' => 'form.contact.email'));
        $builder->add('sujet', 'text', array(
            'label'    => 'form.contact.sujet',
            'required' => false,
        ));
        $builder->add('message', 'textarea', array('label' => 'form.contact.message'));
    }

    /**
     * @param OptionsResolverInterface $resolver
     *
     * @author Michaël VEROUX
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mv\ContactBundle\Entity\Contact',
            'translation_domain' => 'MvContactBundle',
        ));
    }

    /**
     * @return string
     * @author Michaël VEROUX
     */
    public function getName()
    {
        return 'mv_contact';
    }
}
