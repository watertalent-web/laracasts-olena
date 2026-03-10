<x-layout>
    <x-slot:heading>Contact</x-slot:heading>
    <main>
    <h1>contact</h1>
    <p>This is the contact page</p>
    <form action="/contact" method="post">
        <input type="text" name="name" placeholder="Name">
        <input type="email" name="email" placeholder="Email">
        <input type="submit" value="Submit">
    </form>
</main>
</x-layout>