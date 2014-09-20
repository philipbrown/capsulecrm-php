<?php

use Mockery as m;
use PhilipBrown\CapsuleCRM\Model;
use PhilipBrown\CapsuleCRM\Connection;

class ModelTest extends PHPUnit_Framework_TestCase
{
    /** @test PhilipBrown\CapsuleCRM\Model */
    private $model;

    public function setUp()
    {
        $connection = m::mock('PhilipBrown\CapsuleCRM\Connection');

        $this->model = new ModelStub($connection, ['name' => 'Philip Brown']);
    }

    /** @test */
    public function should_return_connection()
    {
        $this->assertInstanceOf('PhilipBrown\CapsuleCRM\Connection', $this->model->connection());
    }

    /** @test */
    public function should_have_access_to_injected_attributes()
    {
        $this->assertEquals('Philip Brown', $this->model->name);
    }

    /** @test */
    public function should_set_property()
    {
        $this->model->email = 'phil@ipbrown.com';
        $this->assertEquals('phil@ipbrown.com', $this->model->email);
    }
}

class ModelStub extends Model
{
    protected $fillable = ['name', 'email'];

    public function __construct(Connection $connection, $attributes = [])
    {
        $this->connection = $connection;

        $this->fill($attributes);
    }
}
