<x-layout title="Home">
  <h1>{{ $greeting }}</h1>
  <p>Hello {{ $name }}</p>
  @if ($ideas->count() > 0)
  <h2 class="text-2xl font-bold">Your Ideas:</h2>
  <ul>
    @foreach ($ideas as $idea)
      <li class="text-lg">{{ $idea }}</li>
    @endforeach
  </ul>
  @endif
</x-layout>
