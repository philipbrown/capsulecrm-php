<?php namespace PhilipBrown\CapsuleCRM;

use PhilipBrown\CapsuleCRM\Associations\HasMany;
use PhilipBrown\CapsuleCRM\Associations\BelongsTo;
use PhilipBrown\CapsuleCRM\Associations\HasManyAssociation;
use PhilipBrown\CapsuleCRM\Associations\BelongsToAssociation;

trait Associations
{
    use HasMany;
    use BelongsTo;

    /**
     * Return the Has Many associations
     *
     * @return array
     */
    public function hasManyAssociations(){}

    /**
     * Return the Belongs To associations
     *
     * @return array
     */
    public function belongsToAssociations()
    {
        $associations = [];

        foreach ($this->associations as $name => $association) {
            if ($association instanceOf BelongsToAssociation) {
                $associations[$name] = $association;
            }
        }

        return $associations;
    }
}
