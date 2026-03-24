<x-form.form title="Login" description="Glad to see you again!">
    <form action="/login" method="POST" class="mt-10 space-y-4">
        @csrf
        <x-form.field label="Email" name="email" type="email" />
        <x-form.field label="Password" name="password" type="password" />
        <button type="submit" class="btn mt-2 h-10 w-full" data-testid="login-button">Login</button>
    </form>
</x-form.form>