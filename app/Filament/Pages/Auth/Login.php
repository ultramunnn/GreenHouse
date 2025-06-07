<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Login extends BaseLogin
{
    use WithRateLimiting;

    protected static string $view = 'filament.pages.auth.login';

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
                ->label('Back to Home')
                ->url('/')
                ->color('gray')
                ->icon('heroicon-m-arrow-left')
                ->size('sm')
                ->outlined(),
        ];
    }

    public function authenticate(): ?LoginResponse
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

        if (!Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ])) {
            throw ValidationException::withMessages([
                'data.email' => 'Email atau password salah',
            ]);
        }

        $user = Auth::user();
        
        if (!$user->isApproved() && !$user->isAdmin()) {
            Auth::logout();
            
            Notification::make()
                ->title('Akun Belum Disetujui')
                ->body('Akun Anda sedang menunggu persetujuan dari administrator.')
                ->warning()
                ->send();
                
            return null;
        }

        session()->regenerate();

        return app(LoginResponse::class);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
            ])
            ->statePath('data');
    }

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label('Email')
            ->email()
            ->required()
            ->maxLength(255)
            ->autofocus();
    }

    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label('Password')
            ->password()
            ->required();
    }

    public function getTitle(): string | Htmlable
    {
        return 'Login ke GreenHouse';
    }

    public function getHeading(): string | Htmlable
    {
        return 'Login';
    }
} 