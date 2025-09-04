<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pangkalan extends Model
{
    protected $table = 'tb_pangkalan';
    protected $primaryKey = 'pklan_id';
    public $timestamps = false;

    protected $fillable = [
        'pklan_nama_pangkalan',
        'pklan_alamat',
        'pklan_no_telepon',
        'w_id',
    ];

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'w_id', 'w_id');
    }

    public function perencanaan()
    {
        return $this->hasMany(PerencanaanAgen::class, 'pklan_id', 'pklan_id');
    }
}
