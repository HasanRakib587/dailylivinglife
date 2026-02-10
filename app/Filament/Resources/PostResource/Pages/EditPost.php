<?php

namespace App\Filament\Resources\PostResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Storage;
use App\Filament\Resources\PostResource;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\LexicalEditor;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;
        public bool $isTitleLocked = true;

        protected function getHeaderActions(): array{
        return [
            // Unlock action: visible only when locked, requires confirmation
            Action::make('unlockTitle')
                ->label('Unlock Title')
                ->icon('heroicon-m-lock-open')
                ->color('danger')
                ->requiresConfirmation() // always shows confirmation for unlock
                ->modalHeading('Unlock Title Field')
                ->modalSubheading('Are you sure you want to unlock the title field for editing?')
                ->modalButton('Yes, Unlock')
                ->hidden(fn () => ! $this->isTitleLocked) // hide when already unlocked
                ->action(function () {
                    $this->isTitleLocked = false;

                    Notification::make()
                        ->title('Title field unlocked.')
                        ->success()
                        ->send();
                }),

            // Lock action: visible only when unlocked, no confirmation
            Action::make('lockTitle')
                ->label('Lock Title')
                ->icon('heroicon-m-lock-closed')
                ->color('primary')
                ->hidden(fn () => $this->isTitleLocked) // hide when still locked
                ->action(function () {
                    $this->isTitleLocked = true;

                    Notification::make()
                        ->title('Title field locked.')
                        ->success()
                        ->send();
                }),
        ];
    }

    /**
     * Automatically relock after saving
     */
    protected function afterSave(): void
    {
        $this->isTitleLocked = true;

        Notification::make()
            ->title('Title field has been relocked after saving.')
            ->info()
            ->send();
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Optional: you can lock it again when page loads
        $this->isTitleLocked = true;

        return $data;
    }

    // Optional: pack entire form state into one array (for huge forms)
    public function getFormStatePath(): ?string
    {
        return 'data';
    }

        // Explicitly define the form schema for Edit page
    protected function getFormSchema(): array
    {
        return [
            TextInput::make('title')
                ->disabled(fn () => $this->isTitleLocked)
                ->required()
                ->maxLength(255),
        ];
    }

    protected function getFooterScripts(): array{
        return [
            <<<JS
            document.addEventListener('keydown', function (e) {
                if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 's') {
                    e.preventDefault();

                    if (window.Livewire?.find(document.querySelector('[wire\\\\:id]')?.getAttribute('wire:id'))) {
                        Livewire.dispatch('save');
                    }
                }
            });
            JS,
        ];
    }

    protected function getFooterScripts(): array{
        return [
            <<<JS
            document.addEventListener('keydown', function (e) {
                if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 's') {
                    e.preventDefault();

                    if (window.Livewire?.find(document.querySelector('[wire\\\\:id]')?.getAttribute('wire:id'))) {
                        Livewire.dispatch('save');
                    }
                }
            });
            JS,
        ];
    }
}
