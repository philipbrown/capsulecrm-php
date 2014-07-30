<?php

use PhilipBrown\CapsuleCRM\Normalizer;

class NormalizerTest extends PHPUnit_Framework_TestCase {

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
    $normalizer = new Normalizer(new ModelStub, '');
  }

}
