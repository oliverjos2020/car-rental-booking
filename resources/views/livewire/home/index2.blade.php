<div>
    {{-- Modern Hero Slider with Animations --}}
    <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="5000" style="position: relative;">
        @php
            $heroSlides = [
                ['image' => 'slider1.jpg', 'title' => 'Experience Luxury Rides', 'subtitle' => 'Premium vehicles for every occasion', 'service' => 'Car Rental'],
                ['image' => '1.jpeg', 'title' => 'Book Your Ride Today', 'subtitle' => 'Reliable & comfortable transportation', 'service' => 'Ride Booking'],
                ['image' => '3.jpeg', 'title' => 'Celebrate in grand Style', 'subtitle' => 'Entertainment services for special events', 'service' => 'Entertainment']
            ];
        @endphp

        <ol class="carousel-indicators" style="bottom: 30px;">
            @foreach($heroSlides as $index => $slide)
            <li data-target="#heroCarousel" data-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"
                style="width: 15px; height: 15px; border-radius: 50%; margin: 0 8px;"></li>
            @endforeach
        </ol>

        <div class="carousel-inner">
            @foreach($heroSlides as $index => $slide)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <img src="{{ asset('img/' . $slide['image']) }}" class="d-block w-100" alt="{{ $slide['title'] }}"
                     style="height: 100vh; object-fit: cover; filter: brightness(0.5); animation: zoomIn 5s ease-in-out;">

                <div class="carousel-caption d-flex flex-column justify-content-center align-items-start h-100"
                     style="top: 0; left: 0; right: 0; bottom: 0; text-align: left; padding-left: 10%;">
                    <div class="container" style="max-width: 1200px;">
                        <div class="row">
                            <div class="col-lg-6">
                                <span class="badge badge-primary mb-3 px-4 py-2"
                                      style="font-size: 1rem; background: linear-gradient(135deg, #295a8d 0%, #142e48 100%);
                                             border: none; animation: fadeInDown 1s ease-out; text-transform: uppercase; font-style: italic;">
                                    {{ $slide['service'] }}
                                </span>
                                <h1 class="display-3 fw-bold text-white mb-4"
                                    style="text-shadow: 3px 3px 10px rgba(0,0,0,0.8); animation: fadeInLeft 1.2s ease-out;
                                           font-size: 4rem; line-height: 1.2;">
                                    {{ $slide['title'] }}
                                </h1>
                                <p class="lead text-white mb-5"
                                   style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8); font-size: 1.5rem; font-style: italic; font-weight:bold;
                                          animation: fadeInLeft 1.5s ease-out;">
                                    {{ $slide['subtitle'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev" style="width: 80px;">
            <div style="background: rgba(102, 126, 234, 0.7); width: 60px; height: 60px; border-radius: 50%;
                        display: flex; align-items: center; justify-content: center; transition: all 0.3s;"
                 onmouseover="this.style.background='rgba(102, 126, 234, 1)'; this.style.transform='scale(1.1)'"
                 onmouseout="this.style.background='rgba(102, 126, 234, 0.7)'; this.style.transform='scale(1)'">
                <i class="fas fa-chevron-left text-white" style="font-size: 1.8rem;"></i>
            </div>
        </a>
        <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next" style="width: 80px;">
            <div style="background: rgba(102, 126, 234, 0.7); width: 60px; height: 60px; border-radius: 50%;
                        display: flex; align-items: center; justify-content: center; transition: all 0.3s;"
                 onmouseover="this.style.background='rgba(102, 126, 234, 1)'; this.style.transform='scale(1.1)'"
                 onmouseout="this.style.background='rgba(102, 126, 234, 0.7)'; this.style.transform='scale(1)'">
                <i class="fas fa-chevron-right text-white" style="font-size: 1.8rem;"></i>
            </div>
        </a>

        {{-- Floating Booking Form (Hidden on Mobile) --}}
        <div class="position-absolute d-none d-md-block" style="bottom: 212px; left: 52%; right: 10%; z-index: 100;">
            <div class="container" style="max-width: 1200px;">
                <div class="card shadow-lg border-0" style="border-radius: 20px; backdrop-filter: blur(10px);
                                                             background: rgba(255, 255, 255, 0.95); animation: fadeInUp 1.8s ease-out;">
                    <div class="card-body p-4">
                        <h4 class="mb-4 text-center" style="color: #295a8d; font-weight: bold;">
                            <i class="fas fa-map-marked-alt"></i> Book Your Ride Now
                        </h4>
                        <div class="row">
                            <div class="col-md-12">
                                @if(session()->has('error'))
                                    <div class="alert alert-danger" >{{session('error')}}</div>
                                @endif
                                @error('location')
                                    <span class="text-danger" style="color:red"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span>
                                @enderror
                                <div class="form-group position-relative">
                                    <label class="fw-semibold"><i class="fas fa-map-marker-alt text-primary"></i> Pick-up Location</label>
                                    <input type="text" wire:model.live.debounce.500ms="location"
                                           class="form-control form-control-md" placeholder="Enter your location"
                                           style="border-radius: 10px; border: 1px solid gray">
                                    @if(count($suggestionsLocation) > 0)
                                        <ul class="list-group position-absolute w-100" style="z-index: 1000; max-height: 200px; overflow-y: auto; border-radius: 10px; margin-top: 5px;">
                                            @foreach($suggestionsLocation as $suggestion1)
                                                <li class="list-group-item list-group-item-action"
                                                    wire:click="selectSuggestion('location', '{{ $suggestion1['description'] }}')"
                                                    style="cursor: pointer;">
                                                    <i class="fas fa-map-pin text-muted"></i> {{ $suggestion1['description'] }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                @error('destination')
                                    <span class="text-danger" style="color:red"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span>
                                @enderror
                                <div class="form-group position-relative">
                                    <label class="fw-semibold"><i class="fas fa-map-marked text-success text-primary"></i> Drop-off Destination</label>
                                    <input type="text" wire:model.live.debounce.500ms="destination"
                                           class="form-control form-control-md" placeholder="Enter your destination"
                                           style="border-radius: 10px; border: 1px solid gray">
                                    @if(count($suggestionsDestination) > 0)
                                        <ul class="list-group position-absolute w-100" style="z-index: 1000; max-height: 200px; overflow-y: auto; border-radius: 10px; margin-top: 5px;">
                                            @foreach($suggestionsDestination as $suggestion2)
                                                <li class="list-group-item list-group-item-action"
                                                    wire:click="selectSuggestion('destination', '{{ $suggestion2['description'] }}')"
                                                    style="cursor: pointer;">
                                                    <i class="fas fa-map-pin text-muted"></i> {{ $suggestion2['description'] }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 d-flex align-items-end">
                                @if(Auth::check())
                                    <button wire:click="redirectToResults" class="btn btn-lg w-100"
                                            style="background: linear-gradient(135deg, #295a8d 0%, #142e48 100%);
                                                   color: white; border: none; border-radius: 10px; font-weight: bold;
                                                   transition: all 0.3s;"
                                            onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 20px rgba(102, 126, 234, 0.4)'"
                                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                        <i class="fas fa-search"></i> Search
                                    </button>
                                @else
                                    <a href="/login" class="btn btn-lg w-100"
                                       style="background: linear-gradient(135deg, #295a8d 0%, #142e48 100%);
                                              color: white; border: none; border-radius: 10px; font-weight: bold;">
                                        <i class="fas fa-sign-in-alt"></i> Login to Book
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Mobile Booking Form (Visible only on Mobile) --}}
    <div class="container d-block d-md-none py-4">
        <div class="card shadow-lg border-0" style="border-radius: 20px; background: rgba(255, 255, 255, 0.95);">
            <div class="card-body p-4">
                <h4 class="mb-4 text-center" style="color: #295a8d; font-weight: bold;">
                    <i class="fas fa-map-marked-alt"></i> Book Your Ride Now
                </h4>
                <div class="row">
                    <div class="col-12 mb-3">
                        @if(session()->has('error'))
                            <div class="alert alert-danger">{{session('error')}}</div>
                        @endif
                        @error('location')
                            <span class="text-danger" style="color:red"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                        <div class="form-group position-relative">
                            <label class="fw-semibold"><i class="fas fa-map-marker-alt text-primary"></i> Pick-up Location</label>
                            <input type="text" wire:model.live.debounce.500ms="location"
                                   class="form-control form-control-md" placeholder="Enter your location"
                                   style="border-radius: 10px; border: 1px solid gray">
                            @if(count($suggestionsLocation) > 0)
                                <ul class="list-group position-absolute w-100" style="z-index: 1000; max-height: 200px; overflow-y: auto; border-radius: 10px; margin-top: 5px;">
                                    @foreach($suggestionsLocation as $suggestion1)
                                        <li class="list-group-item list-group-item-action"
                                            wire:click="selectSuggestion('location', '{{ $suggestion1['description'] }}')"
                                            style="cursor: pointer;">
                                            <i class="fas fa-map-pin text-muted"></i> {{ $suggestion1['description'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        @error('destination')
                            <span class="text-danger" style="color:red"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                        <div class="form-group position-relative">
                            <label class="fw-semibold"><i class="fas fa-map-marked text-success"></i> Drop-off Destination</label>
                            <input type="text" wire:model.live.debounce.500ms="destination"
                                   class="form-control form-control-md" placeholder="Enter your destination"
                                   style="border-radius: 10px; border: 1px solid gray">
                            @if(count($suggestionsDestination) > 0)
                                <ul class="list-group position-absolute w-100" style="z-index: 1000; max-height: 200px; overflow-y: auto; border-radius: 10px; margin-top: 5px;">
                                    @foreach($suggestionsDestination as $suggestion2)
                                        <li class="list-group-item list-group-item-action"
                                            wire:click="selectSuggestion('destination', '{{ $suggestion2['description'] }}')"
                                            style="cursor: pointer;">
                                            <i class="fas fa-map-pin text-muted"></i> {{ $suggestion2['description'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="col-12">
                        @if(Auth::check())
                            <button wire:click="redirectToResults" class="btn btn-lg w-100"
                                    style="background: linear-gradient(135deg, #295a8d 0%, #142e48 100%);
                                           color: white; border: none; border-radius: 10px; font-weight: bold;
                                           transition: all 0.3s;"
                                    onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 20px rgba(102, 126, 234, 0.4)'"
                                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                <i class="fas fa-search"></i> Search
                            </button>
                        @else
                            <a href="/login" class="btn btn-lg w-100"
                               style="background: linear-gradient(135deg, #295a8d 0%, #142e48 100%);
                                      color: white; border: none; border-radius: 10px; font-weight: bold;">
                                <i class="fas fa-sign-in-alt"></i> Login to Book
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Services Section with Scroll Animations --}}
    <div class="container py-5" style="margin-top: 80px;">
        <div class="text-center mb-5 scroll-animate">
            <h2 class="display-4 fw-bold" style="color: #295a8d;">Our Premium Services</h2>
            <p class="lead text-muted">Discover luxury transportation solutions tailored to your needs</p>
            <div style="width: 100px; height: 4px; background: linear-gradient(135deg, #295a8d 0%, #142e48 100%); margin: 20px auto; border-radius: 2px;"></div>
        </div>

        <div class="row g-4">
            <div class="col-md-4 scroll-animate" data-delay="0">
                <div class="card h-100 border-0 shadow-lg" style="border-radius: 20px; transition: all 0.3s; overflow: hidden;"
                     onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.15)'"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.1)'">
                    <div class="position-relative" style="height: 200px; background: linear-gradient(135deg, #295a8d 0%, #142e48 100%); display: flex; align-items: center; justify-content: center;">
                        <img src="{{asset('img/service1.png')}}" alt="Car Rental" style="max-height: 140px; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.3));">
                    </div>
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3" style="color: #295a8d;"><i class="fas fa-car"></i> Car Rental</h4>
                        <p class="text-muted">Enjoy the freedom of the road with our flexible car rental services. Choose from a diverse fleet of vehicles tailored to your needs, whether for daily errands, business trips, or extended travels.</p>
                        <a href="/listing" class="btn btn-outline-primary btn-sm mt-2" style="border-radius: 20px;">
                            Explore Fleet <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 scroll-animate" data-delay="200">
                <div class="card h-100 border-0 shadow-lg" style="border-radius: 20px; transition: all 0.3s; overflow: hidden;"
                     onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.15)'"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.1)'">
                    <div class="position-relative" style="height: 200px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); display: flex; align-items: center; justify-content: center;">
                        <img src="{{asset('img/service2.png')}}" alt="Ride Booking" style="max-height: 140px; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.3));">
                    </div>
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3" style="color: #f5576c;"><i class="fas fa-taxi"></i> Ride Booking</h4>
                        <p class="text-muted">Book rides seamlessly with our reliable and efficient service. From quick pickups to scheduled journeys, we ensure timely and comfortable transportation every time.</p>
                        <a href="/listing" class="btn btn-outline-danger btn-sm mt-2" style="border-radius: 20px;">
                            Book Now <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 scroll-animate" data-delay="400">
                <div class="card h-100 border-0 shadow-lg" style="border-radius: 20px; transition: all 0.3s; overflow: hidden;"
                     onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.15)'"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.1)'">
                    <div class="position-relative" style="height: 200px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); display: flex; align-items: center; justify-content: center;">
                        <img src="{{asset('img/service3.png')}}" alt="Entertainment" style="max-height: 140px; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.3));">
                    </div>
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3" style="color: #00f2fe;"><i class="fas fa-glass-cheers"></i> Entertainment</h4>
                        <p class="text-muted">We keep you entertained throughout your event, be it birthday, prom, bachelor's party, wedding anniversary and all of your celebrations.</p>
                        <a href="/entertainment-listing" class="btn btn-outline-info btn-sm mt-2" style="border-radius: 20px;">
                            View Services <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    {{-- CSS Animations --}}
    <style>
        /* Apply Open Sans to all text */
        h1, h2, h3, h4, h5, h6, p, span, label, a, button, input, select, textarea, .lead, .display-1, .display-2, .display-3, .display-4 {
            font-family: 'Open Sans', sans-serif !important;
        }

        /* Make all headings bold */
        h1, h2, h3, h4, h5, h6, .display-1, .display-2, .display-3, .display-4 {
            font-weight: 700 !important;
        }

        @keyframes zoomIn {
            from { transform: scale(1.2); }
            to { transform: scale(1); }
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .scroll-animate {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease-out;
        }

        .scroll-animate.active {
            opacity: 1;
            transform: translateY(0);
        }

        .carousel-fade .carousel-item {
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
        }

        .carousel-fade .carousel-item.active {
            opacity: 1;
        }
    </style>

    {{-- JavaScript for Scroll Animations --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize carousel
            if (typeof jQuery !== 'undefined') {
                jQuery('#heroCarousel').carousel({
                    interval: 5000,
                    ride: 'carousel',
                    pause: 'hover'
                });
            }

            // Scroll animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -100px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const delay = entry.target.getAttribute('data-delay') || 0;
                        setTimeout(() => {
                            entry.target.classList.add('active');
                        }, delay);
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.scroll-animate').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
</div>
