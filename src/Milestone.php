<?php namespace PhilipBrown\CapsuleCRM;

use PhilipBrown\CapsuleCRM\Querying\FindAll;
use PhilipBrown\CapsuleCRM\Querying\Configuration;

class Milestone extends Model
{
    use FindAll;
    use Validating;
    use Serializable;
    use Configuration;

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
        'name',
        'description',
        'probability',
        'complete'
    ];

    /**
     * The model's queryable options
     *
     * @var array
     */
    protected $queryableOptions = [
        'plural' => 'opportunity/milestones'
    ];

    /**
    * Create a new instance of the model
    *
    * @param PhilipBrown\CapsuleCRM\Connection $connection
    * @return void
    */
    public function __construct(Connection $connection, $attributes = [])
    {
        $this->connection = $connection;

        $this->fill($attributes);
    }

    /**
     * Find a milestone by it's id
     *
     * @param int $id
     * @return Milestone
     */
    public function find($id)
    {
        foreach ($this->all() as $milestone) {
            if ($milestone->id == $id) {
                return $milestone;
            }
        }
    }

    /**
     * Find a milestone by it's name
     *
     * @param int $id
     * @return Milestone
     */
    public function findByName($name)
    {
        foreach ($this->all() as $milestone) {
            if ($milestone->name == $name) {
                return $milestone;
            }
        }
    }
}
