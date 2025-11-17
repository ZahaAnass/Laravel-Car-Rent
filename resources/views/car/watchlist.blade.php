<x-app-layout>
    <main>
        <!-- New Cars -->
        <section>
            <div class="container">
                @if (session('status'))
                    <div class="alert success-alert">
                        <span><strong>✅ Success:</strong> {{ session('status') }}</span>
                        <button class="close-btn" onclick="this.parentElement.remove()">×</button>
                    </div>
                @endif
                <div class="flex justify-between items-center">
                    <h2>My Favourite Cars</h2>
                    @if($cars->total() > 0)
                        <div class="pagination-summary">
                            Showing {{ $cars->firstItem() }} to {{ $cars->lastItem() }} of {{ $cars->total() }} cars
                        </div>
                    @endif
                </div>
                <div class="car-items-listing">
                    @if($cars->count() > 0)
                        @foreach($cars as $car)
                            <x-car-item :$car :isInWatchlist="true" />
                        @endforeach
                    @else
                        <p style="text-align: start; width: 100%;">No cars found in your watchlist.</p>
                    @endif
                </div>

                {{ $cars->onEachSide(1)->links() }}
            </div>
        </section>
        <!--/ New Cars -->
    </main>
</x-app-layout>
