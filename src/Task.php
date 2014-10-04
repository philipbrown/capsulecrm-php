<?php namespace PhilipBrown\CapsuleCRM;

use PhilipBrown\CapsuleCRM\Querying\Findable;
use PhilipBrown\CapsuleCRM\Persistance\Persistable;

class Task extends Model
{
    use Findable;
    use Validating;
    use Serializable;
    use Associations;
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
        'description',
        'detail',
        'category',
        'due_date',
        'owner',
        'party_id',
        'party_name',
        'status',
        'due_date_time'
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
                return $this->createUrl();
            }
        ];

        $this->belongsTo('party');
        $this->belongsTo('opportunity');
        $this->belongsTo('kase');
        $this->belongsTo('owner', ['class_name' => 'User', 'serializable_key' => 'owner']);
        $this->belongsTo('category', ['class_name' => 'TaskCategory', 'serializable_key' => 'category']);
    }

    public function createUrl()
    {
        if ($this->party) return 'party/'.$this->party->id.'/task';
        if ($this->opportunity) return 'opportunity/'.$this->opportunity->id.'/task';
        if ($this->kase) return 'kase/'.$this->kase->id.'/task';

        return 'task';
    }
}
