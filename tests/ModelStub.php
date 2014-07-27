<?php

use PhilipBrown\CapsuleCRM\Validating;
use PhilipBrown\CapsuleCRM\Connection;
use PhilipBrown\CapsuleCRM\Querying\Findable;

class ModelStub extends PhilipBrown\CapsuleCRM\Model {

  use Findable;
  use Validating;

  protected $fillable = ['name', 'email'];
  protected $rules = ['email' => 'required'];
  protected $queryableOptions = ['plural' => 'the_plural_name'];

  public function __construct(Connection $connection, $attributes = [])
  {
    parent::__construct($connection);

    $this->fill($attributes);
  }

}
