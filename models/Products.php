<?php

namespace App\models;


use Arbor\database\orm\Model;


class Products extends Model
{
    protected static ?string $tableName = 'products';

    public function users()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
}
