<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Table\Actions\DeleteAction;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\PostResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PostResource\RelationManagers;
use Malzariey\FilamentLexicalEditor\FilamentLexicalEditor;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')                    
                    ->readOnly(fn (callable $get, $livewire) => $livewire->isTitleLocked)
                    ->extraInputAttributes(fn ($livewire) => $livewire->isTitleLocked ? ['style' => 'background-color:#ccc; cursor: not-allowed;'] : [])
                    ->required()->minLength(1)->maxLength(150)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(string $operation, $state, callable $set) => 
                    $operation === 'create' ? $set('slug', Str::slug($state)) : null)->columnSpanFull(),
                    
                Textarea::make('meta_description')
                        ->label('Meta Description')
                        ->helperText('Limit: max 160 characters')
                        ->maxLength(160)
                        ->rows(3)
                        ->columnSpanFull(),
                            
                Section::make('Status')->schema([
                    Toggle::make('is_published')
                        ->label('Published')
                        ->default(false),    
                    Toggle::make('is_archived')
                            ->default(false),
                    Toggle::make('is_featured')
                            ->default(false), 
                    Toggle::make('is_trending')
                            ->default(false),
                ])->columnSpanFull()->columns(4),
                
                Section::make('Metadata')->schema([
                    TextInput::make('slug')
                        ->required(),
                        // ->helperText('Auto generated from title')
                        // ->disabled()
                        // ->dehydrated(true)                   
                        // ->unique(Post::class,'slug', ignoreRecord: true),           
                    Select::make('category_id')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->relationship('category', 'name'),
                    Select::make('tag_id')
                        ->searchable()
                        ->multiple()
                        ->preload()
                        ->relationship('tags', 'name'),   
                    DateTimePicker::make('published_at')
                        ->nullable()
                        ->seconds(false),                    
                ]),
                Section::make('Images')->schema([
                    FileUpload::make('cover_image')
                        ->image() 
                        ->disablePreview()                       
                        ->disk('public_uploads')
                        ->directory('posts')                        
                        ->visibility('public')
                        ->deletable()
                        ->deleteUploadedFileUsing(fn ($file) =>
                            \Storage::disk('public')->delete($file))
                        ->nullable()
                        ->multiple(false),
                    FileUpload::make('thumb_image')
                        ->image()
                        ->disablePreview()
                        ->directory('public_uploads')
                        ->disk('public')
                        ->visibility('public')
                        ->deletable()
                        ->deleteUploadedFileUsing(fn ($file) =>
                            \Storage::disk('public')->delete($file))
                        ->nullable()
                        ->multiple(false),
                    FileUpload::make('long_image')
                        ->image()
                        ->disablePreview()
                        ->directory('public_uploads')
                        ->disk('public')
                        ->visibility('public')
                        ->deletable()
                        ->deleteUploadedFileUsing(fn ($file) =>
                            \Storage::disk('public')->delete($file))
                        ->nullable()
                        ->multiple(false),                    
                ]),

                Section::make('Content')->schema([
                    FilamentLexicalEditor::make('content')
                        ->lazy()                        
                        ->live(false)
                        ->dehydrated(true)  
                        ->extraAttributes([
                            'wire:ignore' => true,
                        ])
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->bulkActions([])
            ->columns([
                TextColumn::make('id')
                ->numeric()
                ->sortable(),
                ImageColumn::make('thumb_image')
                ->label('Thumbnail')
                ->disk('public')
                ->visibility('public')
                ->square()
                ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('title')
                    ->searchable()
                    ->wrap(),                
                IconColumn::make('is_archived')
                    ->label('Archived')
                    ->boolean(),
                IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),
                IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean(),
                TextColumn::make('comments_count')
                    ->label('Comments')
                    ->counts('comments')
                    ->sortable(),

                TextColumn::make('published_at')
                    ->date('F jS, Y')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('Comments')
                ->icon('heroicon-o-chat-bubble-bottom-center-text')
                ->color('info')
                ->url(fn($record) => self::getUrl('comments', ['record' => $record->id])),

                Tables\Actions\EditAction::make(),
                \Filament\Tables\Actions\DeleteAction::make(),                
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
            'comments' => Pages\Comments::route('/{record}/comment')            
        ];
    }    
}
