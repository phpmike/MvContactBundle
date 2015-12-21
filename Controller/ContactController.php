<?php

namespace Mv\ContactBundle\Controller;

use Mv\ContactBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ContactController
 *
 * @package Mv\ContactBundle\Controller
 * @author Michaël VEROUX
 */
class ContactController extends Controller
{
    /**
     * @param mixed $form
     *
     * @return Response
     * @Template()
     */
    public function indexAction($form = null)
    {
        $form = $form ? $form : $this->getForm();

        return array('form' => $form->createView());
    }

    /**
     * @param Request $request
     *
     * @return Response
     * @Template("MvContactBundle:Contact:index.html.twig")
     */
    public function sendAction(Request $request)
    {
        $form = $this->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->sendMessage($form->getData());

            $flash = $this->get('translator')->trans('form.contact.flash.success', array(), 'MvContactBundle');
            $this->get('session')->getFlashBag()->add('notice', $flash);

            return $this->redirect($this->generateUrl('mvcontact_success'));
        }

        $flash = $this->get('translator')->trans('form.contact.flash.failed', array(), 'MvContactBundle');
        $this->get('session')->getFlashBag()->add('error', $flash);

        return $this->indexAction($form);
    }

    /**
     * @return array
     * @Template()
     */
    public function successAction()
    {
        return array();
    }

    /**
     * @return FormTypeInterface
     * @author Michaël VEROUX
     */
    protected function getForm()
    {
        $form = $this->container->get('form.factory')->create(
            'mv_contact',
            new Contact(),
            array(
                'action'    => $this->generateUrl('mvcontact_send'),
                'method'    => 'POST',
            )
        );
        $form->add('buttons', 'form_actions', array(
            'buttons'   =>  array(
                'send' => array(
                    'type' => 'submit',
                    'options' => array(
                        'icon' => 'envelope',
                        'label' => 'form.contact.send',
                    ),
                ),
                'cancel' => array(
                    'type' => 'button',
                    'options' => array(
                        'icon' => 'trash',
                        'label' => 'form.contact.cancel',
                    ),
                ),
            ),
        ));

        return $form;
    }

    /**
     * @param Contact $contact
     *
     * @author Michaël VEROUX
     */
    protected function sendMessage(Contact $contact)
    {

        $sujet = $this->get('translator')->trans('mail.sujet', array('%sujet%' => $contact->getSujet()), 'MvContactBundle');
        $message = \Swift_Message::newInstance()
            ->setSubject($sujet)
            ->setFrom($this->container->getParameter('mv_contact.mail_from'))
            ->setTo($this->container->getParameter('mv_contact.mail_to'))
            ->setBody($this->renderView('MvContactBundle:Mail:contact.html.twig', array('contact' => $contact)));

        if ($this->container->getParameter('mv_contact.mail_cc')) {
            $message->setCc($this->container->getParameter('mv_contact.mail_cc'));
        }

        if ($this->container->getParameter('mv_contact.mail_bcc')) {
            $message->setBcc($this->container->getParameter('mv_contact.mail_bcc'));
        }

        $this->get('mailer')->send($message);
    }
}
