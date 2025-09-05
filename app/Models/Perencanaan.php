<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perencanaan extends Model
{
    use SoftDeletes;

    // Nama tabel
    protected $table = 'tb_perencanaan_agen';

    // Primary key
    protected $primaryKey = 'pa_id';

    // PK auto increment
    public $incrementing = false;
    protected $keyType = 'string';

    // Custom timestamps
    const CREATED_AT = 'pa_created_at';
    const UPDATED_AT = 'pa_updated_at';
    const DELETED_AT = 'pa_deleted_at';

    // Kolom yang bisa diisi
    protected $fillable = [
        'pa_id',
        'pa_tgl_awal',
        'pa_tgl_akhir',
        'pa_kondisi',
        'w_id',
        'pklan_id',
        'pa_pembayaran',
        'pa_jumlah',
        'pa_jadwal',
        'pa_created_at',
        'pa_updated_at',
        'pa_deleted_at'
    ];
    public $timestamps = false; // pakai custom timestamp

    /**
     * Relasi ke Wilayah
     * Satu perencanaan milik satu wilayah
     */
    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'w_id', 'w_id');
    }

    /**
     * Relasi ke Pangkalan
     * Satu perencanaan milik satu pangkalan
     */
    public function pangkalan()
    {
        return $this->belongsTo(Pangkalan::class, 'pklan_id', 'pklan_id');
    }
}
