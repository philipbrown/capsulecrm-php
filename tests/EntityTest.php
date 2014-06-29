<?php

use PhilipBrown\CapsuleCRM\Connection;

class EntityTest extends PHPUnit_Framework_TestCase {

  public function setUp()
  {
    $this->entity = new EntityStub(new Connection('', ''), ['name' => 'Philip Brown']);
  }

  public function testConnectionMethodHasConnection()
  {
    $this->assertInstanceOf('PhilipBrown\CapsuleCRM\Connection', $this->entity->connection());
  }

  public function testSettingAnArrayOfAttributes()
  {
    $this->assertEquals('Philip Brown', $this->entity->name);
  }

  public function testGetSingularEntityName()
  {
    $this->assertEquals('entitystubs', $this->entity->base()->lowercase()->plural());
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
