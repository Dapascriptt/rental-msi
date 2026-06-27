<?php

use Illuminate\Support\Facades\Broadcast;         // class untuk broadcasting (realtime)

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| File ini untuk fitur "broadcasting" (notifikasi realtime, misal chat).
| Di sini diatur SIAPA yang boleh mendengarkan channel tertentu.
| Project ini belum memakai fitur ini secara aktif.
|
*/

// Aturan channel privat milik tiap user: hanya boleh didengarkan oleh
// user yang id-nya cocok dengan id di nama channel.
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;         // true = user ini boleh mendengarkan
});
