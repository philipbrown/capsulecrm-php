<?php namespace PhilipBrown\CapsuleCRM\Associations;

trait BelongsTo
{
    /**
     * Create a new BelongsToAssociation
     *
     * @param string $name
     * @param array $options
     * @return void
     */
    public function belongsTo($name, $options = [])
    {
        $association = new BelongsToAssociation($name, $this, $options);

        $this->associations[$name] = $association;
    }
}
