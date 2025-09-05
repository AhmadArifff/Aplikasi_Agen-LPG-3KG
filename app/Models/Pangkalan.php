<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pangkalan extends Model
{
    use SoftDeletes;

    // Nama tabel
    protected $table = 'tb_pangkalan';

    // Primary key
    protected $primaryKey = 'pklan_id';

    // Karena PK auto increment (increments), tetap default integer
    public $incrementing = true;
    protected $keyType = 'int';

    // Custom timestamps
    const CREATED_AT = 'pklan_created_at';
    const UPDATED_AT = 'pklan_updated_at';
    const DELETED_AT = 'pklan_deleted_at';

    // Kolom yang bisa diisi
    protected $fillable = [
        'w_id',
        'pklan_nama_pangkalan',
        'pklan_alamat',
        'pklan_no_telepon',
    ];

    // Relasi: Pangkalan milik satu Wilayah
    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'w_id', 'w_id');
    }
}
