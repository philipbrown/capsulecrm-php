<?php namespace PhilipBrown\CapsuleCRM\Persistance;

use PhilipBrown\CapsuleCRM\Model;

class Options
{
    /**
     * @var Model
     */
    private $model;

    /**
     * Create a new Options object
     *
     * @param PhilipBrown\CapsuleCRM\Model
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Generate the create endpoint
     *
     * @return string
     */
    public function create()
    {
        return $this->create = $this->model->base()->lowercase()->plural();
    }

    /**
     * Generate the update endpoint
     *
     * @return string
     */
    public function update()
    {
        return $this->update = $this->model->base()->lowercase()->singular().'/'.$this->model->id;
    }

    /**
     * Generate the delete endpoint
     *
     * @return string
     */
    public function delete()
    {
        return $this->delete = $this->model->base()->lowercase()->singular().'/'.$this->model->id;
    }
}
