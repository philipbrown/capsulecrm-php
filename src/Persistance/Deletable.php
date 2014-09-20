<?php namespace PhilipBrown\CapsuleCRM\Persistance;

trait Deletable
{
    /**
     * Delete an existing model
     *
     * @return bool
     */
    public function delete()
    {
        $endpoint = '/api/'.$this->persistableConfig()->delete();

        if ($this->connection->delete($endpoint)) {
            $this->id = null;

            return true;
        }

        return false;
    }
}
