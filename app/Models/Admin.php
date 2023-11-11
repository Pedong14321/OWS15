<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory; //  adds the ability to generate timestamps for the model.

    protected $primaryKey = 'admin_id';

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
        'google_id',
    ];

    protected $hidden = [ // hidden from the model's JSON representation
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    
    public function adminType() { // define relationships between the Admin
        return $this->belongsTo(AdminType::class, 'admintype_id');
    }

    public function office() { // define relationships between the Admin
        return $this->belongsTo(Office::class, 'office_id');
    }
}
