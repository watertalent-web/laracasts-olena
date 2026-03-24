<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/idea-logo.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('images/idea-logo.svg') }}">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-background text-foreground min-h-dvh flex flex-col">
    <x-layout.nav />
    <main class="flex flex-1 flex-col min-h-0 w-full max-w-7xl mx-auto bg-background px-4 sm:px-6 lg:px-8">
        {{$slot}}
    </main>

    @session('success')
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            x-transition.opacity.duration.300ms class="bg-primary px-4 py-3 absolute bottom-4 right-4 rounded-lg">
            {{ $value }}
        </div>
    @endsession
</body>

</html>