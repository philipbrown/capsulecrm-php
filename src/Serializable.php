<?php namespace PhilipBrown\CapsuleCRM;

trait Serializable {

  /**
   * An array of serializable options
   *
   * @var array
   */
  protected $serializableOptions;

  /**
   * Serialize the current object to JSON
   *
   * @return string
   */
  public function toJson()
  {
    return $this->serializer()->serialize($this);
  }

  /**
   * Return the serializable options
   *
   * @return array
   */
  public function serializableOptions()
  {
    $this->setSerializableOptionsArray();

    return array_merge($this->serializableOptions, $this->serializableConfig);
  }

  /**
   * Set the serializable options array
   *
   * @return void
   */
  private function setSerializableOptionsArray()
  {
    $this->serializableOptions = [
      'root' => $this->base()->lowercase()->singular(),
      'collection_root' => $this->base()->lowercase()->plural(),
      'include_root' => true
    ];
  }

  /**
   * Create a new Serializer object
   *
   * @return Serializer
   */
  private function serializer()
  {
    $this->setSerializableOptionsArray();

    return new Serializer($this->serializableOptions);
  }

}
