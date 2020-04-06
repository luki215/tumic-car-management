<?php

namespace Tumic\Modules\Vehicles;

use PDO;
use Tumic\Modules\Base\BaseModel;

class Vehicle extends BaseModel
{
    public $id, $name, $engine, $VIN, $photo, $color, $SPZ, $STK, $insurance, $tachometer,
        $note, $type, $avg_kilometers, $tires_size, $tires_type, $tires_kind, $tires_brand,
        $tires_mm, $archived, $updated_at;



    /**
     * enums
     */
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

    /**
     * static methods
     */


    public static function getAllByType($type)
    {
        $query = parent::$pdo->prepare('SELECT * FROM vehicles WHERE type=:type;');
        $query->execute([':type' => $type]);
        return $query->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }
}
