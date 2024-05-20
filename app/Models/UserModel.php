<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'user';
    protected $primaryKey = 'user_id';

    protected $fillable = ['level_id', 'username', 'password'];

    public function persetujuan(): HasMany{
        return $this->hasMany(PersetujuanModel::class, 'user_id');
    }
}
