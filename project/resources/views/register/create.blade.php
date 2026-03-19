<x-layout title="Register">
    <div class="mx-auto flex justify-center mt-16 max-w-xl sm:mt-20">
        <form action="/register" method="POST">
            @csrf
            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4">
                <legend class="fieldset-legend">Register</legend>

                <label class="label">Name</label>
                <input type="text" name="name" class="input" placeholder="Your Name" required />

                <label class="label">Email</label>
                <input type="email" name="email" class="input" placeholder="Your Email" required />

                <label class="label">Password</label>
                <input type="password" name="password" class="input" placeholder="Your Password" required />

                <button class="btn btn-neutral mt-4" data-test="register-button">Register</button>
            </fieldset>
        </form>
    </div>
</x-layout>