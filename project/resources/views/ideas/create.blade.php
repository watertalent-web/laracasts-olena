<x-layout title="Create new Idea">
<form action="/ideas" method="POST" class="mx-auto mt-16 max-w-xl sm:mt-20">
      @csrf
      <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
        <div class="sm:col-span-2">
          <label for="idea" class="block text-sm/6 font-semibold text-gray-900">New Idea</label>
          <div class="mt-2.5">
            <textarea id="idea" name="idea" rows="4" class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600"></textarea>
          </div>
          <x-forms.error field="idea" />
        </div>

        <div class="mt-10">
          <button type="submit" class="btn btn-secondary">Submit</button>
        </div>
    </form>
</x-layout>