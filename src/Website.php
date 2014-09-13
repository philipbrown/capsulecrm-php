<?php namespace PhilipBrown\CapsuleCRM;

class Website extends Model
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
        'web_service',
        'web_address'
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
     * Create a new Website
     *
     * @param array $attributes
     * @return void
     */
    public function __construct(array $attributes)
    {
        $this->fill($attributes);
    }
}
