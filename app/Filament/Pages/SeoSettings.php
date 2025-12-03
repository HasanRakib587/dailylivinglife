<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;

class SeoSettings extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Settings';

        public ?array $data = [];

    public function mount(): void
    {
        // Load saved data from storage
        $this->form->fill($this->getSettings());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                // ✅ BASIC SEO
                Section::make('Basic SEO')
                        ->description('General meta tags for search engines.')
                        ->schema([
                        TextInput::make('title')->label('Default Title')->maxLength(70),
                        Forms\Components\Textarea::make('description')->label('Meta Description')->rows(2)->maxLength(160),
                        TextInput::make('canonical_url')->label('Canonical URL'),
                        TextInput::make('author')->label('Author Name'),
                        TextInput::make('language')->label('Language Code')->default('en'),
                        TextInput::make('theme_color')->label('Theme Color')->placeholder('#ffffff'),
                    ]),

                // ✅ OPEN GRAPH
                Section::make('Open Graph (Facebook, LinkedIn)')
                        ->schema([
                        TextInput::make('og:title')->label('OG Title'),
                        Textarea::make('og:description')->label('OG Description')->rows(2),
                        TextInput::make('og:image')->label('OG Image URL'),
                        TextInput::make('og:url')->label('OG URL'),
                        Select::make('og:type')
                            ->label('OG Type')
                            ->options(['website' => 'Website', 'article' => 'Article', 'profile' => 'Profile'])
                            ->default('website'),
                        TextInput::make('og:site_name')->label('Site Name'),
                        TextInput::make('article:author')->label('Article Author URL'),
                    ]),

                // ✅ TWITTER
                Section::make('Twitter Cards')
                        ->schema([
                        Select::make('twitter:card')
                            ->label('Card Type')
                            ->options([
                                'summary' => 'Summary',
                                'summary_large_image' => 'Summary with Large Image',
                            ])
                            ->default('summary_large_image'),
                        TextInput::make('twitter:site')->label('Twitter @username (Site)'),
                        TextInput::make('twitter:creator')->label('Twitter @username (Creator)'),
                        TextInput::make('twitter:title')->label('Twitter Title'),
                        Forms\Components\Textarea::make('twitter:description')->label('Twitter Description')->rows(2),
                        TextInput::make('twitter:image')->label('Twitter Image URL'),
                    ]),
                
                // ✅ GOOGLE + SITEMAP
                Section::make('Google Search Console & Sitemap')
                        ->description('Settings for Google indexing and verification.')
                        ->schema([
                        TextInput::make('google_verification')
                            ->label('Google Site Verification Code')
                            ->helperText('Paste the code from Google Search Console (example: google123abc456def.html).'),

                        FileUpload::make('sitemap')
                            ->label('Upload Sitemap XML')
                            ->directory('public')
                            ->acceptedFileTypes(['application/xml', 'text/xml'])
                            ->helperText('Upload your sitemap.xml file for Google indexing.'),
                    ]),
            ])
            ->statePath('data');            
    }

    public function save(): void
    {
        $state = $this->form->getState();

        // Store sitemap filename (if uploaded)
        if (isset($state['sitemap']) && is_array($state['sitemap'])) {
            $state['sitemap'] = $state['sitemap'][0] ?? null;
        }

        Storage::disk('local')->put('seo-settings.json', json_encode($state, JSON_PRETTY_PRINT));

        Notification::make()
            ->title('SEO settings saved successfully!')
            ->success()
            ->send();
    }

    protected function getSettings(): array
    {
        $path = 'seo-settings.json';
        return Storage::disk('local')->exists($path)
            ? json_decode(Storage::disk('local')->get($path), true)
            : [];
    }

    protected static string $view = 'filament.pages.seo-settings';
}
