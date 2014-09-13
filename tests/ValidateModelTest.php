<?php

use Mockery as m;
use PhilipBrown\CapsuleCRM\Model;
use PhilipBrown\CapsuleCRM\Connection;
use PhilipBrown\CapsuleCRM\Validating;

class ValidateModelTest extends PHPUnit_Framework_TestCase {

  /** @var PhilipBrown\CapsuleCRM\Model */
  private $model;

  public function setUp()
  {
    $connection = m::mock('PhilipBrown\CapsuleCRM\Connection');

    $this->model = new ValidateModelStub($connection);
  }

  /** @test */
  public function should_fail_validation()
  {
    $this->assertFalse($this->model->validate());
  }

  /** @test */
  public function should_pass_validation()
  {
    $this->model->email = 'phil@ipbrown.com';
    $this->assertTrue($this->model->validate());
  }

}

class ValidateModelStub extends Model {

  use Validating;

  protected $fillable = ['email'];
  protected $rules = ['email' => 'required'];

  public function __construct(Connection $connection, $attributes = [])
  {
    $this->connection = $connection;

    $this->fill($attributes);
  }

}
