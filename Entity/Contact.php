<?php
/**
 * Description of ContactObject
 *
 * @author michael
 */
namespace Mv\ContactBundle\Entity;

class Contact {
  
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
  
  public function getNom(){
    return $this->nom;
  }
  
  public function setNom($value){
    $this->nom = $value;
  }
  
  public function getEmail(){
    return $this->email;
  }
  
  public function setEmail($value){
    $this->email = $value;
  }
  
  public function getSujet(){
    return $this->sujet;
  }
  
  public function setSujet($value){
    $this->sujet = $value;
  }
  
  public function getMessage(){
    return $this->message;
  }
  
  public function setMessage($value){
    $this->message = $value;
  }
}

?>
