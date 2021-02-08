<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable =[
        'genderId','serviceId', 'firstName','lastName','dateOfBirth','comments'
    ];

    protected $with=['gender','service'];

    Public function gender() {
        return $this->belongsTo(Gender::class,'genderId');
    }

    Public function service() {
        return $this->belongsTo(Service::class,'serviceId');
    }

}
