<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Register as BaseRegister;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;
use Filament\Notifications\Notification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Support\Htmlable;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Hash;
use Filament\Actions\Action;

/**
 * Halaman Registrasi
 * Menampilkan form registrasi untuk pengguna baru
 * Menyediakan fitur rate limiting dan validasi
 */

class Register extends BaseRegister
{
    use WithRateLimiting;

    protected static string $view = 'filament.pages.auth.register';

    public function mount(): void
    {
        if (Filament::auth()->check()) {
            redirect()->intended(Filament::getUrl());
        }

        $this->form->fill();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('Kembali')
                ->url('/')
                ->icon('heroicon-m-arrow-left'),
        ];
    }

    public function register(): ?RegistrationResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            Notification::make()
                ->title('Terlalu banyak percobaan')
                ->body('Silakan tunggu beberapa saat sebelum mencoba lagi.')
                ->danger()
                ->send();

            return null;
        }

        $data = $this->form->getState();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
            'is_approved' => false,
        ]);

        event(new Registered($user));

        Notification::make()
            ->title('Registrasi Berhasil')
            ->body('Akun Anda telah dibuat dan menunggu persetujuan dari administrator.')
            ->success()
            ->send();

        return app(RegistrationResponse::class);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }

    protected function getNameFormComponent(): Component
    {
        return TextInput::make('name')
            ->label('Nama')
            ->required()
            ->maxLength(255)
            ->autofocus();
    }

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label('Email')
            ->email()
            ->required()
            ->maxLength(255)
            ->unique(table: User::class);
    }

    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label('Password')
            ->password()
            ->required()
            ->minLength(8)
            ->same('passwordConfirmation')
            ->validationAttribute('password');
    }

    protected function getPasswordConfirmationFormComponent(): Component
    {
        return TextInput::make('passwordConfirmation')
            ->label('Konfirmasi Password')
            ->password()
            ->required()
            ->minLength(8)
            ->dehydrated(false);
    }

    public function getTitle(): string | Htmlable
    {
        return 'Daftar ke GreenHouse';
    }

    public function getHeading(): string | Htmlable
    {
        return 'Buat Akun';
    }
} 