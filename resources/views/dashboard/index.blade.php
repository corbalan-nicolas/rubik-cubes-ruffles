<x-layouts.dashboard>
    <x-slot:title>Home</x-slot:title>

    <h1>Hi! It's good to see you 👋</h1>
    <p>What are we doing today?</p>

    {{--
        Future features / buttons / cards
            - Write new blog
            - Admin my blogs
            - Participate on current raffle
            - Create current raffle
            - Report something
            etc :)
     --}}
    @if(auth()->user()->role_id >= 2)
        {{-- Blogger (admin his blogs) --}}
        <a href="{{ route('dashboard.blogs') }}">📖 See my current blogs</a>
        <button data-open-form-create-blog>Write a new blog</button>
        <x-blogs.form-create />
    @endif

    @if(auth()->user()->role_id >= 3)
        {{-- Company (prev + admin raffles) --}}
    @endif

    @if(auth()->user()->role_id >= 4)
        {{-- Admin (prev + accept publishment request) --}}
        <a href="{{ route('dashboard.blogs.publish_requests') }}">Publish requests</a>
        <a href="{{ route('dashboard.all-users') }}">Users</a>
    @endif

    @if(auth()->user()->role_id >= 5)
        {{-- Users / I dunno --}}
    @endif
</x-layouts.dashboard>
