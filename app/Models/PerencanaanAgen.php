<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PerencanaanAgen extends Model
{
    protected $table = 'tb_perencanaan_agen';
    protected $primaryKey = 'pa_id';
    public $timestamps = false;

    protected $fillable = [
        'pa_kondisi',
        'pklan_id',
        'w_id',
        'pa_jumlah',
        'pa_tgl_awal',
        'pa_tgl_akhir',
    ];

    protected $appends = ['tanggal']; // atribut tambahan

    public function pangkalan()
    {
        return $this->belongsTo(Pangkalan::class, 'pklan_id', 'pklan_id');
    }

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'w_id', 'w_id');
    }

    // Accessor: bikin properti "tanggal"
    public function getTanggalAttribute()
    {
        $dataTanggal = array_fill(1, 31, 0);

        if ($this->pa_tgl_awal && $this->pa_tgl_akhir) {
            $awal  = Carbon::parse($this->pa_tgl_awal)->day;
            $akhir = Carbon::parse($this->pa_tgl_akhir)->day;

            for ($i = $awal; $i <= $akhir; $i++) {
                $dataTanggal[$i]++;
            }
        }

        return $dataTanggal;
    }
}
