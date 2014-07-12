<?php

use Mockery as m;

class ModelTest extends PHPUnit_Framework_TestCase {

  public function setUp()
  {
    $connection = m::mock('PhilipBrown\CapsuleCRM\Connection');

    $this->model = new ModelStub($connection, ['name' => 'Philip Brown']);
  }

  public function testConnectionMethodHasConnection()
  {
    $this->assertInstanceOf('PhilipBrown\CapsuleCRM\Connection', $this->model->connection());
  }

  public function testSettingAnArrayOfAttributes()
  {
    $this->assertEquals('Philip Brown', $this->model->name);
  }

  public function testSettingAProperty()
  {
    $this->model->email = 'phil@ipbrown.com';
    $this->assertEquals('phil@ipbrown.com', $this->model->email);
  }

  public function testGetSingularEntityName()
  {
    $this->assertEquals('modelstubs', $this->model->base()->lowercase()->plural());
  }

  public function testValidatingFailsWithMissingRequiredEmail()
  {
    $this->assertFalse($this->model->validate());
  }

  public function testValidatingPassesWithRequiredEmail()
  {
    $this->model->email = 'phil@ipbrown.com';
    $this->assertTrue($this->model->validate());
  }

}
