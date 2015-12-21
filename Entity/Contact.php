<?php
/**
 * Description of ContactObject
 *
 * @author michael
 */
namespace Mv\ContactBundle\Entity;

/**
 * Class Contact
 *
 * @package Mv\ContactBundle\Entity
 * @author Michaël VEROUX
 */
class Contact
{

    /**
     * @var string $nom
     */
    protected $nom;

    /**
     * @var string $email
     */
    protected $email;

    /**
     * @var string $sujet
     */
    protected $sujet;

    /**
     * @var string $message
     */
    protected $message;

    /**
     * @return string
     * @author Michaël VEROUX
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $value
     *
     * @author Michaël VEROUX
     */
    public function setNom($value)
    {
        $this->nom = $value;
    }

    /**
     * @return string
     * @author Michaël VEROUX
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $value
     *
     * @author Michaël VEROUX
     */
    public function setEmail($value)
    {
        $this->email = $value;
    }

    /**
     * @return string
     * @author Michaël VEROUX
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * @param string $value
     *
     * @author Michaël VEROUX
     */
    public function setSujet($value)
    {
        $this->sujet = $value;
    }

    /**
     * @return string
     * @author Michaël VEROUX
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $value
     *
     * @author Michaël VEROUX
     */
    public function setMessage($value)
    {
        $this->message = $value;
    }
}
