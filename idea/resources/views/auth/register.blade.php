<x-form.form title="Register Now" description="Start tracking your ideas today">
    <form action="/register" method="post" class="mt-10 space-y-4">
        @csrf
        <x-form.field label="Name" name="name"  />
        <x-form.field label="Email" name="email" type="email" />
        <x-form.field label="Password" name="password" type="password" />

        <button type="submit" class="btn mt-2 h-10 w-full">Create Account</button>
    </form>
</x-form.form>