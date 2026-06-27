<?php

namespace Database\Factories;                     // alamat class factory

use Illuminate\Database\Eloquent\Factories\Factory; // class dasar factory
use Illuminate\Support\Facades\Hash;              // untuk mengenkripsi (hash) password
use Illuminate\Support\Str;                       // helper olah teks

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;            // menyimpan password agar tidak di-hash berulang (hemat waktu)

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array            // mendefinisikan bentuk data palsu default
    {
        return [
            'name' => fake()->name(),                          // nama acak
            'email' => fake()->unique()->safeEmail(),          // email acak yang unik
            'email_verified_at' => now(),                      // tanggal verifikasi = sekarang
            'password' => static::$password ??= Hash::make('password'), // password "password" yang di-hash (?? = isi jika belum ada)
            'remember_token' => Str::random(10),               // token acak 10 karakter
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static           // "state" tambahan: membuat user yang BELUM verifikasi email
    {
        return $this->state(fn (array $attributes) => [ // ubah sebagian atribut...
            'email_verified_at' => null,                // ...jadikan tanggal verifikasi kosong
        ]);
    }
}
