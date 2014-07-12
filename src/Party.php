<?php namespace PhilipBrown\CapsuleCRM;

class Party extends Model {

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
