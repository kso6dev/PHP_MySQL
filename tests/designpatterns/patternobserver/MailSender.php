<?php

class MailSender implements SplObserver
{
  protected $mail;
  
  public function __construct($mail)
  {
    if (preg_match('`^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$`', $mail))
    {
      $this->mail = $mail;
    }
  }
  
  public function update(SplSubject $obj)
  {
    mail($this->mail, 'Erreur détectée !', 'Une erreur a été détectée sur le site. Voici les informations de celle-ci : ' . "\n" . $obj->getFormatedError());
  }
}