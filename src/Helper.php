<?php namespace PhilipBrown\CapsuleCRM;

use Illuminate\Support\Str;

class Helper {

  /**
   * Transform the keys of an array to snake case
   *
   * @param array $attributes
   * @return array
   */
  public static function toSnakeCase(array $attributes)
  {
    $snakeified = [];

    foreach($attributes as $key => $value)
    {
      $snakeified[Str::snake($key)] = $value;
    }

    return $snakeified;
  }

  /**
   * Transform the keys of an array to camel case
   *
   * @param array attributes
   * @return array
   */
  public static function toCamelCase(array $attributes)
  {
    $camelified = [];

    foreach($attributes as $key => $value)
    {
      $camelified[Str::camel($key)] = $value;
    }

    return $camelified;
  }

}
