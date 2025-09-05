<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    use HasFactory;

    protected $table = 'tb_wilayah';
    protected $primaryKey = 'w_id';
    public $incrementing = false; 
    protected $keyType = 'string';

    protected $fillable = [
        'w_id',
        'w_nama_kabupaten_atau_kota',
    ];

    public function pangkalan()
    {
        return $this->hasMany(Pangkalan::class, 'w_id', 'w_id');
    }
}
