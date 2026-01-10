<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Pages\Page;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;

class AuthorProfile extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Author Profile';
    protected static ?string $title = 'Author Profile';
    protected static ?string $navigationGroup = 'Settings';

    public ?array $data = [];

    protected static string $view = 'filament.pages.author-profile';

    public function mount(): void
    {
        $this->form->fill($this->loadProfileData());
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Author Information')
                ->schema([
                    FileUpload::make('avatar')
                        ->label('Profile Image')
                        ->image()
                        ->disk('public_uploads')
                        ->deletable()
                        ->previewable(false)                        
                        ->directory('author-profile')
                        ->maxSize(2048)
                        ->columnSpanFull(),

                    TextInput::make('name')
                        ->label('Author Name')
                        ->required()
                        ->maxLength(50),

                    Textarea::make('bio')
                        ->label('Short Bio')
                        ->rows(4)
                        ->maxLength(1000)
                        ->columnSpanFull(),
                ]),

            Section::make('Social Links')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('twitter')->label('Twitter URL')->url(),
                        Toggle::make('show_twitter')->label('Show Twitter'),
                    ]),
                    Grid::make(2)->schema([
                        TextInput::make('instagram')->label('Instagram URL')->url(),
                        Toggle::make('show_instagram')->label('Show Instagram'),
                    ]),
                    Grid::make(2)->schema([
                        TextInput::make('facebook')->label('Facebook URL')->url(),
                        Toggle::make('show_facebook')->label('Show Facebook'),
                    ]),
                    Grid::make(2)->schema([
                        TextInput::make('pinterest')->label('Pinterest URL')->url(),
                        Toggle::make('show_pinterest')->label('Show Pinterest'),
                    ]),
                ]),
        ];
    }

    protected function getFormStatePath(): string
    {
        return 'data';
    }

    public function save(): void
    {
        $data = $this->form->getState();
        Storage::disk('public_uploads')->put('author_profile.json', json_encode($data, JSON_PRETTY_PRINT));

        Notification::make()
            ->title('Author profile updated successfully!')
            ->success()
            ->send();
    }

    protected function loadProfileData(): array
    {
        if (!Storage::disk('public_uploads')->exists('author_profile.json')) {
            return [];
        }

        return json_decode(Storage::disk('public_uploads')->get('author_profile.json'), true) ?? [];
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('save')
                ->label('Save Changes')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->action(fn () => $this->save()),
        ];
    }
}
