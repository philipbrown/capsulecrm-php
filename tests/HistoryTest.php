<?php

use Mockery as m;
use PhilipBrown\CapsuleCRM\Person;
use PhilipBrown\CapsuleCRM\History;

class HistoryTest extends PHPUnit_Framework_TestCase
{
    /** @var PhilipBrown\CapsuleCRM\Connection */
    private $connection;

    /** @var PhilipBrown\CapsuleCRM\History */
    private $model;

    /** @var Guzzle\Http\Message\Response */
    private $message;

    public function setUp()
    {
        $this->connection = m::mock('PhilipBrown\CapsuleCRM\Connection');
        $this->model = new History($this->connection);
        $this->message = m::mock('Guzzle\Http\Message\Response');
    }

    /** @test */
    public function should_find_belongs_to_id()
    {
        $this->model->party = new Person($this->connection, ['id' => '123']);
        $this->assertEquals('123', $this->model->belongsToId());
    }

    /** @test */
    public function should_find_belongs_to_name()
    {
        $this->model->party = new Person($this->connection);
        $this->assertEquals('person', $this->model->belongsToName());
    }

    /** @test */
    public function should_find_belongs_to_api_name()
    {
        $this->model->party = new Person($this->connection);
        $this->assertEquals('party', $this->model->belongsToApiName());
    }

    /** @test */
    public function find_history_by_id()
    {
        $response = file_get_contents(dirname(__FILE__).'/stubs/get/history.json');
        $this->message->shouldReceive('json')->andReturn(json_decode($response, true));
        $this->connection->shouldReceive('get')->andReturn($this->message);

        $item = $this->model->find(100);

        $this->assertInstanceOf('PhilipBrown\CapsuleCRM\History', $item);
        $this->assertEquals('100', $item->id);
        $this->assertEquals('Note', $item->type);
        $this->assertEquals('2009-09-11T16:07:49Z', $item->entry_date);
        $this->assertEquals('a.user', $item->creator);
        $this->assertEquals('A User', $item->creator_name);
        $this->assertEquals('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla mollis ullam...', $item->subject);
        $this->assertEquals('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla mollis ullamcorper vehicula.', $item->note);
        $this->assertTrue(is_array($item->attachments));
    }
}
