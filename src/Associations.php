<?php namespace PhilipBrown\CapsuleCRM;

use PhilipBrown\CapsuleCRM\Associations\BelongsTo;

trait Associations
{
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

        foreach ($this->associations as $association) {
            if ($association instanceOf BelongsTo) {
                $associations[] = $association;
            }
        }

        return $this->associations;
    }
}
