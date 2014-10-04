<?php namespace PhilipBrown\CapsuleCRM\Associations;

use PhilipBrown\CapsuleCRM\Model;

class HasManyAssociation
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Model
     */
    private $model;

    /**
     * @var array
     */
    private $options;

    /**
     * Create a new HasManyAssociation
     *
     * @param string $name
     * @param Model $model
     * @return void
     */
    public function __construct($name, $model, $options = [])
    {
        $this->name = $name;
        $this->model = $model;
        $this->options = $options;
    }

    public function proxy(Model $parent)
    {
        return new HasManyProxy($parent, $this->targetClass());
    }

    public function targetClass()
    {
        if (isset($this->options['target_class'])) {
            return $this->$this->options['target_class'];
        }

        return $this->inferTargetClass();
    }

    private function inferTargetClass()
    {
        return 'PhilipBrown\\CapsuleCRM\\'.ucfirst($this->name);
    }
}
