<x-layout title="Register">
    <div class="mx-auto flex justify-center mt-16 max-w-xl sm:mt-20">
        <form action="/login" method="POST">
            @csrf
            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4">
                <legend class="fieldset-legend">Login</legend>

                <label class="label">Email</label>
                <input type="email" name="email" class="input" placeholder="Your Email" required />

                <label class="label">Password</label>
                <input type="password" name="password" class="input" placeholder="Your Password" required />

                <x-forms.error field="email" />
                <button class="btn btn-neutral mt-4">Login</button>
            </fieldset>
        </form>
    </div>
</x-layout>