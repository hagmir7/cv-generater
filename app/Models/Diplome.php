<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diplome extends Model
{
    use HasFactory;
    public $fillable = ['diplome', 'establishment', 'date_obtained', 'city', 'description', 'person_id'];


    protected $table = 'diplomes';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    public $incremeting = true;
    public $timestamps = false;
}
