<div class="card bg-neutral text-neutral-content">
  <div class="card-body">
    <h2 class="card-title">{{ $idea->description }}</h2>
    <div class="justify-end card-actions">
      <a href="/ideas/{{ $idea->id }}" class="btn btn-primary">View</a>
    </div>
  </div>
</div>