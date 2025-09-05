<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wilayah extends Model
{
    // Nama tabel
    protected $table = 'tb_wilayah';

    // Primary key
    protected $primaryKey = 'w_id';

    // Tipe primary key (karena char, bukan integer autoincrement)
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom timestamps custom
    const CREATED_AT = 'w_created_at';
    const UPDATED_AT = 'w_updated_at';
    const DELETED_AT = 'w_deleted_at';

    // Aktifkan soft delete (karena ada kolom w_deleted_at)
    use SoftDeletes;

    // Field yang boleh diisi
    protected $fillable = [
        'w_id',
        'w_nama_kabupaten_atau_kota',
        'w_created_at',
        'w_updated_at',
        'w_deleted_at',
    ];
}
