@props(['title' => 'Laravel'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="cyberpunk">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>{{ $title }}</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
<x-layouts.nav />
<div class="max-w-3xl mx-auto">  
{{$slot}}
</div>
</body>

</html>