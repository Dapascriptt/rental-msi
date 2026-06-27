<?php

namespace App\Http\Middleware;                  // alamat class

use Illuminate\Http\Middleware\TrustHosts as Middleware; // bawaan Laravel

// Menentukan host/domain mana yang dipercaya oleh aplikasi.
// Berguna untuk mencegah serangan "host header spoofing".
class TrustHosts extends Middleware
{
    /**
     * Get the host patterns that should be trusted.
     *
     * @return array<int, string|null>
     */
    public function hosts(): array              // daftar pola host yang dipercaya
    {
        return [
            $this->allSubdomainsOfApplicationUrl(), // izinkan semua subdomain dari APP_URL (di .env)
        ];
    }
}
