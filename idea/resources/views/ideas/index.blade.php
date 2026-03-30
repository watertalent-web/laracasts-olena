<x-layout>
    <div class="">
        <header class="py-8 md:py-12">
            <h1 class="text-3xl font-bold">Ideas</h1>
            <p class="text-muted-foreground text-sm mt-2">Capture your thoughts. Make a plan.</p>

            <x-card is-button class="mt-10 cursor-pointer h-32 w-full text-left" x-data
                x-on:click="$dispatch('open-modal', 'create-idea')" data-test="create-idea-button">
                <p>What's on your mind?</p>
            </x-card>
        </header>

        <div>
            <a class="btn {{ request()->has('status') ? 'btn-outlined' : ' btn-primary' }}" href="/ideas">
                All <span class="text-xs">{{ $statusCounts->get('all') }}</span>
            </a>

            @foreach (App\IdeaStatus::cases() as $status)
                <a class="btn{{ request('status') === $status->value ? ' btn-primary' : ' btn-outlined' }}"
                    href="/ideas?status={{ $status->value }}">
                    {{ $status->label() }} <span class="text-xs">{{ $statusCounts->get($status->value) }}</span>
                </a>
            @endforeach
        </div>

        <div class="mt-10 text-muted-foreground">
            <div class="grid md:grid-cols-2 gap-6">
                @forelse ($ideas as $idea)
                    <x-card href="/ideas/{{ $idea->id }}">
                        @if ($idea->image_path)
                            <div class="rounded-lg overflow-hidden w-full aspect-video mb-4">
                                <img src="{{ asset('storage/' . $idea->image_path) }}" alt="{{ $idea->title }}"
                                    class="w-full h-auto object-cover">
                            </div>
                        @endif
                        <h3 class="text-foreground text-lg">{{ $idea->title }}</h3>
                        <x-idea.status :status="$idea->status->value">{{  $idea->status->label()  }}</x-idea.status>
                        <div class="mt-5 line-clamp-3">{{ $idea->description }}</div>
                        <div class="mt-4">{{ $idea->created_at->diffForHumans() }}</div>
                    </x-card>
                @empty
                    <x-card>No ideas found</x-card>
                @endforelse
            </div>
        </div>

        <x-idea.modal />
    </div>
</x-layout>