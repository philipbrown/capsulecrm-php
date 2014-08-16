<?php

class ConnectionTest extends PHPUnit_Framework_TestCase {

  /** @test */
  public function should_get_client()
  {
    $c = new PhilipBrown\CapsuleCRM\Connection('', '');

    $this->assertInstanceOf('GuzzleHttp\Client', $c->client());
  }

}
