<x-app-layout title="Home Page">

  @php
  $color = "red";
  $bgColor = "black";
  @endphp
  <x-card :$color :$bgColor lang="en" class="card-rounded">
  {{-- <x-card :color="$color" :bgColor="$bgColor"> --}}
      <x-slot:title class="card-header-blue">
          Card Title 1
      </x-slot:title>
          Card Content 1
      <x-slot name="footer">
          Card Footer 1
      </x-slot>
  </x-card>

  <x-test-component>
      <p>Test Component</p>
  </x-test-component>
  <!-- Home Slider -->
  <section class="hero-slider">
    <!-- Carousel wrapper -->
    <div class="hero-slides">
      <!-- Item 1 -->
      <div class="hero-slide">
        <div class="container">
          <div class="slide-content">
            <h1 class="hero-slider-title">
              Buy <strong>The Best Cars</strong> <br />
              in your region
            </h1>
            <div class="hero-slider-content">
              <p>
                Use powerful search tool to find your desired cars based on
                multiple search criteria: Maker, Model, Year, Price Range, Car
                Type, etc...
              </p>

              <button class="btn btn-hero-slider">Find the car</button>
            </div>
          </div>
          <div class="slide-image">
            <img src="/img/car-png-39071.png" alt="" class="img-responsive" />
          </div>
        </div>
      </div>
      <!-- Item 2 -->
      <div class="hero-slide">
        <div class="flex container">
          <div class="slide-content">
            <h2 class="hero-slider-title">
              Do you want to <br />
              <strong>sell your car?</strong>
            </h2>
            <div class="hero-slider-content">
              <p>
                Submit your car in our user friendly interface, describe it,
                upload photos and the perfect buyer will find it...
              </p>

              <button class="btn btn-hero-slider">Add Your Car</button>
            </div>
          </div>
          <div class="slide-image">
            <img src="/img/car-png-39071.png" alt="" class="img-responsive" />
          </div>
        </div>
      </div>
      <button type="button" class="hero-slide-prev">
        <svg
          style="width: 18px"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 6 10"
        >
          <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M5 1 1 5l4 4"
          />
        </svg>
        <span class="sr-only">Previous</span>
      </button>
      <button type="button" class="hero-slide-next">
        <svg
          style="width: 18px"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 6 10"
        >
          <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="m1 9 4-4-4-4"
          />
        </svg>
        <span class="sr-only">Next</span>
      </button>
    </div>
  </section>
  <!--/ Home Slider -->
  <main>

    <x-search-form action="/search" method="GET" />
    <!-- New Cars -->
    <section>
      <div class="container">
        <h2>Latest Added Cars</h2>
        <div class="car-items-listing">
          <div class="car-item card">
            <a href="/view.html">
              <img
                src="/img/cars/Lexus-RX200t-2016/1.jpeg"
                alt=""
                class="car-item-img rounded-t"
              />
            </a>
            <div class="p-medium">
              <div class="flex items-center justify-between">
                <small class="m-0 text-muted">New Jersey</small>
                <button class="btn-heart">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    style="width: 20px"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                    />
                  </svg>
                </button>
              </div>
              <h2 class="car-item-title">2016 - Lexus RX200t</h2>
              <p class="car-item-price">$25,000</p>
              <hr />
              <p class="m-0">
                <span class="car-item-badge">SUV</span>
                <span class="car-item-badge">Electric</span>
              </p>
            </div>
          </div>
          <div class="car-item card">
            <a href="/view.html">
              <img
                src="/img/cars/Lexus-RX200t-2016/1.jpeg"
                alt=""
                class="car-item-img rounded-t"
              />
            </a>
            <div class="p-medium">
              <div class="flex items-center justify-between">
                <small class="m-0 text-muted">New Jersey</small>
                <button class="btn-heart">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    style="width: 20px"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                    />
                  </svg>
                </button>
              </div>
              <h2 class="car-item-title">2016 - Lexus RX200t</h2>
              <p class="car-item-price">$25,000</p>
              <hr />
              <p class="m-0">
                <span class="car-item-badge">SUV</span>
                <span class="car-item-badge">Electric</span>
              </p>
            </div>
          </div>
          <div class="car-item card">
            <a href="/view.html">
              <img
                src="/img/cars/Lexus-RX200t-2016/1.jpeg"
                alt=""
                class="car-item-img rounded-t"
              />
            </a>
            <div class="p-medium">
              <div class="flex items-center justify-between">
                <small class="m-0 text-muted">New Jersey</small>
                <button class="btn-heart">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    style="width: 20px"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                    />
                  </svg>
                </button>
              </div>
              <h2 class="car-item-title">2016 - Lexus RX200t</h2>
              <p class="car-item-price">$25,000</p>
              <hr />
              <p class="m-0">
                <span class="car-item-badge">SUV</span>
                <span class="car-item-badge">Electric</span>
              </p>
            </div>
          </div>
          <div class="car-item card">
            <a href="/view.html">
              <img
                src="/img/cars/Lexus-RX200t-2016/1.jpeg"
                alt=""
                class="car-item-img rounded-t"
              />
            </a>
            <div class="p-medium">
              <div class="flex items-center justify-between">
                <small class="m-0 text-muted">New Jersey</small>
                <button class="btn-heart">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    style="width: 20px"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                    />
                  </svg>
                </button>
              </div>
              <h2 class="car-item-title">2016 - Lexus RX200t</h2>
              <p class="car-item-price">$25,000</p>
              <hr />
              <p class="m-0">
                <span class="car-item-badge">SUV</span>
                <span class="car-item-badge">Electric</span>
              </p>
            </div>
          </div>
          <div class="car-item card">
            <a href="/view.html">
              <img
                src="/img/cars/Lexus-RX200t-2016/1.jpeg"
                alt=""
                class="car-item-img rounded-t"
              />
            </a>
            <div class="p-medium">
              <div class="flex items-center justify-between">
                <small class="m-0 text-muted">New Jersey</small>
                <button class="btn-heart">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    style="width: 20px"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                    />
                  </svg>
                </button>
              </div>
              <h2 class="car-item-title">2016 - Lexus RX200t</h2>
              <p class="car-item-price">$25,000</p>
              <hr />
              <p class="m-0">
                <span class="car-item-badge">SUV</span>
                <span class="car-item-badge">Electric</span>
              </p>
            </div>
          </div>
          <div class="car-item card">
            <a href="/view.html">
              <img
                src="/img/cars/Lexus-RX200t-2016/1.jpeg"
                alt=""
                class="car-item-img rounded-t"
              />
            </a>
            <div class="p-medium">
              <div class="flex items-center justify-between">
                <small class="m-0 text-muted">New Jersey</small>
                <button class="btn-heart">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    style="width: 20px"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                    />
                  </svg>
                </button>
              </div>
              <h2 class="car-item-title">2016 - Lexus RX200t</h2>
              <p class="car-item-price">$25,000</p>
              <hr />
              <p class="m-0">
                <span class="car-item-badge">SUV</span>
                <span class="car-item-badge">Electric</span>
              </p>
            </div>
          </div>
          <div class="car-item card">
            <a href="/view.html">
              <img
                src="/img/cars/Lexus-RX200t-2016/1.jpeg"
                alt=""
                class="car-item-img rounded-t"
              />
            </a>
            <div class="p-medium">
              <div class="flex items-center justify-between">
                <small class="m-0 text-muted">New Jersey</small>
                <button class="btn-heart">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    style="width: 20px"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                    />
                  </svg>
                </button>
              </div>
              <h2 class="car-item-title">2016 - Lexus RX200t</h2>
              <p class="car-item-price">$25,000</p>
              <hr />
              <p class="m-0">
                <span class="car-item-badge">SUV</span>
                <span class="car-item-badge">Electric</span>
              </p>
            </div>
          </div>
          <div class="car-item card">
            <a href="/view.html">
              <img
                src="/img/cars/Lexus-RX200t-2016/1.jpeg"
                alt=""
                class="car-item-img rounded-t"
              />
            </a>
            <div class="p-medium">
              <div class="flex items-center justify-between">
                <small class="m-0 text-muted">New Jersey</small>
                <button class="btn-heart">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    style="width: 20px"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                    />
                  </svg>
                </button>
              </div>
              <h2 class="car-item-title">2016 - Lexus RX200t</h2>
              <p class="car-item-price">$25,000</p>
              <hr />
              <p class="m-0">
                <span class="car-item-badge">SUV</span>
                <span class="car-item-badge">Electric</span>
              </p>
            </div>
          </div>
          <div class="car-item card">
            <a href="/view.html">
              <img
                src="/img/cars/Lexus-RX200t-2016/1.jpeg"
                alt=""
                class="car-item-img rounded-t"
              />
            </a>
            <div class="p-medium">
              <div class="flex items-center justify-between">
                <small class="m-0 text-muted">New Jersey</small>
                <button class="btn-heart">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    style="width: 20px"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                    />
                  </svg>
                </button>
              </div>
              <h2 class="car-item-title">2016 - Lexus RX200t</h2>
              <p class="car-item-price">$25,000</p>
              <hr />
              <p class="m-0">
                <span class="car-item-badge">SUV</span>
                <span class="car-item-badge">Electric</span>
              </p>
            </div>
          </div>
          <div class="car-item card">
            <a href="/view.html">
              <img
                src="/img/cars/Lexus-RX200t-2016/1.jpeg"
                alt=""
                class="car-item-img rounded-t"
              />
            </a>
            <div class="p-medium">
              <div class="flex items-center justify-between">
                <small class="m-0 text-muted">New Jersey</small>
                <button class="btn-heart">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    style="width: 20px"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                    />
                  </svg>
                </button>
              </div>
              <h2 class="car-item-title">2016 - Lexus RX200t</h2>
              <p class="car-item-price">$25,000</p>
              <hr />
              <p class="m-0">
                <span class="car-item-badge">SUV</span>
                <span class="car-item-badge">Electric</span>
              </p>
            </div>
          </div>
          <div class="car-item card">
            <a href="/view.html">
              <img
                src="/img/cars/Lexus-RX200t-2016/1.jpeg"
                alt=""
                class="car-item-img rounded-t"
              />
            </a>
            <div class="p-medium">
              <div class="flex items-center justify-between">
                <small class="m-0 text-muted">New Jersey</small>
                <button class="btn-heart">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    style="width: 20px"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                    />
                  </svg>
                </button>
              </div>
              <h2 class="car-item-title">2016 - Lexus RX200t</h2>
              <p class="car-item-price">$25,000</p>
              <hr />
              <p class="m-0">
                <span class="car-item-badge">SUV</span>
                <span class="car-item-badge">Electric</span>
              </p>
            </div>
          </div>
          <div class="car-item card">
            <a href="/view.html">
              <img
                src="/img/cars/Lexus-RX200t-2016/1.jpeg"
                alt=""
                class="car-item-img rounded-t"
              />
            </a>
            <div class="p-medium">
              <div class="flex items-center justify-between">
                <small class="m-0 text-muted">New Jersey</small>
                <button class="btn-heart">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    style="width: 20px"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                    />
                  </svg>
                </button>
              </div>
              <h2 class="car-item-title">2016 - Lexus RX200t</h2>
              <p class="car-item-price">$25,000</p>
              <hr />
              <p class="m-0">
                <span class="car-item-badge">SUV</span>
                <span class="car-item-badge">Electric</span>
              </p>
            </div>
          </div>
          <div class="car-item card">
            <a href="/view.html">
              <img
                src="/img/cars/Lexus-RX200t-2016/1.jpeg"
                alt=""
                class="car-item-img rounded-t"
              />
            </a>
            <div class="p-medium">
              <div class="flex items-center justify-between">
                <small class="m-0 text-muted">New Jersey</small>
                <button class="btn-heart">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    style="width: 20px"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                    />
                  </svg>
                </button>
              </div>
              <h2 class="car-item-title">2016 - Lexus RX200t</h2>
              <p class="car-item-price">$25,000</p>
              <hr />
              <p class="m-0">
                <span class="car-item-badge">SUV</span>
                <span class="car-item-badge">Electric</span>
              </p>
            </div>
          </div>
          <div class="car-item card">
            <a href="/view.html">
              <img
                src="/img/cars/Lexus-RX200t-2016/1.jpeg"
                alt=""
                class="car-item-img rounded-t"
              />
            </a>
            <div class="p-medium">
              <div class="flex items-center justify-between">
                <small class="m-0 text-muted">New Jersey</small>
                <button class="btn-heart">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    style="width: 20px"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                    />
                  </svg>
                </button>
              </div>
              <h2 class="car-item-title">2016 - Lexus RX200t</h2>
              <p class="car-item-price">$25,000</p>
              <hr />
              <p class="m-0">
                <span class="car-item-badge">SUV</span>
                <span class="car-item-badge">Electric</span>
              </p>
            </div>
          </div>
          <div class="car-item card">
            <a href="/view.html">
              <img
                src="/img/cars/Lexus-RX200t-2016/1.jpeg"
                alt=""
                class="car-item-img rounded-t"
              />
            </a>
            <div class="p-medium">
              <div class="flex items-center justify-between">
                <small class="m-0 text-muted">New Jersey</small>
                <button class="btn-heart">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    style="width: 20px"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                    />
                  </svg>
                </button>
              </div>
              <h2 class="car-item-title">2016 - Lexus RX200t</h2>
              <p class="car-item-price">$25,000</p>
              <hr />
              <p class="m-0">
                <span class="car-item-badge">SUV</span>
                <span class="car-item-badge">Electric</span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--/ New Cars -->
  </main>

  <x-slot:footerLinks>
    <a href="#">Link 3</a>
    <a href="#">Link 4</a>
  </x-slot:footerLinks>

</x-app-layout>
