<?php namespace PhilipBrown\CapsuleCRM\Persistance;

trait Configuration
{
    /**
     * Return an instance of the Options object
     *
     * @return PhilipBrown\CapsuleCRM\Persistance\Options
     */
    public function persistableConfig()
    {
        return new Options($this, $this->persistableConfig);
    }
}
