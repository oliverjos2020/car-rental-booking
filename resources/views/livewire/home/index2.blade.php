<div>
    <div class="row" style="background:black; height:100vh">
        <div class="col-md-6" style="display: flex; align-items: center;">
            <div class="container p-4" style="max-width:450px; margin:0 auto; margin-top:0px;">
                <h2 class="text-light">
                    Experience luxury rides with D’Presidential Luxxetour
                </h2>
                <div>
                    @if(session()->has('error'))
                        <div class="text-danger" style="color:red!important">{{session('error')}}</div>
                    @endif
                    @error('location')
                        <span class="text-danger" style="color:red!important"> {{ $message }}</span>
                    @enderror
                    <div class="input-group mb-3">
                            <span class="input-group-text input-group-text-right">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                            </span>
                            <input type="text" id="location" wire:model.live.debounce.500ms="location"
                                class="form-control my-form-control" placeholder="Enter Location"
                                aria-label="Amount (to the nearest dollar)">
                            <span class="input-group-text input-group-text-left">
                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                            </span>



                        @if(count($suggestionsLocation) > 0)
                        <ul class="my-show-location">
                            @endif

                            @foreach($suggestionsLocation as $suggestion1)
                            <li wire:click="selectSuggestion('location', '{{ $suggestion1['description'] }}')">
                                {{ $suggestion1['description'] }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @if(session()->has('error'))
                        <div class="text-danger" style="color:red!important">{{session('error')}}</div>
                        @endif
                        @error('destination')
                        <span class="text-danger" style="color:red!important"> {{ $message }}</span>
                        @enderror
                    <div class="input-group mb-3">
                            <span class="input-group-text input-group-text-right">
                                <i class="fa fa-map" aria-hidden="true"></i>
                            </span>
                            <input type="text" id="location" wire:model.live.debounce.500ms="destination"
                                class="form-control my-form-control" placeholder="Your Destination">



                        @if(count($suggestionsDestination) > 0)
                        <ul class="my-show-location">
                            @endif
                            @foreach($suggestionsDestination as $suggestion2)
                            <li wire:click="selectSuggestion('destination', '{{ $suggestion2['description'] }}')">
                                {{ $suggestion2['description'] }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>


                @if(Auth::check())
                <a wire:click="redirectToResults" class="my-btn-light" style="border-radius:5px; cursor:pointer; padding:12px 25px;">Book
                    Ride</a>
                @else
                <a href="/login" class="my-btn-light" style="border-radius:5px; cursor:pointer; padding:12px 25px;">Book Ride</a>
                @endif
            </div>
        </div>
        <div class="col-md-6 d-none d-lg-block get-items-centered">
            <div style="padding:35px;">
                <img src="{{asset('img/home-img.jpg')}}" alt="home-image" style="max-height:300px;">
            </div>

        </div>
    </div>
    <div class="row" style="padding: 2rem;">
        <div class="col-md-12">
            <h3>Our Services</h3>
        </div>
        <div class="col-md-4">
            <div class="card service-card">
                <div class="row">
                    <div class="col-md-7">
                        <h6>Car Rental</h6>
                        <div style="margin-bottom:15px; text-align:left" class="text">Enjoy the freedom of the road with our flexible car rental services. Choose from a diverse fleet of vehicles tailored to your needs, whether for daily errands, business trips, or extended travels.</div>
                        {{-- <a>More</a> --}}
                    </div>
                    <div class="col-md-4 get-items-centered">
                        <img src="{{asset('img/service1.png')}}" alt="home-image" style="max-height:130px;">
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="card service-card">
                <div class="row">
                    <div class="col-md-7">
                        <h6>Car Booking</h6>
                        <div style="margin-bottom:15px;" class="text">Book rides seamlessly with our reliable and efficient service. From quick pickups to scheduled journeys, we ensure timely and comfortable transportation every time.</div>
                        {{-- <a>More</a> --}}
                    </div>
                    <div class="col-md-4 get-items-centered">
                        <img src="{{asset('img/service2.png')}}" alt="home-image" style="max-height:130px;">
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="card service-card">
                <div class="row">
                    <div class="col-md-7">
                        <h6>Entertainment</h6>
                        <div style="margin-bottom:15px;" class="text">We keep you entertained throughout your event, be it birthday, prom, bachelor’s party, wedding anniversary and all of your celebrations.</div>
                        {{-- <a>More</a> --}}
                    </div>
                    <div class="col-md-4 get-items-centered">
                        <img src="{{asset('img/service3.png')}}" alt="home-image" style="max-height:130px;">
                    </div>
                </div>

            </div>
        </div>

    </div>
    {{-- <div class="row">
        <div class="col-md-4" style="display: flex; align-items: center; justify-content:center;">
            <div class="container card p-4" style="max-width:400px; margin:0 auto; margin-top:0px;">
                <div>
                    @if(session()->has('error'))
                    <div class="text-danger">{{session('error')}}</div>
                    @endif
                    <label for="location">Your Location</label>
                    <input type="text" class="form-control" id="location" wire:model.live.debounce.500ms="location">
                    <ul>
                        @foreach($suggestionsLocation as $suggestion1)
                        <li wire:click="selectSuggestion('location', '{{ $suggestion1['description'] }}')">{{
                            $suggestion1['description'] }}</li>
                        @endforeach
                    </ul>

                </div>

                <div>
                    <label for="destination">Destination</label>
                    <input type="text" class="form-control" id="destination"
                        wire:model.live.debounce.500ms="destination">
                    <ul>
                        @foreach($suggestionsDestination as $suggestion2)
                        <li wire:click="selectSuggestion('destination', '{{ $suggestion2['description'] }}')">{{
                            $suggestion2['description'] }}</li>
                        @endforeach
                    </ul>
                </div>

                <button wire:click="redirectToResults" class="btn btn-primary">Book Ride</button>
            </div>
        </div>
        <div class="col-md-8">
            <div class="main-slider slider-pro" id="main-slider" data-slider-width="100%" data-slider-height="900px"
                data-slider-arrows="true" data-slider-buttons="false">
                <div class="sp-slides">
                    <!-- Slide 1-->
                    <div class="main-slider__slide sp-slide">
                        <img class="sp-image" src="{{asset('assets-ii/media/content/b-main-slider/bg-1.jpg')}}"
                            alt="slider" />
                        <div class="sp-layer" data-width="100%" data-show-transition="left" data-hide-transition="left"
                            data-show-duration="800" data-show-delay="400" data-hide-delay="400">
                            <div class="main-slider__slogan">Book or Hire a Vehicle</div>
                            <div class="main-slider__title">find your car</div>
                        </div>
                        <div class="sp-layer" data-width="100%" data-show-transition="down" data-hide-transition="top"
                            data-show-duration="1500" data-show-delay="800" data-hide-delay="400">
                            <img class="main-slider__figure-1 img-fluid"
                                src="{{asset('assets-ii/media/content/b-main-slider/fig-1.png')}}" alt="foto" />
                        </div>
                        <div class="sp-layer" data-width="100%" data-show-transition="left" data-hide-transition="left"
                            data-show-duration="800" data-show-delay="400" data-hide-delay="400">
                            <a class="main-slider__link" href="/listing">explore our inventory</a>
                        </div>
                    </div>
                </div>
                <div class="sp-slides">
                    <!-- Slide 1-->
                    <div class="main-slider__slide sp-slide">
                        <img class="sp-image" src="{{asset('assets-ii/media/content/b-main-slider/bg-1.jpg')}}"
                            alt="slider" />
                        <div class="sp-layer" data-width="100%" data-show-transition="left" data-hide-transition="left"
                            data-show-duration="800" data-show-delay="400" data-hide-delay="400">
                            <div class="main-slider__slogan">Book or Hire a Vehicle</div>
                            <div class="main-slider__title">find your car</div>
                        </div>
                        <div class="sp-layer" data-width="100%" data-show-transition="down" data-hide-transition="top"
                            data-show-duration="1500" data-show-delay="800" data-hide-delay="400"><img
                                class="main-slider__figure-1 img-fluid"
                                src="{{asset('assets-ii/media/content/b-main-slider/fig-1.png')}}" alt="foto" />
                        </div>
                        <div class="sp-layer" data-width="100%" data-show-transition="left" data-hide-transition="left"
                            data-show-duration="800" data-show-delay="400" data-hide-delay="400"><a
                                class="main-slider__link" href="/listing">explore our
                                inventory</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <div class="group-sections">
        <div class="container" style="margin-top:-80px">
            <div class="b-main-filter bg-primary">
                <div class="row align-items-center">
                    <div class="col-lg">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select wire:model="category" class="home-input is-invalid"
                                        title="Select Vehicle Type">
                                        <option value="">Choose Car Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->item}}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <span class="text-light"> {{ $message }} </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="home-input" wire:model="brand" title="Select Brand">
                                        <option value="">Choose Car Brand</option>
                                        @foreach($brands as $brand)
                                        <option value="{{$brand->brand}}">{{$brand->brand}}</option>
                                        @endforeach
                                    </select>
                                    @error('brand')
                                    <span class="text-light"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="home-input" wire:model="transmission">
                                        <option value="">Choose Transmission</option>
                                        <option value="automatic">Automatic</option>
                                        <option value="manual">Manual</option>
                                    </select>
                                    @error('transmission')
                                    <span class="text-light"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-auto">
                        @if(auth()->check())
                        <button class="btn btn-secondary btn-lg ml-lg-3" wire:click.prevent="submitRequest"><i
                                class="ic icon-magnifier"></i> search</button>
                        @else
                        <a class="btn btn-secondary btn-lg ml-lg-3" href="/login"><i class="ic icon-magnifier"></i>
                            search</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- end .b-main-filter-->


    </div> --}}
</div>
