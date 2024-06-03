<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class CheckNomorKKNull implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Periksa apakah 'nomor_kk' bernilai null di tabel 'warga' untuk NIK yang diberikan
        $nomorKk = DB::table('warga')->where('nik', $value)->value('nomor_kk');

        if ($nomorKk !== null) {
            $fail('Anggota keluarga ini sudah terdapat di keluarga lain.');
        }
    }
}
