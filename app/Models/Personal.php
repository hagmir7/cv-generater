<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;

    public $fillable = [ 'first_name', 'last_name', 'email', 'city', 'address', 'cin', 'phone', 'zip', 'slug', 'user_id','job', 'bio'];


    protected $tabel = 'personal';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing  = false;
    public $timestamps = false;


    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function experience(){
        return $this->hasMany(Experience::class, 'person_id');
    }
    public function skill(){
        return $this->hasMany(Skill::class, 'person_id');
    }
    public function diplome(){
        return $this->hasMany(Diplome::class, 'person_id');
    }
    public function language(){
        return $this->hasMany(Language::class, 'person_id');
    }
    public function quality(){
        return $this->hasMany(Quality::class, 'person_id');
    }
    public function hobby(){
        return $this->hasMany(Hobby::class, 'person_id');
    }




}
