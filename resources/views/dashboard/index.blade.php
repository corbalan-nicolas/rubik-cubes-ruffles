<?php
/**
 *
 */
?>

<x-layouts.dashboard>
    <x-slot:title>Home</x-slot:title>

    <h1 class="text-6xl mb-4">Hi! It's good to see you 👋</h1>

    @if(auth()->user()->role_id >= 4)
        <section class="grid grid-cols-2 gap-4 md:grid-cols-4 mb-4">
            <h2 class="sr-only">Graphics</h2>
            <div class="border px-4 py-2">
                <div class="flex justify-end">
                    {{ $totalOfTicketsSold }}
                    <x-icons.ticket />
                </div>
                <p>Tickets sold</p>
            </div>
            <div class="border px-4 py-2">
                <div class="flex justify-end">
                    {{ $totalOfUsers }}
                    <x-icons.users />
                </div>
                    <p>Users</p>
            </div>
            <div class="border px-4 py-2">
                <div class="flex justify-end">
                    {{ $totalOfRaffles }}
                    <x-icons.raffle />
                </div>
                <p>Raffles</p>
            </div>
            <div class="border px-4 py-2">
                <div class="flex justify-end">
                    {{ $totalOfBlogs }}
                    <x-icons.blog />
                </div>
                <p>Blogs published</p>
            </div>
        </section>
    @endif

    <p class="text-xl">What are we doing today?</p>
    <section class="grid grid-cols-2 gap-4 mt-4">
        <h2 class="sr-only">Shortcuts</h2>
        <a
            class="bg-pink-300/40 hover:bg-pink-300/30 transition aspect-16/6 flex justify-end items-end py-2 px-4"
            href="{{ route('checkout') }}"
        >🦈 Buy tickets for the current raffle</a>

        @if(auth()->user()->role_id >= 2)
            {{-- Blogger (admin his blogs) --}}
            <a
                class="bg-pink-300/40 hover:bg-pink-300/30 transition aspect-16/6 flex justify-end items-end py-2 px-4"
                href="{{ route('dashboard.blogs') }}"
            >👁 See my current blogs</a>

            <a
                class="bg-pink-300/40 hover:bg-pink-300/30 transition aspect-16/6 flex justify-end items-end py-2 px-4"
                href="{{ route('dashboard.blogs.edit') }}"
            >✍ Write a new blog</a>
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
