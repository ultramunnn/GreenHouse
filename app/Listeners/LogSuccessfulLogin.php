<?php

namespace App\Listeners;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\LogAktivitas;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     */

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
         // Ambil user yang login
        $user = $event->user;

        // Simpan ke tabel log_aktivitas
        LogAktivitas::create([
            'nama_aktivitas' => 'Login oleh ' . ($user->name ?? $user->email ?? 'User'),
            'ip_address' => $this->request->ip(),
        ]);
    }
}
