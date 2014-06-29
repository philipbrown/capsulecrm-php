<?php namespace PhilipBrown\CapsuleCRM;

abstract class Entity {

  /**
   * The HTTP connection
   *
   * @var PhilipBrown\CapsuleCRM\Connection
   */
  protected $connection;

  /**
   * Inject the Connection dependency
   *
   * @param PhilipBrown\CapsuleCRM\Connection $connection
   * @return void
   */
  public function __construct(Connection $connection)
  {
    $this->connection = $connection;
  }

  /**
   * Get the connection instance
   *
   * @return PhilipBrown\CapsuleCRM\Connection
   */
  public function connection()
  {
    return $this->connection;
  }

}
