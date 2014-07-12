<?php

use Mockery as m;

class QueryingTest extends PHPUnit_Framework_TestCase {

  public function setUp()
  {
    $connection = m::mock('PhilipBrown\CapsuleCRM\Connection');

    $this->model = new ModelStub($connection);
  }

  public function testTheSingularQueryableName()
  {
    $this->assertEquals('modelstub', $this->model->queryableOptions()->singular());
  }

  public function testThePluralQueryableName()
  {
    $this->assertEquals('the_plural_name', $this->model->queryableOptions()->plural());
  }

}
