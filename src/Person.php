<?php namespace PhilipBrown\CapsuleCRM;

class Person extends Party {

  /**
   * Create a new instance of the Party model
   *
   * @param PhilipBrown\CapsuleCRM\Connection $connection
   * @return void
   */
  public function __construct(Connection $connection)
  {
    parent::__construct($connection);
  }

}
