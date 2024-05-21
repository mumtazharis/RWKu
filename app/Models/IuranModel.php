<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IuranModel extends Model
{
    use HasFactory;

    protected $table = 'iuran';
    protected $primaryKey = 'iuran_id';

    protected $fillable = ['kegiatan_id', 'nik', 'nominal'];

    public function kegiatan(): BelongsTo{
        return $this->belongsTo(KegiatanModel::class, 'kegiatan_id');
    }

    public function keluarga(): BelongsTo{
        return $this->belongsTo(KeluargaModel::class, 'nomor_kk');
    }
}
