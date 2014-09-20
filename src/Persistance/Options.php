<?php namespace PhilipBrown\CapsuleCRM\Persistance;

use PhilipBrown\CapsuleCRM\Model;

class Options
{
    /**
     * @var Model
     */
    private $model;

    /**
     * @var array
     */
    private $options;

    /**
     * Create a new Options object
     *
     * @param PhilipBrown\CapsuleCRM\Model
     * @param array
     * @return void
     */
    public function __construct(Model $model, array $options)
    {
        $this->model = $model;
        $this->options = $options;
    }

    /**
     * Generate the create endpoint
     *
     * @return string
     */
    public function create()
    {
        if (isset($this->options['create'])) return $this->options['create']();

        return $this->model->base()->lowercase()->plural();
    }

    /**
     * Generate the update endpoint
     *
     * @return string
     */
    public function update()
    {
        if (isset($this->options['update'])) return $this->options['update']();

        return $this->model->base()->lowercase()->singular().'/'.$this->model->id;
    }

    /**
     * Generate the delete endpoint
     *
     * @return string
     */
    public function delete()
    {
        if (isset($this->options['delete'])) return $this->options['delete']();

        return $this->model->base()->lowercase()->singular().'/'.$this->model->id;
    }
}
