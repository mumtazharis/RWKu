<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KegiatanModel extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';
    protected $primaryKey = 'kegiatan_id';

    protected $fillable = ['kegiatan_nama', 'kegiatan_deskripsi','kegiatan_lokasi', 'kegiatan_tanggal','kegiatan_waktu', 'foto', 'total_biaya'];

    public function dokumentasi(): HasMany{
        return $this->hasMany(DokumentasiModel::class, 'kegiatan_id');
    }

    public function iuran(): HasMany{
        return $this->hasMany(IuranModel::class, 'kegiatan_id');
    }
}
