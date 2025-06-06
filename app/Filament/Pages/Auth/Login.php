<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Form;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Filament\Http\Responses\Auth\LoginResponse as FilamentLoginResponse;

class Login extends BaseLogin
{
    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            Notification::make()
                ->title(__('filament-panels::pages/auth/login.notifications.throttled.title', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]))
                ->body(__('filament-panels::pages/auth/login.notifications.throttled.body', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]))
                ->danger()
                ->send();

            return null;
        }

        $data = $this->form->getState();

        $credentials = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];

        if (! Auth::attempt($credentials, $data['remember'] ?? false)) {
            throw ValidationException::withMessages([
                'data.email' => __('filament-panels::pages/auth/login.messages.failed'),
            ]);
        }

        $user = Auth::user();
        
        // Check if user is approved
        if (!$user->isApproved()) {
            Auth::logout();
            
            Notification::make()
                ->title('Account Pending Approval')
                ->body('Your account is pending approval from an administrator.')
                ->warning()
                ->send();
                
            return null;
        }

        session()->regenerate();

        // Redirect based on user role
        if ($user->isAdmin()) {
            return app(FilamentLoginResponse::class)->setIntendedUrl(route('filament.admin.pages.dashboard'));
        }

        return app(FilamentLoginResponse::class)->setIntendedUrl(route('filament.user.pages.dashboard'));
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ])
            ->statePath('data');
    }

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label(__('filament-panels::pages/auth/login.form.email.label'))
            ->email()
            ->required()
            ->autocomplete()
            ->autofocus();
    }

    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label(__('filament-panels::pages/auth/login.form.password.label'))
            ->password()
            ->required();
    }

    protected function getRememberFormComponent(): Component
    {
        return Checkbox::make('remember')
            ->label(__('filament-panels::pages/auth/login.form.remember.label'));
    }

    public function getTitle(): string | Htmlable
    {
        return 'Login to GreenHouse';
    }

    public function getHeading(): string | Htmlable
    {
        return 'Welcome Back';
    }
} 