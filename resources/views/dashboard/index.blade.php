<x-layouts.dashboard>
    <x-slot:title>Home</x-slot:title>

    <h2 class="text-6xl mb-4">Hi! It's good to see you 👋</h2>
    <p class="text-xl">What are we doing today?</p>

    {{--
        Possible features / buttons / cards
            - Write new blog
            - Admin my blogs
            - Participate on current raffle
            - Create current raffle
            - Report something
            etc :)
     --}}
    <section class="grid grid-cols-2 gap-4 mt-4">
        @if(auth()->user()->role_id >= 2)
            {{-- Blogger (admin his blogs) --}}
            <a
                class="bg-pink-300/40 hover:bg-pink-300/30 transition aspect-16/6 flex justify-end items-end py-2 px-4"
                href="{{ route('dashboard.blogs') }}"
            >👁 See my current blogs</a>

            <button
                class="bg-pink-300/40 hover:bg-pink-300/30 transition aspect-16/6 flex justify-end items-end py-2 px-4"
                data-open-form-create-blog
            >✍ Write a new blog</button>
            <x-blogs.form-create />
        @endif

        @if(auth()->user()->role_id >= 3)
            {{-- Company (prev + admin raffles) --}}
        @endif

        @if(auth()->user()->role_id >= 4)
            {{-- Admin (prev + accept publishment request) --}}
            <a
                class="bg-pink-300/40 hover:bg-pink-300/30 transition aspect-16/6 flex justify-end items-end py-2 px-4"
                href="{{ route('dashboard.blogs.publish_requests') }}"
            >🖐 Publish requests</a>

            <a
                class="bg-pink-300/40 hover:bg-pink-300/30 transition aspect-16/6 flex justify-end items-end py-2 px-4"
                href="{{ route('dashboard.all-users') }}"
            >👪 Users</a>
        @endif

        @if(auth()->user()->role_id >= 5)
            {{-- Users / I dunno --}}
        @endif
    </section>
</x-layouts.dashboard>
