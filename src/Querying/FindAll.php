<?php namespace PhilipBrown\CapsuleCRM\Querying;

trait FindAll {

  /**
   * Return all entities of the current model
   *
   * @param array $params
   * @return array
   */
  public function all($params = [])
  {
    $endpoint = '/api/'.$this->queryableOptions()->plural();

    $response = $this->connection->get($endpoint, $params);

    return $response->json();
  }

}
