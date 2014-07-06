<?php

use Mockery as m;

class CapsuleCRMTest extends PHPUnit_Framework_TestCase {

  public function setUp()
  {
    $connection = m::mock('PhilipBrown\CapsuleCRM\Connection');

    $this->capsule = new PhilipBrown\CapsuleCRM\CapsuleCRM($connection);
  }

  /**
   * @expectedException Exception
   */
  public function testCapsuleCRMRequiresConnection()
  {
    $c = new PhilipBrown\CapsuleCRM\CapsuleCRM('');
  }

}
