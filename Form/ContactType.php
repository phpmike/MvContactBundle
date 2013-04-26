<?php
namespace Mv\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', 'text', array( 'label'       => 'form.contact.nom',    'translation_domain' => 'MvContactBundle'));
        $builder->add('email', 'text', array( 'label'     => 'form.contact.email',  'translation_domain' => 'MvContactBundle'));
        $builder->add('sujet', 'text', array( 'label'     => 'form.contact.sujet',  'translation_domain' => 'MvContactBundle',
                                              'required'  => false));
        $builder->add('message', 'textarea', array( 'label'     => 'form.contact.message', 'translation_domain' => 'MvContactBundle'));
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mv\ContactBundle\Entity\Contact'
        ));
    }  

    public function getName()
    {
        return 'contact';
    }
}