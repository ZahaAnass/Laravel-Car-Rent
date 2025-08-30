<x-base-layout>
    @include("layouts.partials.header")
    {{ $slot }}
    <footer>
        @section("footerLinks")
            <a href="#">Link 1</a>
            <a href="#">Link 2</a>
        @show {{-- equivalent to @yield("footerLinks") --}}
    </footer>
</x-base-layout>