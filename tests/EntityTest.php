<?php

class EntityTest extends PHPUnit_Framework_TestCase {

  public function setUp()
  {
    $this->entity = new EntityStub(new PhilipBrown\CapsuleCRM\Connection('', ''));
  }

  public function testConnectionMethodHasConnection()
  {
    $this->assertInstanceOf('PhilipBrown\CapsuleCRM\Connection', $this->entity->connection());
  }

}

class EntityStub extends PhilipBrown\CapsuleCRM\Entity {

  public function __construct(PhilipBrown\CapsuleCRM\Connection $connection)
  {
    parent::__construct($connection);
  }

}
