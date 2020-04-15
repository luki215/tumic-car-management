<?php

namespace Tumic\Modules\Users;

use PDO;
use Tumic\Lib\ParamConverter;
use Tumic\Modules\Base\BaseModel;
use Tumic\Modules\Base\Validable\Validable;
use Tumic\Modules\Base\Validable\Validators\Required;

class User extends BaseModel
{
    use Validable;
    public $id, $fb_id, $name, $role, $updated_at;

    public function __construct($props = [])
    {
        foreach ($props as $name => $val) {
            $this->$name = $val;
        }

        $this->setValidators("name", new Required());
        $this->setValidators("role", new Required());
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }


        // update
        if ($this->id) {
            $query = parent::$pdo->prepare('UPDATE users 
                SET name = :name,
                    role = :role,
                    updated_at = :updated_at
                WHERE id = :id;
            )
            ');
            $params = $this->getDbParams();
            unset($params["fb_id"]);
            $res = $query->execute($params);
        } else {
            // create
            $query = parent::$pdo->prepare('INSERT INTO users 
            (
                fb_id, name, role, updated_at
            )
            VALUES (
                :fb_id, :name, :role, :updated_at
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
        $user_params = [
            'id' => $this->id,
            'fb_id' => $this->fb_id,
            'name' => $this->name,
            'role' => $this->role,
            'updated_at' => $this->updated_at,
        ];

        return $user_params;
    }


    #region enums
    public static $roles = [
        "1" => "Administrátor",
        "2" => "Mechanik",
        "3" => "Účetní",
        "4" => "Nepotvrzen"
    ];
    #endregion enums

    #region static methods
    public static function getAll()
    {
        $sql = 'SELECT * FROM users ORDER BY role';
        $query = parent::$pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    // source for <select> options
    public static function getAllOptions()
    {
        $sql = 'SELECT * FROM users ORDER BY role';
        $query = parent::$pdo->prepare($sql);
        $query->execute();
        $res = $query->fetchAll(PDO::FETCH_CLASS, __CLASS__);
        $options = [];
        foreach ($res as $user) {
            $options[$user->id] = $user->name;
        };
        return $options;
    }

    public static function getByFBId($fb_id): ?User
    {
        $query = parent::$pdo->prepare('SELECT * FROM users WHERE fb_id=:fb_id;');
        $query->execute(['fb_id' => $fb_id]);
        $res = $query->fetchObject(__CLASS__);
        return $res ? $res : null;
    }

    public static function get($id): ?User
    {
        $query = parent::$pdo->prepare('SELECT * FROM users WHERE id=:id;');
        $query->execute(['id' => $id]);
        $res = $query->fetchObject(__CLASS__);
        return $res ? $res : null;
    }

    public static function destroy($id): bool
    {
        $query = parent::$pdo->prepare('DELETE FROM users
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
