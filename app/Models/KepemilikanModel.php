<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KepemilikanModel extends Model
{
    use HasFactory;

    protected $table = 'kepemilikan';
    protected $primaryKey = 'kepemilikan_id';

    protected $fillable = ['nik', 'penghasilan', 'keluarga_ditanggung', 'pajak_motor', 'pajak_mobil', 'pajak_bumi_bangunan', 'tagihan_air', 'tagihan_listrik', 'hutang'];

    public function warga(): BelongsTo{
        return $this->belongsTo(WargaModel::class, 'nik');
    }
}
