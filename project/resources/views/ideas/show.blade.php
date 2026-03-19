<x-layout title="Idea details">
  <div class="px-6 py-24 sm:py-32 lg:px-8">
    <div class=" card bg-neutral text-neutral-content">
      <div class="card-body">
        <h5 class="card-title text-4xl font-semibold tracking-tight text-balance sm:text-5xl">Your Idea</h2>
          <p class="mt-2">{{ $idea->description }}</p>
      </div>
      <div class="mt-10 ml-6 mb-6 card-actions">
        <div class="justify-end card-actions">
          <a href="/ideas/{{ $idea->id }}/edit" class="btn btn-primary">Update</a>
        </div>
        <div class="justify-end card-actions">
          <a href="/ideas" class="btn btn-secondary">Back to ideas</a>
        </div>
      </div>
    </div>
  </div>
</x-layout>