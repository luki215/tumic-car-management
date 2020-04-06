<?php

namespace Tumic\Modules\Vehicles;

use PDO;
use Tumic\Modules\Base\BaseModel;

class Vehicle extends BaseModel
{
    public $id, $name, $engine, $VIN, $photo, $color, $SPZ, $STK, $insurance, $tachometer,
        $note, $type, $avg_kilometers, $tires_size, $tires_type, $tires_kind, $tires_brand,
        $tires_mm, $archived, $updated_at;

    public function __construct($props)
    {
        foreach ($props as $name => $val) {
            $this->$name = $val;
        }
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
