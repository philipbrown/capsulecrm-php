<?php namespace PhilipBrown\CapsuleCRM\Querying;

use PhilipBrown\CapsuleCRM\Normalizer;

trait FindAll {

  /**
   * Return all entities of the current model
   *
   * @param array $params
   * @return array
   */
  public function all(array $params = [])
  {
    $endpoint = '/api/'.$this->queryableOptions()->plural();

    $response = $this->connection->get($endpoint, $params)->json();

    $normalizer = new Normalizer($this);

    return $normalizer->collection($response);
  }

}
