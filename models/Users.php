<?php

namespace App\models;


use Arbor\database\orm\Model;
use App\models\Products;


class Users extends Model
{
    protected static ?string $tableName = 'users';


    public function products()
    {
        return $this->hasMany(
            Products::class,            // Model class
            'user_id',                  // Foreign Key
            $this->getPrimaryKey()      // Local Key
        );
    }
}
