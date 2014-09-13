<?php namespace PhilipBrown\CapsuleCRM;

class Serializer
{
    /**
     * @var array
     */
    private $options;

    /**
     * @var Model
     */
    public function $model;

    /**
     * Create a new Serializer
     *
     * @param array $options
     * @return void
     */
    public function __construct(array $options)
    {
        $this->options = $options;
    }

    /**
     * Serialize a model instance
     *
     * @param Model $model
     * @return string
     */
    public function serialize(Model $model)
    {
        $this->model = $model;

        if ($this->includeRoot()) {
            return $this->serializeWithRoot();
        }

        return $this->serializeWithoutRoot();
    }

    /**
     * Check to see if the current model should include the root
     *
     * @return bool
     */
    private function includeRoot()
    {
        return ! (isset($this->options['include_root'] && $this->options['include_root'] === false));
    }

    /**
     * Serialize the model with the root
     *
     * @return string
     */
    private function serializeWithRoot(){}

    /**
     * Serialize the model without the root
     *
     * @return string
     */
    private function serializeWithoutRoot()
    {
        return $this->buildAttributesArray();
    }

    /**
     * Build the attributes array
     *
     * @return array
     */
    private function buildAttributesArray()
    {
        return Helper::toCamelCase($this->cleanedAttributes);
    }

    /**
     * Return the cleaned attributes
     *
     * @return array
     */
    private function cleanedAttributes()
    {
        return $this->attributes();
    }

    /**
     * Get and format the model attributes
     *
     * @return array
     */
    private function attributes()
    {
        return $this->model->attributes();
    }
}
