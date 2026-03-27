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

        <x-modal name="create-idea" title="Create Idea">
            <form x-data="{
                    status: 'pending',
                    hasImageFile: false,
                    newLink: '',
                    links: [],
                    isValidUrl(str) {
                        const s = (str || '').trim();
                        if (!s) {
                            return false;
                        }
                        try {
                            const u = new URL(s);
                            return u.protocol === 'http:' || u.protocol === 'https:';
                        } catch (e) {
                            return false;
                        }
                    },
                    addLink() {
                        const s = this.newLink.trim();
                        if (!this.isValidUrl(s)) {
                            return;
                        }
                        this.links.push(s);
                        this.newLink = '';
                    },
                    newStep: '',
                    steps: [],
                    addStep() {
                        const s = this.newStep.trim();
                        if (!s) {
                            return;
                        }
                        this.steps.push(s);
                        this.newStep = '';
                    },
                }" action="{{ route('ideas.store') }}" method="POST"
                :enctype="hasImageFile ? 'multipart/form-data' : 'application/x-www-form-urlencoded'">
                @csrf
                <div class="space-y-6">

                    <!-- Title -->
                    <x-form.field name="title" label="Title" type="text" autofocus required
                        placeholder="Enter a title for your idea" />
                    <x-form.error name="title" />

                    <!-- Status -->
                    <div>
                        <label for="status" class="label mb-2">Status</label>
                        <div class="flex gap-x-3">
                            @foreach (App\IdeaStatus::cases() as $status)
                                <button @click="status = @js($status->value)" type="button" class="btn flex-1 h-10"
                                    data-test="button-status-{{ $status->value }}"
                                    :class="status === @js($status->value) ? '' : 'btn-outlined'">
                                    {{ $status->label() }}
                                </button>
                            @endforeach

                            <x-form.error name="status" />

                            <input type="text" name="status" :value="status" hidden>
                        </div>
                    </div>

                    <!-- Description -->
                    <x-form.field name="description" label="Description" type="textarea"
                        placeholder="Describe your idea" />
                    <x-form.error name="description" />

                    <!--- File Input --->
                    <div class="space-y-3">
                        <label for="image" class="label">Featured Image</label>
                        <input type="file" name="image" id="image" accept="image/*" class="file-input"
                            @change="hasImageFile = $event.target.files.length > 0" />
                        <x-form.error name="image" />
                    </div>

                    <!-- Srteps -->
                    <div>
                        <fieldset class="space-y-3">
                            <legend class="label">Steps</legend>

                            <template x-for="step in steps" :key="step">
                                <div class="flex gap-x-2 items-center">
                                    <input data-test="new-step" class="input" name="steps[]" :value="step"
                                        x-model="step">
                                    <button @click="steps.splice(steps.indexOf(step), 1)" aria-label="Remove step"
                                        type="button"
                                        class="flex items-center justify-center btn btn-outlined border-red-500 text-red-500 hover:text-red-600">
                                        remove
                                    </button>
                                </div>
                            </template>

                            <div class="space-y-2">
                                <div class="flex gap-x-2 items-center">
                                    <input x-model="newStep" id="new-step" class="input flex-1" spellcheck="false"
                                        type="text" autocomplete="text" placeholder="Enter a step description"
                                        @keydown.enter.prevent="addLink()" />

                                    <button data-test="submit-new-step-button" type="button" class="btn btn-outlined"
                                        @click="addStep()" aria-label="Add step">
                                        +
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <!-- Links -->
                    <div>
                        <fieldset class="space-y-3">
                            <legend class="label">Links</legend>

                            <template x-for="link in links" :key="link">
                                <div class="flex gap-x-2 items-center">
                                    <input data-test="link-item" class="input" name="links[]" :value="link"
                                        x-model="link">
                                    <button @click="links.splice(links.indexOf(link), 1)" aria-label="Remove link"
                                        type="button"
                                        class="flex items-center justify-center btn btn-outlined border-red-500 text-red-500 hover:text-red-600">
                                        remove
                                    </button>
                                </div>
                            </template>

                            <div class="space-y-2">
                                <div class="flex gap-x-2 items-center">
                                    <input x-model="newLink" id="new-link" data-test="new-link" class="input flex-1"
                                        spellcheck="false" type="url" autocomplete="url"
                                        placeholder="https://example.com" @keydown.enter.prevent="addLink()" />

                                    <button data-test="submit-new-link-button" type="button" class="btn btn-outlined"
                                        @click="addLink()" :disabled="!isValidUrl(newLink)" aria-label="Add link">
                                        +
                                    </button>
                                </div>
                                <p x-show="newLink.trim() && !isValidUrl(newLink)" x-cloak class="text-sm text-red-500">
                                    Enter a full URL starting with https:// or http://
                                </p>
                            </div>
                        </fieldset>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-x-3 mt-5">
                    <button type="button" @click="$dispatch('close-modal')" class="btn btn-outlined">Cancel</button>
                    <button type="submit" class="btn" data-test="create-idea-submit">Create</button>
                </div>

            </form>
        </x-modal>
    </div>
</x-layout>