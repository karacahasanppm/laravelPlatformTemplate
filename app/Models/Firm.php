<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Firm extends Model
{
    use HasFactory;

    public function users(){
        return $this->hasMany(User::class);
    }

    public function recipients(){
         return $this->hasMany(Recipient::class,'firm_id');
    }

}
