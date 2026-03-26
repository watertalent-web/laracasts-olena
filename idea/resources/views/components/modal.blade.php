@props(['name', 'title'])

<div x-data="{show: false, name: '{{ $name }}'}" x-show="show"
    @open-modal.window="$event.detail === name ? show = true : show = false" 
    @close-modal.window="show = false"
    @keydown.escape.window="show = false"
    class="fixed inset-0 bg-black bg-black/80 flex items-center justify-center backdrop-blur-xs z-50"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" style="display: none;"
    aria-modal="true" aria-labelledby="modal-{{$name}}-title" :aria-hidden="!show" tabindex="-1">
    <x-card @click.away="show = false" class="p-6 shados-xl max-w-2xl w-full max-h-[80dvh] overflow-y-auto">

        <div class="flex justify-between items-center">
            <h2 id="modal-{{$name}}-title" class="text-xl font-bold">{{ $title }}</h2>
            <button @click="show = false" type="button" class="text-muted-foreground hover:text-foreground"
                aria-label="Close Modal">
                X
            </button>
        </div>

        <div class="mt-4">
            {{ $slot }}
        </div>
    </x-card>
</div>