@props([
    'idea' => null,
])

<x-modal name="{{ $idea ? 'edit-idea' : 'create-idea' }}" title="{{ $idea ? 'Edit Idea' : 'Create Idea' }}">
            <form x-data="{
                    status: @js($idea?->status?->value ?? 'pending'),
                    hasImageFile: false,
                    newLink: '',
                    links: @js($idea ? collect($idea->links ?? [])->values()->all() : []),
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
                    steps: @js(old('steps', $idea ? $idea->steps->map(fn ($step) => $step->only(['id', 'description', 'completed']))->values()->all() : [])),
                    addStep() {
                        const s = this.newStep.trim();
                        if (!s) {
                            return;
                        }
                        this.steps.push({ description: s, completed: false });
                        this.newStep = '';
                    },
                    removeImage() {
                        document.getElementById('delete-image-form')?.requestSubmit();
                    },
                }" action="{{  $idea ? route('ideas.update', $idea) : route('ideas.store') }}" method="POST"
                :enctype="hasImageFile ? 'multipart/form-data' : 'application/x-www-form-urlencoded'">
                @csrf
                
                @if ($idea)
                    @method('PATCH')
                @endif

                <div class="space-y-6">

                    <!-- Title -->
                    <x-form.field name="title" label="Title"
                        type="text" autofocus required
                        placeholder="Enter a title for your idea"
                        :value="old('title', $idea?->title ?? '')" />
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
                        placeholder="Describe your idea"
                        :value="old('description', $idea?->description ?? '')" />
                    <x-form.error name="description" />

                    <!--- File Input --->
                    <div class="space-y-3">
                        <label for="image" class="label">Featured Image</label>

                        @if ($idea?->image_path)
                              <div class="space-y-2">
                                <img src="{{ asset('storage/' . $idea->image_path) }}" alt="{{ $idea->title }}"
                                    class="w-full h-auto object-cover h-48 rounded-lg">
                                    <button type="button" class="btn btn-outlined h-10 w-full" form="delete-image-form"
                                        @click="removeImage()">
                                        Remove Image
                                    </button>
                            </div>
                        @endif

                        <input type="file" name="image" id="image" accept="image/*" class="file-input"
                            @change="hasImageFile = $event.target.files.length > 0" />
                        <x-form.error name="image" />
                    </div>

                    <!-- Srteps -->
                    <div>
                        <fieldset class="space-y-3">
                            <legend class="label">Steps</legend>

                            <template x-for="(step, index) in steps" :key="step.id ?? 'new-' + index">
                                <div class="flex gap-x-2 items-center">
                                    <input data-test="step-item" class="input" :name="`steps[${index}][description]`"
                                        x-model="step.description">
                                    <input type="hidden" :name="`steps[${index}][completed]`" :value="step.completed ? 1 : 0">
                                    <button @click="steps.splice(steps.indexOf(step), 1)" aria-label="Remove step"
                                        type="button"
                                        class="flex items-center justify-center btn btn-outlined border-red-500 text-red-500 hover:text-red-600">
                                        remove
                                    </button>
                                </div>
                            </template>

                            <div class="space-y-2">
                                <div class="flex gap-x-2 items-center">
                                    <input x-model="newStep" id="new-step" data-test="new-step" class="input flex-1"
                                        spellcheck="false" type="text" autocomplete="text"
                                        placeholder="Enter a step description" @keydown.enter.prevent="addStep()" />

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
                    
                    <button type="submit" class="btn" data-test="create-idea-submit">{{ $idea ? 'Update' : 'Create' }}</button>
                </div>

            </form>
            @if ($idea?->image_path)
            <form id="delete-image-form" action="{{ route('idea.image.destroy', $idea) }}" method="POST">
                    @csrf
                    @method('DELETE')
                </form>
            @endif
        </x-modal>