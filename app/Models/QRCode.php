<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QRCode extends Model
{
    use HasFactory;

    protected $table = 'qr_codes';

    protected $primaryKey = 'qrcode_id';

    protected $fillable = [ // the attributes for creating a model of qrcode
        'qrcode_filename',
        'student_osasid',
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function student() { // define relationships between the qr code
        return $this->belongsTo(Student::class, 'student_osasid');
    }
}
