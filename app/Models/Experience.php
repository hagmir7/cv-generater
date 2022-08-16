<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    public $fillable = ['experience', 'company', 'start_date', 'end_date', 'city', 'description', 'person_id'];


    protected $table = 'experiences';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    public $incremeting = true;
    public $timestamps = false;


}
