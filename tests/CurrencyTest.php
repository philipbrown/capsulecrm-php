<?php

use Mockery as m;
use PhilipBrown\CapsuleCRM\Currency;

class CurrencyTest extends PHPUnit_Framework_TestCase
{
    /** @var PhilipBrown\CapsuleCRM\Connection */
    private $connection;

    /** @var PhilipBrown\CapsuleCRM\Currency */
    private $model;

    /** @var Guzzle\Http\Message\Response */
    private $message;

    public function setUp()
    {
        $this->connection = m::mock('PhilipBrown\CapsuleCRM\Connection');
        $this->model = new Currency($this->connection);
        $this->message = m::mock('Guzzle\Http\Message\Response');
    }

    /** @test */
    public function find_all_countries()
    {
        $response = file_get_contents(dirname(__FILE__).'/stubs/get/currencies.json');
        $this->message->shouldReceive('json')->andReturn(json_decode($response, true));
        $this->connection->shouldReceive('get')->andReturn($this->message);

        $collection = $this->model->all();

        $this->assertInstanceOf('Illuminate\Support\Collection', $collection);
        $this->assertEquals(3, $collection->count());
    }
}
