<?php namespace PhilipBrown\CapsuleCRM\Querying;

use PhilipBrown\CapsuleCRM\Normalizer;

trait FindOne {

  /**
   * Find a single entity by it's id
   *
   * @param int $id
   * @return array
   */
  public function find($id)
  {
    $endpoint = '/api/'.$this->queryableOptions()->singular().'/'.$id;

    $response = $this->connection->get($endpoint)->json();

    $normalizer = new Normalizer($this);

    return $normalizer->model($response);
  }

}
