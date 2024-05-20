<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KeuanganModel extends Model
{
    use HasFactory;

    protected $table = 'keuangan';
    protected $primaryKey = 'keuangan_id';

    protected $fillable = ['penginput', 'pemasukan' , 'pengeluaran', 'pengeluaran_untuk', 'pemasukan_dari', 'tanggal'];

    public function penginput(): BelongsTo{
        return $this->belongsTo(WargaModel::class, 'nik');
    }
}
