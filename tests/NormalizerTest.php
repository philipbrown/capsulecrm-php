<?php

use Mockery as m;
use PhilipBrown\CapsuleCRM\Model;
use PhilipBrown\CapsuleCRM\Connection;
use PhilipBrown\CapsuleCRM\Normalizer;

class NormalizerTest extends PHPUnit_Framework_TestCase {

  public function setUp()
  {
    $this->connection = m::mock('PhilipBrown\CapsuleCRM\Connection');
    $this->model = new NormalizeModelStub($this->connection);
    $this->normalizer = new Normalizer($this->model);
  }

  /**
   * @expectedException Exception
   */
  public function testNormalizerRequiresModelInstance()
  {
    $normalizer = new Normalizer('', []);
  }

  /**
   * @expectedException Exception
   */
  public function testNormalizerRequiresOptionsArray()
  {
    $normalizer = new Normalizer($this->model, '');
  }

  /**
   * @expectedException Exception
   */
  public function testModelMethodRequiresAttributesArray()
  {
    $this->normalizer->model();
  }

  /**
   * @expectedException Exception
   */
  public function testCollectionMethodRequiresAttributesArray()
  {
    $this->normalizer->collection();
  }

}

class NormalizeModelStub extends Model {

  public function __construct(Connection $connection, $attributes = [])
  {
    parent::__construct($connection);

    $this->fill($attributes);
  }

}
