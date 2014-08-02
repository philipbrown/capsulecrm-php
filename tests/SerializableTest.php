<?php

use Mockery as m;
use PhilipBrown\CapsuleCRM\Model;
use PhilipBrown\CapsuleCRM\Connection;
use PhilipBrown\CapsuleCRM\Serializable;

class SerializableTest extends PHPUnit_Framework_TestCase {

  public function setUp()
  {
    $this->connection = m::mock('PhilipBrown\CapsuleCRM\Connection');
    $this->model = new SerializableModelStub($this->connection);
  }

  public function testGettingSerializableOptions()
  {
    $options = $this->model->serializableOptions();

    $this->assertTrue(is_array($options));
    $this->assertTrue(is_array($options['root']));
    $this->assertEquals('serializablemodelstubs', $options['collection_root']);
  }

}

class SerializableModelStub extends Model {

  use Serializable;

  protected $serializableConfig = ['root' => ['person', 'organisation']];

  public function __construct(Connection $connection, $attributes = [])
  {
    parent::__construct($connection);

    $this->fill($attributes);
  }

}
