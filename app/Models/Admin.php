<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Database\Factories\AdminFactory;


class Admin extends Authenticatable // extending authenticable makes it process authentication like login, see config>auth.php
{
    protected static function newFactory()
    {
        return AdminFactory::new();
    }

    use HasFactory; //  adds the ability to generate timestamps for the model.

    protected $table = 'admins'; // specifies the name of the database table that the model maps to

    protected $primaryKey = 'admin_id'; // specifies the primary key of the table

    protected $fillable = [ // allows you to set multiple fields on a model at once
        'admin_lname',
        'admin_fname',
        'admin_mi',
        'admin_image',
        'employee_id',
        'admin_contact',
        'email',
        'admin_image',
        'admin_sign',
        'admintype_id',
        'office_id',
        'position_id',
        'password',
    ];

    protected $hidden = [ // hidden from the model's JSON representation
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function adminType()
    { // define relationships between the Admin
        return $this->belongsTo(AdminType::class, 'admintype_id');
    }

    public function office()
    { // define relationships between the Admin
        return $this->belongsTo(Office::class, 'office_id');
    }
}
