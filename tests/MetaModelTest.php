<?php

use Mockery as m;
use PhilipBrown\CapsuleCRM\Model;
use PhilipBrown\CapsuleCRM\Connection;

class MetaModelTest extends PHPUnit_Framework_TestCase {

  public function setUp()
  {
    $connection = m::mock('PhilipBrown\CapsuleCRM\Connection');

    $this->model = new MetaModelStub($connection);
  }

  public function testGetPluralEntityName()
  {
    $this->assertEquals('metamodelstubs', $this->model->base()->lowercase()->plural());
  }

  public function testGetSingularEntityName()
  {
    $this->assertEquals('metamodelstub', $this->model->base()->lowercase()->singular());
  }

}

class MetaModelStub extends PhilipBrown\CapsuleCRM\Model {

  public function __construct(Connection $connection, $attributes = [])
  {
    parent::__construct($connection);

    $this->fill($attributes);
  }

}
