<?php namespace PhilipBrown\CapsuleCRM;

class Phone extends Model
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
        'phone_number',
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
     * Create a new Phone
     *
     * @param array $attributes
     * @return void
     */
    public function __construct(array $attributes)
    {
        $this->fill($attributes);
    }
}
