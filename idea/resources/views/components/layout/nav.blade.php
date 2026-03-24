<nav class="border-b border-border sticky top-0 z-10 bg-background">
    <div class="max-w-7xl mx-auto min-h-16 py-2.5 px-4 flex items-center justify-between">
        <div>
            <a href="{{ url('/') }}"
                class="inline-flex items-center no-underline outline-offset-4 rounded-sm focus-visible:ring-2 focus-visible:ring-primary/60">
                <img src="{{ asset('images/idea-wordmark.svg') }}" alt="Idea" width="178" height="56"
                    class="h-14 w-auto shrink-0 block" decoding="async" fetchpriority="high" />
            </a>
        </div>

        <div class="flex items-center gap-5">
            @guest
                <a href="{{ url('/register') }}">Register</a>
                <a href="{{ url('/login') }}" class="btn">Sign in</a>
            @endguest
            @auth
                <a href="{{ url('/logout') }}" class="btn">Logout</a>
            @endauth
        </div>
    </div>
</nav>