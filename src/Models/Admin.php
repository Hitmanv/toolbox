<?php
/**
 * User: hitman
 * Date: 24/08/2017
 * Time: 5:33 PM
 */

namespace App\Models;


class Admin extends Model
{
    protected $guarded = [];

    public function setPasswordAttribute($value)
    {
        if($value) $this->attributes['password'] = bcrypt($value);
    }
}