<?php namespace PhilipBrown\CapsuleCRM;

trait Serializable {

  /**
   * An array of serializable options
   *
   * @var array
   */
  protected $serializableOptions;

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
      'collection_root' => $this->base()->lowercase()->plural()
    ];
  }

}
