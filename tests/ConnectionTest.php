<?php

class ConnectionTest extends PHPUnit_Framework_TestCase {

  public function testGetClient()
  {
    $c = new PhilipBrown\CapsuleCRM\Connection('', '');
    $this->assertInstanceOf('GuzzleHttp\Client', $c->client());
  }

}
