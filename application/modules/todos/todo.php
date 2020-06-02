<?php

namespace Tumic\Modules\Todos;

use PDO;
use Tumic\Lib\ParamConverter;
use Tumic\Modules\Base\BaseModel;
use Tumic\Modules\Base\Validable\Validable;
use Tumic\Modules\Base\Validable\Validators\Date;
use Tumic\Modules\Base\Validable\Validators\Required;

class Todo extends BaseModel
{
    use Validable;
    public $id, $text, $deadline, $state, $priority, $vehicle_id, $vehicle_name, $assignee_id, $assignee_name, $assigned_id, $assigned_name, $created_at, $updated_at;

    public function __construct($props = [])
    {
        foreach ($props as $name => $val) {
            $this->$name = $val;
        }
        $this->setValidators("text", new Required());
        $this->setValidators("deadline", new Required(), new Date(strtotime("today")));
        $this->setValidators("state", new Required());
        $this->setValidators("priority", new Required());
        $this->setValidators("assignee_id", new Required());
        $this->setValidators("assigned_id", new Required());
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }

        if (parent::check_lock() === false) return false;

        // update
        if ($this->id) {
            $query = parent::$pdo->prepare('UPDATE todos 
                SET text = :text,
                    deadline = :deadline,
                    state = :state,
                    priority = :priority,
                    vehicle_id = :vehicle_id,
                    assignee_id = :assignee_id,
                    assigned_id = :assigned_id,
                    updated_at = NOW()
                WHERE id = :id;
            )
            ');
            $params = $this->getDbParams();
            $res = $query->execute($params);
        } else {
            // create
            $query = parent::$pdo->prepare('INSERT INTO todos 
            (
                text, deadline, state, priority, vehicle_id, assignee_id, assigned_id
            )
            VALUES (
                :text, :deadline, :state, :priority, :vehicle_id, :assignee_id, :assigned_id
            )
            ');
            $params = $this->getDbParams();
            unset($params["id"]);
            $res = $query->execute($params);
            $this->id = self::$pdo->lastInsertId();
            return $res;
        }
        if (!$res) {
            $this->errors[] = ["unknown" => "Unknown error during save"];
            return false;
        } else {
            return true;
        }
    }

    private function getDbParams()
    {
        $todo_params = [
            'id' => $this->id,
            'text' => $this->text,
            'deadline' => $this->deadline,
            'state' => $this->state,
            'priority' => $this->priority,
            'vehicle_id' => $this->vehicle_id,
            'assignee_id' => $this->assignee_id,
            'assigned_id' => $this->assigned_id
        ];

        $todo_params = ParamConverter::getInstance()->convertParams($todo_params, [
            "datetime" => ["deadline"],
            "nullable" => ["vehicle_id"]
        ]);

        return $todo_params;
    }

    #region enums
    public static $priorities = [
        "1" => "Neodkladné",
        "2" => "Kritické",
        "3" => "Normální",
        "4" => "Nízká",
        "5" => "Velmi nízká"
    ];

    public static $states = [
        "1" => "Nové",
        "2" => "Zpracovává se",
        "3" => "Hotové"
    ];
    #endregion enums

    #region static methods
    public static function getAll()
    {
        $sql = 'SELECT t.*, 
                    vehicle.name as vehicle_name, 
                    vehicle.SPZ as vehicle_spz, 
                    assignee.name as assignee_name, 
                    assigned.name as assigned_name
                FROM todos t
                LEFT JOIN users assignee on (assignee.id = t.assignee_id)
                LEFT JOIN users assigned on (assigned.id = t.assigned_id)
                LEFT JOIN vehicles vehicle on (vehicle.id = t.vehicle_id)
                ORDER BY deadline
                ;';
        $query = parent::$pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }


    public static function getAllBy($params)
    {
        $params = ParamConverter::getInstance()->convertParams($params, [
            "array" => ["state", "priority", "vehicle_id", "assigned_id"]
        ]);

        $sql = 'SELECT t.*, 
                    vehicle.name as vehicle_name, 
                    vehicle.SPZ as vehicle_spz, 
                    assignee.name as assignee_name, 
                    assigned.name as assigned_name
                FROM todos t
                LEFT JOIN users assignee on (assignee.id = t.assignee_id)
                LEFT JOIN users assigned on (assigned.id = t.assigned_id)
                LEFT JOIN vehicles vehicle on (vehicle.id = t.vehicle_id)';

        $params = array_filter($params, function ($x) {
            return $x;
        });

        if (count($params) > 0) {
            $sql .= 'WHERE ';
            $first = true;
            foreach ($params as $param => $value) {

                if (!$first) $sql .= "and ";
                if (strpos($value, "null") !== false) {
                    $sql .= "$param is null ";
                } else {
                    $sql .= " $param in ($value) ";
                }

                if ($first) $first = false;
            }
        }


        $sql .= 'ORDER BY deadline
                ;';
        $query = parent::$pdo->prepare($sql);

        $query->execute($params);
        $res = $query->fetchAll(PDO::FETCH_CLASS, __CLASS__);

        return $res;
    }


    public static function get($id): ?Todo
    {
        $query = parent::$pdo->prepare('SELECT * FROM todos WHERE id=:id;');
        $query->execute(['id' => $id]);
        $res = $query->fetchObject(__CLASS__);
        return $res ? $res : null;
    }

    public static function destroy($id): bool
    {
        $query = parent::$pdo->prepare('DELETE FROM todos
                WHERE id = :id;
        ');
        $res = $query->execute(["id" => $id]);

        if (!$res) {
            $this->errors[] = ["unknown" => "Unknown error during save"];
            return false;
        } else {
            return true;
        }
    }
    #endregion static methods
}
