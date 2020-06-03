<?php

namespace Tumic\Modules\Vehicles\Events;

use PDO;
use Tumic\Lib\ParamConverter;
use Tumic\Modules\Base\BaseModel;
use Tumic\Modules\Base\Validable\Validable;
use Tumic\Modules\Base\Validable\Validators\Required;

class VehicleEvent extends BaseModel
{
    use Validable;

    public $id, $vehicle_id, $tachometer, $date, $note, $type, $updated_at;

    public function __construct($props = [])
    {
        foreach ($props as $name => $val) {
            $this->$name = $val;
        }

        $this->setValidators("vehicle_id", new Required());
        $this->setValidators("date", new Required());
        $this->setValidators("type", new Required());
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }

        if (!parent::check_lock()) return false;

        // update
        if ($this->id) {
            $query = parent::$pdo->prepare('UPDATE vehicle_events
                SET
                    vehicle_id = :vehicle_id,
                    tachometer = :tachometer,
                    date = :date,
                    note = :note,
                    type = :type,
                    updated_at = NOW()
                WHERE id = :id;
            )
            ');
            $res = $query->execute($this->getDbParams());
        } else {
            // create
            $query = parent::$pdo->prepare('INSERT INTO vehicle_events 
            (
                vehicle_id, tachometer, date, note, type
            )
            VALUES (
                :vehicle_id, :tachometer, :date, :note, :type
            )
            ');
            $params = $this->getDbParams();
            unset($params["id"]);
            $res = $query->execute($params);
        }
        if (!$res) {
            // var_dump(parent::$pdo->errorInfo());
            // echo "<pre>";
            // var_dump($query->debugDumpParams());
            // echo "</pre>";
            $this->errors[] = ["unknown" => "Unknown error during save"];
            return false;
        } else {
            return true;
        }
    }

    private function getDbParams()
    {
        $vehicle_params = [
            'id' => $this->id,
            'vehicle_id' => $this->vehicle_id,
            'tachometer' => $this->tachometer,
            'date' => $this->date,
            'note' => $this->note,
            'type' => $this->type,
        ];

        $vehicle_params = ParamConverter::getInstance()->convertParams($vehicle_params, [
            "datetime" => ["date"]
        ]);

        return $vehicle_params;
    }

    public static $types = [
        "1" => "Oprava",
        "2" => "Výměna oleje",
        "3" => "Nehoda"
    ];

    #endregion enums


    #region static methods
    public static function getByType($vehicle_id, $type)
    {
        $sql = 'SELECT * FROM vehicle_events  WHERE type=:type and vehicle_id=:vehicle_id';
        $query = parent::$pdo->prepare($sql);
        $query->execute(["type" => $type, "vehicle_id" => $vehicle_id]);
        return $query->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    public static function get($id): ?VehicleEvent
    {
        $query = parent::$pdo->prepare('SELECT * FROM vehicle_events WHERE id=:id;');
        $query->execute(['id' => $id]);
        $res = $query->fetchObject(__CLASS__);
        return $res ? $res : null;
    }

    public static function destroy($id): bool
    {
        $query = parent::$pdo->prepare('DELETE FROM vehicle_events
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
