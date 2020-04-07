<?php

namespace Tumic\Modules\Vehicles;

use PDO;
use Tumic\Lib\ParamConverter;
use Tumic\Modules\Base\BaseModel;
use Tumic\Modules\Base\Validable\Validable;
use Tumic\Modules\Base\Validable\Validators\Date;
use Tumic\Modules\Base\Validable\Validators\Length;
use Tumic\Modules\Base\Validable\Validators\Required;

class Vehicle extends BaseModel
{
    use Validable;

    public $id, $name, $engine, $VIN, $photo, $color, $SPZ, $STK, $insurance, $tachometer,
        $note, $type, $avg_kilometers, $tires_size, $tires_type, $tires_kind, $tires_brand,
        $tires_mm, $archived, $updated_at;

    public function __construct($props)
    {
        foreach ($props as $name => $val) {
            $this->$name = $val;
        }

        $this->setValidators("name", new Required());
        $this->setValidators("engine", new Required());
        $this->setValidators("type", new Required());
        $this->setValidators("VIN", new Required(), new Length(17));
        $this->setValidators("insurance", new Required(), new Date());
        $this->setValidators("STK", new Required(), new Date());
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }


        // update
        if ($this->id) {
        } else {
            // create

            $query = parent::$pdo->prepare('INSERT INTO vehicles 
            (
                name, engine, VIN, photo, color, SPZ, STK, insurance, tachometer, note, type,
                avg_kilometers, tires_size, tires_type, tires_kind, tires_brand, tires_mm,
                archived, updated_at
            )
            VALUES (
                :name, :engine, :VIN, :photo, :color, :SPZ, :STK, :insurance, :tachometer, :note, :type,
                :avg_kilometers, :tires_size, :tires_type, :tires_kind, :tires_brand, :tires_mm,
                :archived, :updated_at
            )
            ');


            $res = $query->execute($this->getDbParams());

            if (!$res) {
                return ["unknown" => "Unknown error during save"];
            } else {
                return true;
            }
        }
    }

    private function getDbParams()
    {
        $vehicle_params = [
            'name' => $this->name,
            'engine' => $this->engine,
            'VIN' => $this->VIN,
            'photo' => $this->photo,
            'color' => $this->color,
            'SPZ' => $this->SPZ,
            'STK' => $this->STK,
            'insurance' => $this->insurance,
            'tachometer' => $this->tachometer,
            'note' => $this->note,
            'type' => $this->type,
            'avg_kilometers' => $this->avg_kilometers,
            'tires_size' => $this->tires_size,
            'tires_type' => $this->tires_type,
            'tires_kind' => $this->tires_kind,
            'tires_brand' => $this->tires_brand,
            'tires_mm' => $this->tires_mm,
            'archived' => $this->archived,
            'updated_at' => $this->updated_at,
        ];

        $vehicle_params = ParamConverter::getInstance()->convertParams($vehicle_params, [
            "datetime" => ["STK", "insurance"],
            "bool" => ["archived"]
        ]);

        return $vehicle_params;
    }


    #region enums
    public static $colors = [
        "1" => "Modrá",
        "2" => "Červená",
        "3" => "Zelená",
        "4" => "Šedá",
        "5" => "Bílá",
        "6" => "Žlutá",
    ];

    public static $types = [
        "1" => "Osobní",
        "2" => "Nákladní",
        "3" => "Bagry",
        "4" => "Stroje"
    ];

    public static $tireTypes = [
        "1" => "Letní",
        "2" => "Zimní",
        "3" => "Celoroční",
    ];

    public static $tireKinds = [
        "1" => "Silniční",
        "2" => "Terénní",
    ];
    public static $tireBrands = [
        "1" => "Michelin",
        "2" => "Durex",
    ];
    #endregion enums


    #region static methods
    public static function getAllByType($type)
    {
        $query = parent::$pdo->prepare('SELECT * FROM vehicles WHERE type=:type;');
        $query->execute([':type' => $type]);
        return $query->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    #endregion static methods
}
