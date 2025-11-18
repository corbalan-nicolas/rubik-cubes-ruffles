<?php
/**
 * @var ?\Illuminate\Database\Eloquent\Model $raffle
 */
?>

<x-layouts.main>
    <x-slot:title>Home</x-slot:title>

    <h1 class="sr-only">Rubbik's cube raffles</h1>

    <section class="container">
        {{-- TODO: Responsive banners --}}
        <x-raffle-banners :raffle="$raffle" />
    </section>

    <section class="container-sm container--participate">
        <div class="model">
            <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>
            {{-- TODO: Dynamic model --}}
            <model-viewer
                src="{{ \Storage::url('models/scene.gltf') }}"
                camera-controls
                aria-describedby="license"
                auto-rotate
            ></model-viewer>
            <small id="license">
                This work is based on
                <a target="_blank" href="https://sketchfab.com/3d-models/gan-rubik-cube-8662f6d93d1e4b6495dfd0134f63d3ce">"GAN Rubik Cube" <span class="sr-only">(opens a new window)</span></a>
                by <a target="_blank" href="https://sketchfab.com/matiasvergara">matiasvergara12 <span class="sr-only">(opens a new window)</span></a>
                licensed under <a target="_blank" href="http://creativecommons.org/licenses/by/4.0/">CC-BY-4.0 <span class="sr-only">(opens a new window)</span></a>
            </small>
        </div>
        <div>
            <h2>{{ $raffle->title }}</h2>

            <p>{{ $raffle->desc }}</p>

            <button class="btn btn-primary">Buy My Ticket</button>

            <p>Pay with ease and secure</p>
            <x-icons.visa />
            <x-icons.mastercard />
        </div>
    </section>

    <section class="text-center">
        <div class="container-sm container--working">
            <h2>Working with the bests</h2>
            <ul class="working-with-ul">
                <li class="working-with-li">
                    {{-- I think that 80px per image is ok --}}
                    <img class="working-with-img" src="{{ url('images/working-with/gan-brand-logo.webp') }}" alt="GAN's logo">
                    GAN
                </li>
                <li class="working-with-li">
                    <img class="working-with-img" src="{{ url('images/working-with/qiyi-brand-logo.webp') }}" alt="Qiyi's logo">
                    QiYi
                </li>
                <li class="working-with-li">
                    <img class="working-with-img" src="{{ url('images/working-with/shengshou-brand-logo.webp') }}" alt="ShengShou's logo">
                    ShengShou
                </li>
                <li class="working-with-li">
                    <img class="working-with-img" src="{{ url('images/working-with/dayan-brand-logo.webp') }}" alt="Dayan's logo">
                    Dayan
                </li>
            </ul>
        </div>
    </section>

    <section class="container-sm container--faq">
        <h2>FAQ</h2>

        <details name="faq">
            <summary>
                <x-icons.cube />
                What are the requirements to participate in the raffles?
            </summary>

            <div class="summary__body">
                <p>The only requirement is to buy your ticket.</p>
            </div>
        </details>

        <details name="faq">
            <summary>
                <x-icons.cube />
                What is the price of each ticket?
            </summary>

            <div class="summary__body">
                <p>Currently, each ticket costs USD$0.99 pesos. We have no plans to change it.</p>
            </div>
        </details>

        <details name="faq">
            <summary>
                <x-icons.cube />
                How many tickets can I buy per raffle?
            </summary>

            <div class="summary__body">
                <p>There is no limit.</p>
            </div>
        </details>

        <details name="faq">
            <summary>
                <x-icons.cube />
                Why would I buy more than one ticket?
            </summary>

            <div class="summary__body">
                <p>Each ticket you purchase increases your chances of winning by x1.</p>
            </div>
        </details>

        <details name="faq">
            <summary>
                <x-icons.cube />
                How do I know if I won?
            </summary>

            <div class="summary__body">
                <p>Every time a raffle ends, all users are notified by email whether they won or not.</p>
                <p>In the future, we will also implement a history section to view all the raffles held on our platform and their winners.</p>
            </div>
        </details>
    </section>

    <link rel="stylesheet" href="{{ url('css/raffles.css') }}">
</x-layouts.main>
