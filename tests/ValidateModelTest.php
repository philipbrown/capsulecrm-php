<?php

use Mockery as m;
use PhilipBrown\CapsuleCRM\Model;
use PhilipBrown\CapsuleCRM\Connection;
use PhilipBrown\CapsuleCRM\Validating;

class ValidateModelTest extends PHPUnit_Framework_TestCase {

  public function setUp()
  {
    $connection = m::mock('PhilipBrown\CapsuleCRM\Connection');

    $this->model = new ValidateModelStub($connection);
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

class ValidateModelStub extends Model {

  use Validating;

  protected $fillable = ['email'];
  protected $rules = ['email' => 'required'];

  public function __construct(Connection $connection, $attributes = [])
  {
    parent::__construct($connection);

    $this->fill($attributes);
  }

}
