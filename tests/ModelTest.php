<?php

use Mockery as m;
use PhilipBrown\CapsuleCRM\Model;
use PhilipBrown\CapsuleCRM\Connection;

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

}

class ModelStub extends Model {

  protected $fillable = ['name', 'email'];

  public function __construct(Connection $connection, $attributes = [])
  {
    parent::__construct($connection);

    $this->fill($attributes);
  }

}
