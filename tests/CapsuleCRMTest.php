<?php

use Mockery as m;
use PhilipBrown\CapsuleCRM\CapsuleCRM;

class CapsuleCRMTest extends PHPUnit_Framework_TestCase {

  /** @var PhilipBrown\CapsuleCRM\CapsuleCRM */
  private $capsule;

  public function setUp()
  {
    $connection = m::mock('PhilipBrown\CapsuleCRM\Connection');

    $this->capsule = new CapsuleCRM($connection);
  }

  /** @test */
  public function should_require_connection()
  {
    $this->setExpectedException('Exception');

    $c = new PhilipBrown\CapsuleCRM\CapsuleCRM('');
  }

  /** @test */
  public function should_create_party()
  {
    $this->assertInstanceOf('PhilipBrown\CapsuleCRM\Party', $this->capsule->party());
  }

}
