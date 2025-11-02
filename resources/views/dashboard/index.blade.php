<x-layouts.dashboard>
    <x-slot:title>Home</x-slot:title>

    <h1>Hi! It's good to see you 👋</h1>
    <p>What are we doing today?</p>

    {{--
        Future features / buttons / cards
            - Write new blog
            - Admin my blogs
            - Participate on current ruffle
            - Create current ruffle
            - Report something
            etc :)
     --}}
    @if(auth()->user()->role_id >= 2)
        {{-- Blogger (admin his blogs) --}}
        <a href="{{ route('dashboard.blogs') }}">📖 See my current blogs</a>
        <x-blogs.form-create />
    @endif

    @if(auth()->user()->role_id >= 3)
        {{-- Company (prev + admin ruffles) --}}

    @endif

    @if(auth()->user()->role_id >= 4)
        {{-- Admin (prev + accept publishment request) --}}

    @endif

    @if(auth()->user()->role_id >= 5)
        {{-- Users / I dunno --}}
    @endif
</x-layouts.dashboard>
