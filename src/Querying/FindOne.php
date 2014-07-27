<?php namespace PhilipBrown\CapsuleCRM\Querying;

trait FindOne {

  /**
   * Find a single entity by it's id
   *
   * @param int $id
   * @return PhilipBrown\CapsuleCRM\Entity
   */
  public function find($id)
  {
    $endpoint = '/api/'.$this->queryableOptions()->singular().'/'.$id;

    $response = $this->connection->get($endpoint);

    return $response->json();
  }

}
