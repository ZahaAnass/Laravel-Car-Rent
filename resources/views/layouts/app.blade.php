@extends("layouts.clean")


@section("childContent")
    @include("layouts.partials.header")
    @yield("content")
    <footer>
        @section("footerLinks")
            <a href="#">Link 1</a>
            <a href="#">Link 2</a>
        @show {{-- equivalent to @yield("footerLinks") --}}
    </footer>
@endsection


