<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quality extends Model
{
    use HasFactory;

    public $fillable = ['qualite', 'person_id'];


    protected $table = 'qualities';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    public $incremeting = true;
    public $timestamps = false;
}
