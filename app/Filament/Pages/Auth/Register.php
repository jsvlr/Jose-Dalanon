<?php

namespace App\Filament\Pages\Auth;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Auth\Http\Responses\Contracts\RegistrationResponse;
use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Override;

class Register extends BaseRegister
{
    #[Override]
    public function register(): ?RegistrationResponse
    {
        try {
            $this->rateLimit(2);
        } catch (TooManyRequestsException $e) {
            $this->getRateLimitedNotification($e)?->send();
            return null;
        }

        $user = $this->wrapInDatabaseTransaction(function () {
            $this->callHook('beforeValidate');
            $data = $this->form->getState();
            $this->callHook('afterValidate');

            $data = $this->mutateFormDataBeforeRegister($data);

            $this->callHook('beforeRegister');
            $user = $this->handleRegistration($data);
            $this->form->model($user)->saveRelationships();
            $this->callHook('afterRegister');

            return $user;

        });

        $this->sendEmailVerificationNotification($user);

        Notification::make()
            ->title('Verification email sent')
            ->body('Please check your gmail inbox and click the link to verify your account.')
            ->success()
            ->persistent()
            ->send();

        $this->redirect(Filament::getLoginUrl());

        return null;
    }
}
