<?php namespace PhilipBrown\CapsuleCRM\Persistance;

trait Storable
{
    /**
     * Create a new entity
     *
     * @param array $attributes
     * @return Model
     */
    public static function create(array $attributes)
    {
        $model = new static($this->connection, $attributes);

        $model->save();

        return $model;
    }

    /**
     * Update an existing entity
     *
     * @param array $attributes
     * @return Model
     */
    public function update(array $attributes)
    {
        $this->fill($attributes);

        return $this->save();
    }

    /**
     * Save the current entity
     *
     * @return bool
     */
    public function save()
    {
        if ($this->validate()) {
            if ($this->isNewEntity()) {
                return $this->createNewEntityRequest();
            }

            return $this->updateExistingEntityRequest();
        }

        return false;
    }

    /**
     * Is this a new entity?
     *
     * @return bool
     */
    private function isNewEntity()
    {
        return ! isset($this->attributes['id']);
    }

    /**
     * Is this an existing entity?
     *
     * @return bool
     */
    private function isPersisted()
    {
        return ! $this->isNewEntity();
    }

    /**
     * Create a new entity request
     *
     * @return Model
     */
    private function createNewEntityRequest()
    {
        $endpoint = '/api/'.$this->persistableConfig()->create();

        $this->id = $this->connection->post($endpoint, $this->toJson());

        return true;
    }

    /**
     * Update an existing request
     *
     * @return Model
     */
    private function updateExistingEntityRequest()
    {
        $endpoint = '/api/'.$this->persistableConfig()->update();

        $this->connection->put($endpoint, $this->toJson());

        return true;
    }
}
