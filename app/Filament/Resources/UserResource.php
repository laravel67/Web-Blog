<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\Builder;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(table: 'users', column: 'email', ignoreRecord: true)
                    ->maxLength(255),

                Forms\Components\TextInput::make('username')
                    ->required()
                    ->unique(table: 'users', column: 'username', ignoreRecord: true)
                    ->maxLength(255),

                Forms\Components\FileUpload::make('avatar')
                    ->image()
                    ->directory('avatars'),

                Forms\Components\Textarea::make('bio')
                    ->maxLength(500),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            // ->query(fn(Builder $query) => $query->where('id', '!=', auth()->id()))
            ->columns([
                Tables\Columns\ImageColumn::make('avatar_url')
                    ->label('Avatar')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Nama'),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->label('Email'),

                Tables\Columns\TextColumn::make('username')
                    ->searchable()
                    ->sortable()
                    ->label('Username'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),

                Tables\Actions\Action::make('verifyEmail')
                    ->label('Verifikasi Email')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn($record) => is_null($record->email_verified_at))
                    ->action(fn($record) => $record->update([
                        'email_verified_at' => now(),
                    ]))
                    ->requiresConfirmation()
                    ->successNotificationTitle('Email berhasil diverifikasi.'),

                Tables\Actions\Action::make('changeRole')
                    ->label('Ganti Role')
                    ->icon('heroicon-o-user-circle')
                    ->color('warning')
                    ->form([
                        Forms\Components\Select::make('role')
                            ->label('Pilih Role Baru')
                            ->options(\Spatie\Permission\Models\Role::pluck('name', 'name')->toArray())
                            ->required(),
                    ])
                    ->action(function ($record, array $data) {
                        $record->syncRoles([$data['role']]); // replace role lama
                    })
                    ->modalHeading('Ganti Role User')
                    ->modalButton('Simpan Perubahan')
                    ->successNotificationTitle('Role berhasil diperbarui!'),
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            // 'create' => Pages\CreateUser::route('/create'),
            // 'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
