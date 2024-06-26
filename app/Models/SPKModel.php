<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SPKModel extends Model
{
    use HasFactory;

    protected $table = 'spk';
    protected $primaryKey = 'spk_id';

    protected $fillable = ['kepemilikan_id', 'skor_mabac','peringkat_mabac','skor_topsis', 'peringkat_topsis'];

    

    public function kepemilikan(): BelongsTo{
        return $this->belongsTo(KepemilikanModel::class, 'kepemilikan_id');
    }

}
