<?php

namespace App\Filament\Resources;

use App\Models\Post;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use App\Filament\Resources\PostResource\Pages;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Illuminate\Support\Facades\Auth;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    FileUpload::make('image')
                        ->label('Thumbnail')
                        ->image()
                        ->directory('posts')
                        ->columnSpan(1),

                    Grid::make(2)->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->placeholder('Masukkan Judul')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->reactive()
                            ->debounce(500)
                            ->afterStateUpdated(function ($get, $set, ?string $state) {
                                if (!$get('is_slug_changed_manually') && filled($state)) {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        Hidden::make('slug')
                            ->default(fn($get) => Str::slug($get('title')))
                            ->required(),

                        Hidden::make('user_id')
                            ->default(fn() => Auth::id())
                            ->required(),
                        Select::make('category_id')
                            ->label('Kategori')
                            ->relationship('category', 'name')
                            ->required(),
                    ]),


                    RichEditor::make('content')
                        ->label('Isi Berita')
                        ->required()
                        ->placeholder('Tulis isi berita')
                        ->columnSpanFull(),
                ])
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label('Judul'),

                Tables\Columns\TextColumn::make('category.name')
                    ->searchable()
                    ->label('Kategori'),
                Tables\Columns\TextColumn::make('author.name')
                    ->searchable()
                    ->label('Author'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
