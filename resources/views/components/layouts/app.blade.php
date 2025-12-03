<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        

        {{-- <title>{{ $title ?? config('app.name') }}</title>  --}}

        @include('partials.seo-meta', ['title' => $title ?? null])

        @vite(['resources/scss/main.scss', 'resources/js/app.js'])
        @stack('styles')
        @livewireStyles
    </head>
    <body>
        <livewire:components.navbar/>
        
        <main>
            {{ $slot }}
        </main>
        
        <livewire:components.footer/>

        @stack('scripts')
        @livewireScripts        
    </body>
</html>
