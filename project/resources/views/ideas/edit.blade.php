<x-layout title="Contact">
    <div class="px-6 py-24 sm:py-32 lg:px-8">
        <form action="/ideas/{{ $idea->id }}" method="POST" class="w-full mx-auto mt-16 max-w-xl sm:mt-20">
            @csrf
            @method('PATCH')
            <div class="w-full grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="idea" class="label" for="idea">Edit Idea</label>
                    <div class="mt-2.5">
                        <textarea id="idea" name="idea" rows="4" class="textarea w-full">{{ $idea->description }}</textarea>
                    </div>
                    <x-forms.error field="idea" />
                </div>

                <div class="mt-10 w-full justify-end card-actions">
                    <button type="submit" class="btn btn-secondary">Update</button>
                </div>

        </form>

        <form action="/ideas/{{ $idea->id }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="mt-10">
                <button type="submit" class="btn btn-primary">Delete</button>
            </div>
        </form>
    </div>
</x-layout>