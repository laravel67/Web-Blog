<?php

namespace App\Filament\Pages\Auth;

use Illuminate\Validation\Rule;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Register as BaseRegister;

class Register extends BaseRegister
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    // protected static string $view = 'filament.pages.auth.register';

    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()->schema([
                    $this->getNameFormComponent(),
                    $this->getUsernameFormComponent(),
                    $this->getEmailFormComponent(),
                    $this->getPasswordFormComponent(),
                    $this->getPasswordConfirmationFormComponent(),
                ])->statePath('data'),
            )
        ];
    }

    protected function getUsernameFormComponent(): Component
    {
        return TextInput::make('username')
            ->label('Username')
            ->required()
            ->maxLength(10)
            ->regex('/^[a-z0-9]+$/') // Hanya huruf kecil dan angka
            ->rule(Rule::unique('users', 'username'))
            ->live()
            ->placeholder('Masukkan username (huruf kecil, tanpa spasi, max 10)');
    }
}
