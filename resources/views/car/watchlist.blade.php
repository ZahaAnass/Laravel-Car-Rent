<x-app-layout>
    <main>
        <!-- New Cars -->
        <section>
            <div class="container">
                <div class="flex justify-between items-center">
                    <h2>My Favourite Cars</h2>
                    @if($cars->total() > 0)
                        <div class="pagination-summary">
                            Showing {{ $cars->firstItem() }} to {{ $cars->lastItem() }} of {{ $cars->total() }} cars
                        </div>
                    @endif
                </div>
                <div class="car-items-listing">
                    @foreach($cars as $car)
                        <x-car-item :$car :isInWatchlist="true" />
                    @endforeach
                </div>

                {{ $cars->onEachSide(1)->links() }}
            </div>
        </section>
        <!--/ New Cars -->
    </main>
</x-app-layout>
