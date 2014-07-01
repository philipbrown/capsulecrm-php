<?php

use PhilipBrown\CapsuleCRM\Connection;

class ModelTest extends PHPUnit_Framework_TestCase {

  public function setUp()
  {
    $this->model = new ModelStub(new Connection('', ''), ['name' => 'Philip Brown']);
  }

  public function testConnectionMethodHasConnection()
  {
    $this->assertInstanceOf('PhilipBrown\CapsuleCRM\Connection', $this->model->connection());
  }

  public function testSettingAnArrayOfAttributes()
  {
    $this->assertEquals('Philip Brown', $this->model->name);
  }

  public function testGetSingularEntityName()
  {
    $this->assertEquals('modelstubs', $this->model->base()->lowercase()->plural());
  }

}

class ModelStub extends PhilipBrown\CapsuleCRM\Model {

  protected $fillable = ['name'];

  public function __construct(Connection $connection, $attributes = [])
  {
    parent::__construct($connection);

    $this->fill($attributes);
  }

}
