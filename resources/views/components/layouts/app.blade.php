<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="VZF6MdOYUr8GTzcXejYEPC4tsba-C2FCbNLy0WKPQgE" />
    <meta name="description" content="@yield('meta_description', config('app.name'))">

    {{-- <title>{{ $title ?? config('app.name') }}</title> --}}

    @include('partials.seo-meta', ['title' => $title ?? null])

    @vite(['resources/scss/main.scss', 'resources/js/app.js'])
    @stack('styles')
    @livewireStyles
</head>

<body class="d-flex flex-column min-vh-100">
    <livewire:components.navbar />

    <main class="flex-fill">
        {{ $slot }}
    </main>

    <livewire:components.footer />

    @stack('scripts')
    @livewireScripts
    <script>
        document.addEventListener('livewire:load', () =>
        {
            if (!window.Livewire) return;

            Livewire.hook('request', ({ fail }) =>
            {
                fail(({ status }) =>
                {
                    if (status === 403)
                    {
                        // Session expired / CSRF failed → recover cleanly
                        window.location.reload();
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('livewire:navigating', () =>
        {
            window.__filamentNavigating = true;
        });

        // window.addEventListener('beforeunload', (e) =>
        // {
        //     if (!window.__filamentNavigating)
        //     {
        //         e.preventDefault();
        //         e.returnValue = '';
        //     }
        // });
    </script>
</body>

</html>