<?php namespace PhilipBrown\CapsuleCRM;

class CapsuleCRM {

  /**
   * The HTTP Connection
   *
   * @var PhilipBrown\CapsuleCRM\Connection
   */
  protected $connection;

  /**
   * Create a new instance of CapsuleCRM
   *
   * @param PhilipBrown\CapsuleCRM\Connection $connection
   * @return void
   */
  public function __construct(Connection $connection)
  {
    $this->connection = $connection;
  }

  /**
   * Return a new Party model
   *
   * @return PhilipBrown\CapsuleCRM\Party
   */
  public function party()
  {
    return new Party($this->connection);
  }

}
