<?php namespace PhilipBrown\CapsuleCRM;

use PhilipBrown\CapsuleCRM\Querying\FindOne;
use PhilipBrown\CapsuleCRM\Querying\Configuration;
use PhilipBrown\CapsuleCRM\Persistance\Persistable;

class History extends Model
{
    use FindOne;
    use Associations;
    use Configuration;
    use Serializable;
    use Validating;
    use Persistable;

  /**
   * The model's validation rules
   *
   * @param array
   */
  protected $rules = [];

    /**
     * The model's fillable attributes
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'type',
        'entry_date',
        'creator',
        'creator_name',
        'subject',
        'note',
        'attachments'
    ];

    /**
     * The model's serializble config
     *
     * @var array
     */
    protected $serializableConfig = [
        'root' => 'historyItem',
        'collection_root' => 'history'
    ];

    /**
     * The model's queryable options
     *
     * @var array
     */
    protected $queryableOptions = [
        'plural' => 'history'
    ];

    /**
     * Create a new instance of the model
     *
     * @param PhilipBrown\CapsuleCRM\Connection $connection
     * @param array $attributes;
     * @return void
     */
    public function __construct(Connection $connection,  array $attributes = [])
    {
        $this->connection = $connection;

        $this->fill($attributes);

        $this->persistableConfig = [
            'create' => function ($this){
                return $this->belongsToApiName().'/'.$this->belongsToId().'/history';
            }
        ];

        $this->belongsTo('creator', ['serializable_key' => 'creator', 'class_name' => 'Person']);
        $this->belongsTo('party', ['serialize' => false]);
        $this->belongsTo('case', ['serialize' => false]);
        $this->belongsTo('opportunity', ['serialize' => false]);
    }

    /**
     * Return the belongs to id
     *
     * @return int
     */
    public function belongsToId()
    {
        if ($this->party) return $this->party->id;
        if ($this->kase) return $this->kase->id;
        if ($this->opportunity) return $this->opportunity->id;
    }

    /**
     * Return the belongs to name
     *
     * @return string
     */
    public function belongsToName()
    {
        if ($this->party) return (string) $this->party->base()->lowercase();
        if ($this->kase) return (string) $this->kase->base()->lowercase();
        if ($this->opportunity) return (string) $this->opportunity->base()->lowercase();
    }

    /**
     * Return the belongs to api name
     *
     * @return string
     */
    public function belongsToApiName()
    {
        $array = [
            'person' => 'party',
            'organisation' => 'party',
            'case' => 'case',
            'opportunity' => 'opportunity'
        ];

        return $array[$this->belongsToName()];
    }
}
