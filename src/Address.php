<?php namespace PhilipBrown\CapsuleCRM;

class Address extends Model
{
    use Serializable;

    /**
     * @var array
     */
    protected $attributes;

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'type',
        'street',
        'city',
        'state',
        'zip',
        'country'
    ];

    /**
    * The serializble config
    *
    * @var array
    */
    protected $serializableConfig = [
        'include_root' => false,
        'exclude_id' => false
    ];

    /**
     * Create a new Address
     *
     * @param array $attributes
     * @return void
     */
    public function __construct(array $attributes)
    {
        $this->fill($attributes);
    }
}
