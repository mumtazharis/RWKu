<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PesertaModel extends Model
{
    use HasFactory;

    protected $table = 'peserta';
    protected $primaryKey = 'peserta_id';

    protected $fillable = ['kegiatan_id', 'nik'];

    public function kegiatan(): BelongsTo{
        return $this->belongsTo(KegiatanModel::class, 'kegiatan_id');
    }

    public function warga(): BelongsTo{
        return $this->belongsTo(WargaModel::class, 'nik');
    }
}
