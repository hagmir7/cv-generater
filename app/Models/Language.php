<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    public $fillable = ['language','level', 'person_id'];


    protected $table = 'languages';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    public $incremeting = true;
    public $timestamps = false;
}
