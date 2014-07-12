<?php

use PhilipBrown\CapsuleCRM\Connection;

class ModelStub extends PhilipBrown\CapsuleCRM\Model {

  use PhilipBrown\CapsuleCRM\Querying\Configuration;
  use PhilipBrown\CapsuleCRM\Validating;

  protected $fillable = ['name', 'email'];
  protected $rules = ['email' => 'required'];
  protected $queryableOptions = ['plural' => 'the_plural_name'];

  public function __construct(Connection $connection, $attributes = [])
  {
    parent::__construct($connection);

    $this->fill($attributes);
  }

}
