<?php namespace PhilipBrown\CapsuleCRM\Associations;

trait BelongsTo
{
    /**
     * Create a new BelongsToAssociation
     *
     * @param string $name
     * @return void
     */
    public function belongsTo($name)
    {
        $association = new BelongsToAssociation($name, $this);

        $this->associations[$name] = $association;
    }
}
