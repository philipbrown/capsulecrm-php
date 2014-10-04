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
    public $model;

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
        return $this->options['include_root'];
    }

    /**
     * Return the root of the model
     *
     * @return string
     */
    private function root()
    {
        if (isset($this->options['root'])) {
            return (string) $this->options['root'];
        }

        return (string) $this->model->base()->lowercase()->singular()->camelcase();
    }

    /**
     * Serialize the model with the root
     *
     * @return string
     */
    private function serializeWithRoot()
    {
        return json_encode([$this->root() => $this->buildAttributesArray()]);
    }

    /**
     * Serialize the model without the root
     *
     * @return string
     */
    private function serializeWithoutRoot()
    {
        return json_encode($this->buildAttributesArray());
    }

    /**
     * Build the attributes array
     *
     * @return array
     */
    private function buildAttributesArray()
    {
        return Helper::toCamelCase($this->cleanedAttributes());
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
        $attributes = [];

        foreach ($this->model->attributes() as $name => $attribute) {
            if ($attribute instanceof \DateTime) {
                $attributes[$name] = $attribute->format('Y-m-d\TH:i:s\Z');
            }

            else {
                $attributes[$name] = $attribute;
            }
        }

        foreach ($this->options['additional_methods'] as $method) {
            $attributes = array_merge($attributes, [$method => json_decode($this->model->$method()->toJson())]);
        }

        if (array_key_exists('PhilipBrown\CapsuleCRM\Associations', class_uses($this->model))) {
            foreach ($this->model->belongsToAssociations() as $name => $association) {
                if ($association->serialize() && $this->belongsToValue($this->model, $name)) {
                    $attributes = array_merge($attributes, [
                        $association->serializableKey() => $this->belongsToValue($this->model, $name)
                    ]);
                }
            }
        }

        return $attributes;
    }

    /**
     * Get the id of the associated entity
     *
     * @param Model $model
     * @param string $name
     * @return string
     */
    private function belongsToValue(Model $model, $name)
    {
        $value = $model->{$name};

        if (! is_null($value) && $value->id) {
            return $value->id;
        }

        return $value;
    }
}
