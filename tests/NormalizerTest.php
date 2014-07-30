<?php

use Mockery as m;
use PhilipBrown\CapsuleCRM\Normalizer;

class NormalizerTest extends PHPUnit_Framework_TestCase {

  public function setUp()
  {
    $this->model = new ModelStub(m::mock('PhilipBrown\CapsuleCRM\Connection'));
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
    $this->normalizer->model();
  }

}
