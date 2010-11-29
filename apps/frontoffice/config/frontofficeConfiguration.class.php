<?php

class frontofficeConfiguration extends sfApplicationConfiguration
{
  public function configure()
  {
    sfValidatorBase::setDefaultMessage('required', 'Champ obligatoire.');
    sfValidatorBase::setDefaultMessage('invalid', 'Valeur non valide.');
  }
}
