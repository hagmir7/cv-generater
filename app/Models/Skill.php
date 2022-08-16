<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    
    public $fillable = ['skill','level', 'person_id'];


    protected $table = 'skills';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    public $incremeting = true;
    public $timestamps = false;
}
