<?php namespace PhilipBrown\CapsuleCRM\Associations;

trait BelongsTo
{
    public function belongsTo($name)
    {
        $association = new BelongsToAssociation($name, $this);

        $this->associations[strtolower($name)] = $association;
    }
}
