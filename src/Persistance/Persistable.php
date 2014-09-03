<?php namespace PhilipBrown\CapsuleCRM\Persistance;

trait Persistable {

    /**
     * Create a new entity
     *
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes){}

    /**
     * Update an existing entity
     *
     * @param array $attributes
     * @return Model
     */
    public function update(array $attributes){}

    /**
     * Save the current entity
     *
     * @return bool
     */
    public function save(){}

    /**
     * Is this a new entity?
     *
     * @return bool
     */
    private isNewEntity()
    {
        return isset($this->attributes['id']);
    }

    /**
     * Is this an existing entity?
     *
     * @return bool
     */
    private isExistingEntity()
    {
        return ! $this->isNewEntity();
    }

    /**
     * Create a new entity request
     *
     * @return Model
     */
    private function createNewEntityRequest(){}

    /**
     * Update an existing request
     *
     * @return Model
     */
    private function updateExistingEntityRequest(){}
}
