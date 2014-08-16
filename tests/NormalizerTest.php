<?php

use Mockery as m;
use PhilipBrown\CapsuleCRM\Model;
use PhilipBrown\CapsuleCRM\Connection;
use PhilipBrown\CapsuleCRM\Normalizer;

class NormalizerTest extends PHPUnit_Framework_TestCase {

  /** @test PhilipBrown\CapsuleCRM\Connection */
  private $connection;

  /** @test PhilipBrown\CapsuleCRM\Model */
  private $model;

  /** @test PhilipBrown\CapsuleCRM\Normalizer */
  private $normalizer;

  public function setUp()
  {
    $this->connection = m::mock('PhilipBrown\CapsuleCRM\Connection');
    $this->model = new NormalizeModelStub($this->connection);
    $this->normalizer = new Normalizer($this->model);
  }

  /** @test */
  public function should_require_model()
  {
    $this->setExpectedException('Exception');

    $normalizer = new Normalizer('', []);
  }

  /** @test */
  public function should_require_options_array()
  {
    $this->setExpectedException('Exception');

    $normalizer = new Normalizer($this->model, '');
  }

  /** @test */
  public function model_method_should_require_attributes_array()
  {
    $this->setExpectedException('Exception');

    $this->normalizer->model();
  }

  /** @test */
  public function collection_should_require_attributes_array()
  {
    $this->setExpectedException('Exception');

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
