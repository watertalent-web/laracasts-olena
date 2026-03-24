<x-layout>
    <div class="flex flex-1 flex-col items-center justify-center px-4 py-8 min-h-0 w-full">
        <div class="w-full max-w-md">
            <div class="text-center">
                <h1 class="text-2xl font-bold tracking-tight">{{ $title }}</h1>
                <p class="text-muted-foreground">{{ $description }}</p>
            </div>
         {{$slot}}
        </div>
    </div>
</x-layout>