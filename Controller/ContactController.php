<?php

namespace Mv\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ContactController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction($form = null)
    {
        $form = $form ? $form : $this->_getForm();
        return array('form' => $form->createView());
    }

    /**
     * @Template("MvContactBundle:Contact:index.html.twig")
     */    
    public function sendAction()
    {
        $form = $this->_getForm();
        
        $form->bind($this->getRequest());
        
        if($form->isValid()){
            $this->_sendMessage();

            $flash = $this->get('translator')->trans('form.contact.flash.success', array(), 'MvContactBundle');
            $this->get('session')->getFlashBag()->add('notice', $flash);
            
            return $this->redirect($this->generateUrl('mvcontact_success'));
        }
        
        $flash = $this->get('translator')->trans('form.contact.flash.failed', array(), 'MvContactBundle');
        $this->get('session')->getFlashBag()->add('error', $flash);
      
        return $this->indexAction($form);
    }
    
    /**
     * @Template()
     */
    public function successAction()
    {
        return array();
    }
    
    protected function _getForm()
    {
        return $this->container->get('form.factory')->create(
            $this->container->get('mvcontact.type'),
            $this->container->get('mvcontact.entity')
        );
    }
    
    protected function _sendMessage(){
        $contact = $this->container->get('mvcontact.entity');
        
        $sujet = $this->get('translator')->trans('mail.sujet', array('%sujet%' => $contact->getSujet()), 'MvContactBundle');
        $message = \Swift_Message::newInstance()
            ->setSubject($sujet)
            ->setFrom($this->container->getParameter('mv_contact.mail_from'))
            ->setTo($this->container->getParameter('mv_contact.mail_to'))
            ->setBody($this->renderView('MvContactBundle:Mail:contact.html.twig', array('contact' => $contact)));

        if($this->container->getParameter('mv_contact.mail_cc'))
            $message->setCc($this->container->getParameter('mv_contact.mail_cc'));

        if($this->container->getParameter('mv_contact.mail_bcc'))
            $message->setBcc($this->container->getParameter('mv_contact.mail_bcc'));

        $this->get('mailer')->send($message);        
    }
}
