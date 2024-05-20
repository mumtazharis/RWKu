<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DokumentasiModel extends Model
{
    use HasFactory;

    protected $table = 'dokumentasi';
    protected $primaryKey = 'dokumentasi_id';

    protected $fillable = ['kegiatan_id', 'path', 'tanggal'];

    public function kegiatan(): BelongsTo{
        return $this->belongsTo(KegiatanModel::class, 'kegiatan_id');
    }
}
