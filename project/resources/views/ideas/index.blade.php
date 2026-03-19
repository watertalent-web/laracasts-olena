<x-layout title="Home page">
        @if ($ideas->count() > 0)
        <div class="px-6 py-24 sm:py-32 lg:px-8">
            <h2 class="sm:text-5xl">Your Ideas:</h2>
            <ul class="mt-6 grid grid-cols-2 gap-6">
                @foreach ($ideas as $idea)
                <x-card :idea="$idea" />
                @endforeach
            </ul>
        </div>
        @else
         <div class="px-6 py-24 sm:py-32 lg:px-8">
            <h2 class="text-4xl font-semibold tracking-tight text-balance text-gray-900 sm:text-5xl">No ideas found</h2>
        </div>
        @endif
        <div class="justify-end card-actions">
            <a href="/ideas/create" class="btn btn-secondary">Create new Idea</a>
        </div>
</x-layout>