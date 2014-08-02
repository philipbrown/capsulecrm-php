<?php

use Mockery as m;
use PhilipBrown\CapsuleCRM\Model;
use PhilipBrown\CapsuleCRM\Connection;
use PhilipBrown\CapsuleCRM\Querying\Findable;

class QueryingTest extends PHPUnit_Framework_TestCase {

  public function setUp()
  {
    $this->connection = m::mock('PhilipBrown\CapsuleCRM\Connection');
    $this->message = m::mock('Guzzle\Http\Message\Response');
    $this->model = new QueryModelStub($this->connection);
  }

  public function testTheSingularQueryableName()
  {
    $this->assertEquals('querymodelstub', $this->model->queryableOptions()->singular());
  }

  public function testThePluralQueryableName()
  {
    $this->assertEquals('the_plural_name', $this->model->queryableOptions()->plural());
  }

}

class QueryModelStub extends Model {

  use Findable;

  protected $queryableOptions = ['plural' => 'the_plural_name'];

  public function __construct(Connection $connection, $attributes = [])
  {
    parent::__construct($connection);

    $this->fill($attributes);
  }

}
