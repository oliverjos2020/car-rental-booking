<div>
    {{-- Stunning Animated Slider --}}
    <div class="position-relative" style="margin-bottom: 3rem; overflow: hidden;">
        <div id="entertainmentCarousel" class="carousel slide" data-ride="carousel" data-interval="3500">
            @php
                $images = [
                    'slider1.jpg', '1.jpeg', '2.jpeg',
                    '3.jpeg', '4.jpeg', '5.jpeg', '6.jpeg', '8.jpeg', '9.jpeg',
                    '11.jpeg', '12.jpeg', '13.jpeg', '14.jpeg', '15.jpeg', '16.jpeg',
                    '17.jpeg', '18.jpeg', '19.jpeg', '20.jpeg', '21.jpeg', '22.jpeg', '23.jpeg'
                ];
            @endphp

            {{-- Carousel Indicators --}}
            <ol class="carousel-indicators" style="bottom: 20px;">
                @foreach($images as $index => $image)
                <li data-target="#entertainmentCarousel" data-slide-to="{{ $index }}"
                    class="{{ $index === 0 ? 'active' : '' }}"
                    style="width: 12px; height: 12px; border-radius: 50%; margin: 0 5px;"></li>
                @endforeach
            </ol>

            {{-- Carousel Slides --}}
            <div class="carousel-inner">
                @foreach($images as $index => $image)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" data-bs-interval="3500">
                    <div class="position-relative">
                        <img src="{{ asset('img/' . $image) }}" class="d-block w-100" alt="Entertainment Image {{ $index + 1 }}"
                             style="height: 600px; object-fit: cover; animation: zoomIn 3.5s ease-in-out;">

                        {{-- Gradient Overlay --}}
                        <div class="position-absolute top-0 start-0 w-100 h-100"
                             style="background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.6) 100%);"></div>

                        {{-- Animated Caption --}}
                        {{-- <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100"
                             style="top: 0; bottom: 0; animation: fadeInUp 1s ease-out;">
                            <h1 class="display-2 fw-bold text-white mb-4"
                                style="text-shadow: 3px 3px 10px rgba(0,0,0,0.8); animation: slideInDown 1s ease-out;">
                                <i class="fas fa-glass-cheers"></i> Premium Entertainment
                            </h1>
                            <p class="lead text-white mb-4 px-3"
                               style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8); font-size: 1.8rem; max-width: 800px; animation: fadeIn 1.5s ease-out;">
                                Luxury Vehicles • Exceptional Service • Unforgettable Experiences
                            </p>
                            <div style="animation: bounceIn 2s ease-out;">
                                <a href="#booking-form" class="btn btn-lg px-5 py-3 text-white"
                                   style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                          border: none; font-size: 1.3rem; border-radius: 50px;
                                          box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
                                          transition: all 0.3s ease;"
                                   onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 40px rgba(102, 126, 234, 0.6)'"
                                   onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(102, 126, 234, 0.4)'">
                                    <i class="fas fa-calendar-check"></i> Book Now
                                </a>
                            </div>
                        </div> --}}
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Custom Navigation Buttons --}}
            <a class="carousel-control-prev" href="#entertainmentCarousel" role="button" data-slide="prev"
               style="width: 60px; opacity: 0.9;">
                <div style="background: rgba(102, 126, 234, 0.8); width: 50px; height: 50px; border-radius: 50%;
                            display: flex; align-items: center; justify-content: center; transition: all 0.3s;"
                     onmouseover="this.style.background='rgba(102, 126, 234, 1)'; this.style.transform='scale(1.1)'"
                     onmouseout="this.style.background='rgba(102, 126, 234, 0.8)'; this.style.transform='scale(1)'">
                    <i class="fas fa-chevron-left text-white" style="font-size: 1.5rem;"></i>
                </div>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#entertainmentCarousel" role="button" data-slide="next"
               style="width: 60px; opacity: 0.9;">
                <div style="background: rgba(102, 126, 234, 0.8); width: 50px; height: 50px; border-radius: 50%;
                            display: flex; align-items: center; justify-content: center; transition: all 0.3s;"
                     onmouseover="this.style.background='rgba(102, 126, 234, 1)'; this.style.transform='scale(1.1)'"
                     onmouseout="this.style.background='rgba(102, 126, 234, 0.8)'; this.style.transform='scale(1)'">
                    <i class="fas fa-chevron-right text-white" style="font-size: 1.5rem;"></i>
                </div>
                <span class="sr-only">Next</span>
            </a>
        </div>

        {{-- Slide Counter --}}
        <div class="position-absolute bottom-0 end-0 m-4 px-3 py-2 text-white"
             style="background: rgba(0,0,0,0.6); border-radius: 20px; font-size: 0.9rem; z-index: 10;">
            <i class="fas fa-images"></i> <span id="currentSlide">1</span> / {{ count($images) }}
        </div>
    </div>

    {{-- CSS Animations --}}
    <style>
        @keyframes zoomIn {
            from {
                transform: scale(1.2);
            }
            to {
                transform: scale(1);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }
            50% {
                transform: scale(1.05);
            }
            70% {
                transform: scale(0.9);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .carousel-item {
            transition: transform 1s ease-in-out;
        }

        .carousel-fade .carousel-item {
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .carousel-fade .carousel-item.active {
            opacity: 1;
        }
    </style>

    {{-- JavaScript for Carousel and Slide Counter --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize carousel with jQuery (for older Bootstrap versions)
            if (typeof jQuery !== 'undefined') {
                jQuery('#entertainmentCarousel').carousel({
                    interval: 3500,
                    ride: 'carousel',
                    pause: 'hover',
                    wrap: true
                });

                // Update slide counter with jQuery
                jQuery('#entertainmentCarousel').on('slide.bs.carousel', function(e) {
                    document.getElementById('currentSlide').textContent = e.to + 1;
                });
            } else {
                // Fallback for Bootstrap 5
                var carousel = document.getElementById('entertainmentCarousel');
                var currentSlideElement = document.getElementById('currentSlide');

                if (carousel) {
                    // Try Bootstrap 5 API
                    if (typeof bootstrap !== 'undefined') {
                        var bsCarousel = new bootstrap.Carousel(carousel, {
                            interval: 3500,
                            ride: 'carousel',
                            pause: 'hover',
                            wrap: true
                        });
                    }

                    carousel.addEventListener('slide.bs.carousel', function(e) {
                        currentSlideElement.textContent = e.to + 1;
                    });
                }
            }

            // Smooth scroll for Book Now button
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    var target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
    {{-- Booking Form Section --}}
    <div class="container mb-5" id="booking-form">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-gradient text-white text-center py-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <h2 class="mb-0"><i class="fas fa-calendar-check"></i> Book Your Entertainment Experience</h2>
                        <p class="mb-0 mt-2">Fill out the form below to reserve your luxury entertainment service</p>
                    </div>
                    <div class="card-body p-4">
                        {{-- Vehicle Selection --}}
                        <div class="mb-4">
                            <h5 class="fw-bold text-primary mb-3"><i class="fas fa-car"></i> Select Your Vehicle</h5>
                            <div class="form-group">
                                <label for="vehicle" class="form-label fw-semibold">Vehicle <span class="text-danger">*</span></label>
                                <select class="form-control form-control-lg" wire:model="selectedVehicle">
                                    <option value="">Choose a luxury vehicle...</option>
                                    @forelse($isVehicles as $isVehicle)
                                        <option value="{{$isVehicle->id}}">{{$isVehicle->item}} - ${{number_format($isVehicle->amount, 2)}}</option>
                                    @empty
                                        <option disabled>No vehicles available</option>
                                    @endforelse
                                </select>
                                @error('vehicle')
                                    <div class="text-danger mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- Event Details --}}
                        <div class="mb-4">
                            <h5 class="fw-bold text-primary mb-3"><i class="fas fa-info-circle"></i> Event Details</h5>
                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label for="event" class="form-label fw-semibold">Event Type <span class="text-danger">*</span></label>
                                    <input type="text" wire:model="event" placeholder="e.g., Wedding, Birthday, Corporate" class="form-control form-control-lg">
                                    @error('event')
                                        <div class="text-danger mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="entertainment_date" class="form-label fw-semibold">Event Date <span class="text-danger">*</span></label>
                                    <input type="date" wire:model="entertainment_date" class="form-control form-control-lg">
                                    @error('entertainment_date')
                                        <div class="text-danger mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="address" class="form-label fw-semibold">Event Address <span class="text-danger">*</span></label>
                                    <input type="text" wire:model="address" placeholder="Full event address" class="form-control form-control-lg">
                                    @error('address')
                                        <div class="text-danger mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- Service Details --}}
                        <div class="mb-4">
                            <h5 class="fw-bold text-primary mb-3"><i class="fas fa-cogs"></i> Service Configuration</h5>
                            <div class="row g-3">
                                <div class="col-md-4 mb-3">
                                    <label for="participants" class="form-label fw-semibold">Participants <span class="text-danger">*</span></label>
                                    <input type="number" wire:model="participants" placeholder="Number of guests" class="form-control form-control-lg">
                                    @error('participants')
                                        <div class="text-danger mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="hours" class="form-label fw-semibold">Duration (Hours) <span class="text-danger">*</span></label>
                                    <input type="number" wire:model="hours" placeholder="Number of hours" class="form-control form-control-lg">
                                    @error('hours')
                                        <div class="text-danger mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="no_of_stops" class="form-label fw-semibold">Number of Stops <span class="text-danger">*</span></label>
                                    <input type="number" wire:model="no_of_stops" placeholder="Stops count" class="form-control form-control-lg">
                                    @error('no_of_stops')
                                        <div class="text-danger mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="stop_location" class="form-label fw-semibold">Stop Locations <span class="text-danger">*</span></label>
                                    <input type="text" wire:model="stop_location" placeholder="Stop Location" class="form-control form-control-lg">
                                    @error('stop_location')
                                        <div class="text-danger mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- Additional Services --}}
                        <div class="mb-4">
                            <h5 class="fw-bold text-primary mb-3"><i class="fas fa-plus-circle"></i> Additional Services & Amenities</h5>
                            <div class="row g-3">
                                @forelse($menus as $menu)
                                    <div class="col-md-6">
                                        <div class="card h-100 {{ $menu->required == 1 ? 'border-success' : 'border-secondary' }}" style="transition: all 0.3s;">
                                            <div class="card-body" style="padding: 21px 24px 15px 17px !important">
                                                <div class="form-check">
                                                    <input
                                                        wire:model="selectedMenus"
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        value="{{ $menu->id }}"
                                                        id="menu{{ $menu->id }}"
                                                        @if ($menu->required == 1) checked disabled @endif
                                                    >
                                                    <label class="form-check-label w-100" for="menu{{ $menu->id }}">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <div>
                                                                <strong>{{ $menu->item }}</strong>
                                                                @if($menu->required == 1)
                                                                    <span class="badge bg-success ms-2">Required</span>
                                                                @endif
                                                                @if($menu->charge_per_hour == 1)
                                                                    <span class="badge bg-info ms-2">Per Hour</span>
                                                                @endif
                                                            </div>
                                                            <div class="text-end">
                                                                <strong class="text-primary">${{ number_format($menu->amount, 2) }}</strong>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <p class="text-muted text-center">No additional services available</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        {{-- Selected Vehicle Display --}}
                        @if($vehicle)
                            <div class="alert alert-info d-flex align-items-center" role="alert">
                                <i class="fas fa-car fa-2x me-3"></i>
                                <div>
                                    <strong>Selected Vehicle:</strong> {{$vehicle->item}} - <strong>${{number_format($vehicle->amount, 2)}}</strong>
                                </div>
                            </div>
                        @endif

                        {{-- Submit Button --}}
                        <div class="text-center mt-4">
                            @if (Auth::check())
                                <button class="btn btn-lg px-5 py-3 text-white" wire:click="proceed"
                                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; font-size: 1.2rem;">
                                    <i class="fas fa-arrow-right"></i> Proceed to Checkout
                                </button>
                            @else
                                <a href="/login" class="btn btn-lg px-5 py-3 text-white"
                                   style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; font-size: 1.2rem;">
                                    <i class="fas fa-sign-in-alt"></i> Login to Proceed
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
