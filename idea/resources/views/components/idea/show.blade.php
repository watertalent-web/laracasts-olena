<x-layout>
    <div class="py-8 max-w-4xl mx-auto w-full">
        <div class="flex justify-between mb-4">
            <a href="/ideas" class="inline-flex items-center gap-1.5 text-sm text-muted-foreground">
                <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                Back to all ideas
            </a>
            <div class="space-x-3 flex items-center">
                <div class="btn btn-outlined inline-flex items-center gap-1.5">
                    <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                    Edit Idea
                </div>
                <form method="POST" action="{{ route('ideas.destroy', $idea->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outlined border-red-500 text-red-500">Delete Idea</button>
                </form>
            </div>
        </div>


        <div class="mt-8 space-y-6">
            <h1 class="font-bold text-4xl">{{ $idea->title }}</h1>

            <div class="mt-2 flex gap-x-3 items-center justify-between">
                <x-idea.status :status="$idea->status->value">{{  $idea->status->label()  }}</x-idea.status>
                <div class="text-muted-foreground text-sm">{{ $idea->created_at->diffForHumans() }}</div>
            </div>

            <x-card class="mt-6">

                <div class="text-foreground prose prose-invert max-w-none cursor-pointer">
                    {{ $idea->description }}
                </div>

            </x-card>

            @if ($idea->steps->count() > 0)

                <div class="mt-6 space-y-2">
                    <h3 class="text-lg font-bold  mb-4">Actionable Steps</h3>
                    @foreach ($idea->steps as $step)
                        <x-card>
                            <form method="POST" action="{{ route('steps.update', $step) }}">
                                @csrf
                                @method('PATCH')

                                <div class="flex gap-x-3 items-center">
                                    <button
                                        class="size-5 flex items-center justify-center rounded-lg text-primary-foreground {{ $step->completed ? 'bg-primary' : 'border border-primary'}}"
                                        type="submit" role="checkbox">
                                        &check;
                                    </button>
                                    <span class="{{ $step->completed ? 'line-through text-muted-foreground' : '' }}">{{ $step->description }}</span>
                                </div>
                            </form>
                        </x-card>
                    @endforeach
                </div>
            @endif


            @if ($idea->links->count() > 0)

                <div class="mt-6 space-y-2">
                    <h3 class="text-lg font-bold  mb-4">Links</h3>
                    @foreach ($idea->links as $link)
                        <x-card href="{{ $link }}" class="text-primary font-medium flex gap-x-3 items-center">
                            {{ $link }}
                        </x-card>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</x-layout>