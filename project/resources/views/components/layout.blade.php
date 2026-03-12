@props(['title' => 'Laravel'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ $title }}</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <style>
    nav {
      display: flex;
      gap: 1rem;
    }
    nav a {
      text-decoration: none;
      color: blue;
    }
  </style>
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
  <nav>
    <a href="/">Home</a>
    <a href="/about">About</a>
    <a href="/contact">Contact</a>
  </nav>
  {{$slot}}
</body>

</html>