<?php

use PhilipBrown\CapsuleCRM\Connection;

class EntityTest extends PHPUnit_Framework_TestCase {

  public function testConnectionMethodHasConnection()
  {
    $entity = new EntityStub(new Connection('', ''));
    $this->assertInstanceOf('PhilipBrown\CapsuleCRM\Connection', $entity->connection());
  }

  public function testSettingAnArrayOfAttributes()
  {
    $entity = new EntityStub(new Connection('', ''), ['name' => 'Philip Brown']);
    $this->assertEquals('Philip Brown', $entity->name);
  }

}

class EntityStub extends PhilipBrown\CapsuleCRM\Entity {

  protected $fillable = ['name'];

  public function __construct(Connection $connection, $attributes = [])
  {
    parent::__construct($connection);

    $this->fill($attributes);
  }

}
