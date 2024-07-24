<div>
    <div class="container text-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="ic text-primary fas fa-home"></i> Review</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Review</li>
            </ol>
        </nav>
    </div>
    
    <div class="b-steps d-none d-sm-block">
        <div class="container">
            <div class="b-steps__item">
                <button class="b-steps__btn bg-primary" type="button">1</button><span class="b-steps__info">Vehicle
                    Selection</span>
            </div>
            <div class="b-steps__item">
                <button class="b-steps__btn bg-primary" type="button">2</button><span class="b-steps__info">Add
                    Extras</span>
            </div>
            <div class="b-steps__item">
                <button class="b-steps__btn bg-primary" type="button">3</button><span class="b-steps__info">Review &
                    Book</span>
            </div>
        </div>
    </div>
    {{-- <div class="l-main-content"> --}}
    @if ($step == 1)
        <div class="container">
            <main>
                <section class="b-goods-f">
                    <div class="ui-subtitle">Vehicle Details</div>
                    <h1 class="ui-title text-uppercase">{{$vehicle->vehicleMake}} {{$vehicle->vehicleModel}}
                        {{$vehicle->vehicleYear}}</h1>
                    <div class="ui-decor bg-primary"></div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div wire:ignore class="b-goods-f__slider">
                                <div class="ui-slider-main js-slider-for" wire:ignore>
                                    
                                    @foreach($vehicle->photos as $photo)
                                    {{-- <img class="img-scale" src="{{asset($photo->image_path)}}"
                                        alt="{{$photo->image_path}}" /> --}}
                                    <img wire:key="image-{{ $photo->id }}" class="img-scale"
                                        src="{{asset($photo->image_path)}}" alt="{{$photo->image_path}}" />
                                    @endforeach
                                </div>
                                <div class="ui-slider-nav js-slider-nav">
                                    @foreach($vehicle->photos as $photo)
                                    {{-- <img class="img-scale" src="{{asset($photo->image_path)}}"
                                        alt="{{$photo->image_path}}" /> --}}
                                    <img wire:key="image-{{ $photo->id }}" class="img-scale"
                                        src="{{asset($photo->image_path)}}" alt="{{$photo->image_path}}" />
                                    @endforeach
                                </div>
                            </div>

                            <div class="b-goods-f-checks d-none d-sm-block">
                                <div class="b-goods-f-checks__section">
                                    <div class="b-goods-f-checks__title text-primary">Vehicle Category</div>
                                    <div class="row no-gutters justify-content-between">
                                        <div class="col-sm-auto">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-inputx" checked="checked" id="customCheck1"
                                                    type="checkbox" />
                                                <label class="custom-control-labelx"
                                                    for="customCheck1">{{$vehicle->priceSetup->item}} / day</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-auto b-goods-f-checks__price">${{
                                            number_format($vehicle->priceSetup->amount, 2, ',', '.') }}</div>
                                    </div>
                                </div>
                                <div class="b-goods-f-checks__section">
                                    <div class="b-goods-f-checks__title text-primary">Days of hire</div>
                                    <div class="row no-gutters justify-content-between">
                                        <div class="col-sm-auto">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-inputx" id="customCheck2"
                                                    type="checkbox" />
                                                <label class="custom-control-labelx" for="customCheck2">
                                                    <div wire:listen="daysCalculated">
                                                        <p id="days">{{ $days }} day(s)</p>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-auto b-goods-f-checks__price">${{ number_format($days *
                                            $vehicle->priceSetup->amount, 2, ',', '.')}} </div>
                                    </div>

                                </div>

                            </div>
                            
                        </div>
                        <div class="col-lg-4">
                            
                                <aside class="l-sidebar mt-4 mt-lg-0">
                                    <div class="widget section-sidebar bg-gray">
                                        <h3
                                            class="widget-title bg-dark row justify-content-between align-items-center no-gutters">
                                            <i class="ic flaticon-car-2 bg-primary col-auto"></i><span
                                                class="widget-title__inner col">Your Reservation</span>
                                        </h3>
                                        <div class="widget-content">
                                            <div class="widget-card">
                                                @if(auth()->check())
                                                <div class="widget-card-descr">
                                                    <div class="widget-card-descr__item">
                                                        <div class="widget-card-descr__title">Vehicle Pickup</div>
                                                        <div class="widget-card-descr__info">
                                                            {{$vehicle->location}} </div>
                                                    </div> 
                                                    <div class="widget-card-descr__item">
                                                        <div class="widget-card-descr__title">Vehicle Drop Off</div>
                                                        <div class="widget-card-descr__info">{{$vehicle->location}}</div>
                                                    </div>
                                                    <div class="widget-card-number no-gutter widget-card-descr__item">
                                                        <div class="b-filter__row">
                                                            <label for="pickupDate">Pick-up Date</label>
                                                            <input type="date" wire:model="pickupDate" min="{{ date('Y-m-d') }}"
                                                                placeholder="Pick-up date" class="review-input">
                                                                @error('pickupDate')
                                                                    <span style="color:red" class="text-danger"> {{ $message }} </span>
                                                                @enderror
                                                        </div>
                                                    </div>
                                                    <div class="widget-card-number no-gutter widget-card-descr__item">
                                                        <div class="b-filter__row">
                                                            <label for="pickupTime">Pick-up Time</label>
                                                            <input type="time" pattern="hh:mm a" wire:model="pickupTime" 
                                                                placeholder="Pick-up Time" class="review-input">
                                                                @error('pickupTime')
                                                                    <span style="color:red" class="text-danger"> {{ $message }} </span>
                                                                @enderror
                                                        </div>
                                                    </div>
                                                    <div class="widget-card-number no-gutter widget-card-descr__item">
                                                        <div class="b-filter__row">
                                                            <label for="dropOff Date">Drop-off Date</label>
                                                            <input type="date" wire:model="dropoffDate" min="{{ date('Y-m-d') }}"
                                                                placeholder="Drop-off date" class="review-input"
                                                                wire:click="calculate">
                                                                @error('dropoffDate')
                                                                    <span style="color:red" class="text-danger"> {{ $message }} </span>
                                                                @enderror
                                                        </div>
                                                    </div>
                                                    <div class="widget-card-number no-gutter widget-card-descr__item">
                                                        <div class="b-filter__row">
                                                            <label for="dropOffTime">Drop-off Time</label>
                                                            <input type="time" pattern="hh:mm a" wire:model="dropoffTime"
                                                                placeholder="Drop-off Time" class="review-input">
                                                                @error('dropoffTime')
                                                                    <span style="color:red" class="text-danger"> {{ $message }} </span>
                                                                @enderror
                                                        </div>
                                                    </div>
                                                    <div class="widget-card-number no-gutter widget-card-descr__item">
                                                        <div class="b-filter__row">
                                                            <label for="dropOffTime">Drivers License</label>
                                                            <input type="file" wire:model="driversLicense"
                                                            accept="image/jpg, image/jpeg, image/png" class="review-input">
                                                            <br>
                                                            {{-- @if ($driversLicense)
                                                                <img src="{{ $driversLicense->temporaryUrl() }}" class="image mt-3" style="max-width: 300px">
                                                            @endif --}}
                                                            @if ($driversLicense instanceof \Livewire\TemporaryUploadedFile)
                                                            <img src="{{ $driversLicense->temporaryUrl() }}" class="image mt-3" style="max-width: 300px">
                                                            @elseif ($existingdriversLicense)
                                                            <img src="{{ $existingdriversLicense }}" class="image mt-3" style="max-width: 300px">
                                                            @endif
                                                            <br>
                                                            @error('driversLicense')
                                                                    <span style="color:red" class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="widget-card-number no-gutter widget-card-descr__item">
                                                        <div class="b-filter__row">
                                                            <label for="dropOffTime">Insurance</label>
                                                            <input type="file" wire:model="insurance"
                                                            accept="image/jpg, image/jpeg, image/png" class="review-inputx">
                                                            <br>
                                                            {{-- @if ($insurance)
                                                                <img src="{{ $insurance->temporaryUrl() }}" class="image mt-3" style="max-width: 300px">
                                                            @endif --}}
                                                            @if ($insurance instanceof \Livewire\TemporaryUploadedFile)
                                                            <img src="{{ $insurance->temporaryUrl() }}" class="image mt-3" style="max-width: 300px">
                                                            @elseif ($existingInsurance)
                                                            <img src="{{ $existingInsurance }}" class="image mt-3" style="max-width: 300px">
                                                            @endif
                                                            <br>
                                                            @error('insurance')
                                                                    <span style="color:red" class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <a style="color:#fff" class="btn btn-primary text-light btn-lg d-none d-sm-block" wire:click="proceed"> Proceed</a>
                                                @else
                                                <a style="color:#fff" class="btn btn-primary text-light btn-lg d-none d-sm-block" href="/login"> Login to continue</a>
                                                @endif
                                                {{-- <br> --}}
                                                {{-- <div id="paypal-button-container" wire:ignore></div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="b-goods-f-checks d-md-none">
                                        <div class="b-goods-f-checks__section">
                                            <div class="b-goods-f-checks__title text-primary">Vehicle Category</div>
                                            <div class="row no-gutters justify-content-between">
                                                <div class="col-sm-auto">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-inputx" checked="checked" id="customCheck1"
                                                            type="checkbox" />
                                                        <label class="custom-control-labelx"
                                                            for="customCheck1">{{$vehicle->priceSetup->item}} / day</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-auto b-goods-f-checks__price">${{
                                                    number_format($vehicle->priceSetup->amount, 2, ',', '.') }}</div>
                                            </div>
                                        </div>
                                        <div class="b-goods-f-checks__section">
                                            <div class="b-goods-f-checks__title text-primary">Days of hire</div>
                                            <div class="row no-gutters justify-content-between">
                                                <div class="col-sm-auto">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-inputx" checked="checked" id="customCheck1"
                                                            type="checkbox" />
                                                        <label class="custom-control-labelx" for="customCheck2">
                                                            <div wire:listen="daysCalculated">
                                                                <p id="days">{{ $days }} day(s)</p>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-auto b-goods-f-checks__price">${{ number_format($days *
                                                    $vehicle->priceSetup->amount, 2, ',', '.')}} </div>
                                            </div>
        
                                        </div>
                                        
                                        @if(auth()->check())
                                        <a style="color:#fff" class="btn btn-primary btn-lg d-sm-none" wire:click="proceed"> Proceed</a>
                                        @else
                                        <a style="color:#fff" class="btn btn-primary btn-lg d-sm-none" href="/login">Login to proceed</a>
                                        @endif
                                    </div>
                                </aside>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            
                        </div>

                    </div>
                </section>
            </main>
        </div>
    {{-- @elseif ($step == 2) --}}
        <div class="container" style="margin-bottom:30px;">
            <main>
                <div class="row">
                    <div class="col-md-12">
                        <section class="b-goods-f__section">
                            <h2 class="b-goods-f__title2">Pricing Details</h2>
                            <div class="table-responsive">
                            <table class="b-goods-f__table table table-bordered">
                                <thead>
                                <tr>
                                    <th>Vehicle</th>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>Year</th>
                                    <th>Pickup/Dropoff Location</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="{{asset('img/cars/c8.jpg')}}" style="max-height: 80px">
                                        </td>
                                        <td>
                                            {{$vehicle->vehicleMake}}
                                        </td>
                                        <td>
                                            {{$vehicle->vehicleModel}}
                                        </td>
                                        <td>
                                            {{$vehicle->vehicleYear}}
                                        </td>
                                        <td>
                                            {{$vehicle->location}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><strong>Pickup date {{$pickupDate}} {{$pickupTime}}</strong></td>
                                        <td colspan="2"><strong>Dropoff date {{$dropoffDate}} {{$dropoffTime}}</strong></td>
                                        <td><strong>Location: {{$vehicle->location}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><strong>Category: {{$vehicle->priceSetup->item}} </strong></td>
                                        <td colspan="2"><strong>Days of hire: {{ $days }} </strong></td>
                                        <td><strong>Total Amount: ${{ number_format($days * $vehicle->priceSetup->amount, 2, ',', '.')}} </strong></td>
                                    </tr>
                                {{-- <tr>
                                    <td>1 Day @ $145 / Day $145</td>
                                    <td>$145</td>
                                </tr>
                                <tr>
                                    <td>Special Rate Discount  -$5</td>
                                    <td>-$5</td>
                                </tr>
                                <tr>
                                    <td>Unlimited Miles  Free</td>
                                    <td>Free</td>
                                </tr>
                                <tr>
                                    <td>Environmental Surcharge  $9.10</td>
                                    <td>$9.10</td>
                                </tr>
                                <tr>
                                    <td>Processing Fee $4.06</td>
                                    <td>$4.06</td>
                                </tr>
                                <tr>
                                    <td>Roadside Assistance</td>
                                    <td>$9.98</td>
                                </tr>
                                <tr>
                                    <td>1 Day @ $9.98 / Day  $9.98</td>
                                    <td>$10.00</td>
                                </tr>
                                <tr>
                                    <td>Helmet Rental - Full Face Type</td>
                                    <td>Free</td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td>total (USD)</td>
                                    <td>$402</td>
                                </tr> --}}
                                </tfoot>
                            </table>
                            </div>
                        </section>
                        <div class="text-right"><a style="color:#fff" class="btn btn-secondary btn-lg mr-sm-2 mb-1 mb-sm-0" href="/review/{{$reviewId}}">Cancel</a><a class="btn btn-primary btn-lg" href="#">checkout<i class="ic-r fas fa-chevron-right"></i></a></div>
                        </div>
                        <form id="payment-form" wire:submit.prevent="createOrder">
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="text" id="amount" wire:model="amount" value="500" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Pay with PayPal</button>
                        </form>
                        <div id="paypal-button-container"></div>

    <script src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.client_id') }}&components=buttons,hosted-fields&currency=USD"></script>
                </div>
            </main>
        </div>
    @endif
</div>
{{-- <script src="https://www.paypal.com/sdk/js?client-id=AYhy25KmTjDNZDCvrmriP4PfzNf1xY939tywQcyG90wOETn_OnZ_ef9nCGlOwNABLWzclfJRkIHOGOk8&components=buttons,funding-eligibility"></script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script>
    $(document).ready(function() {
        $('#payment-form').on('submit', function(event) {
            event.preventDefault();

            var amount = $('#amount').val();
            $.ajax({
                url: "{{ route('createOrder') }}",
                method: "POST",
                data: { amount: amount },
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                success: function(data) {
                    paypal.HostedFields.render({
                        createOrder: function() {
                            return data.id;
                        },
                        styles: {
                            'input': {
                                'font-size': '16px',
                                'color': '#3A3A3A'
                            },
                            '.valid': {
                                'color': '#0C0'
                            },
                            '.invalid': {
                                'color': '#C00'
                            }
                        },
                        fields: {
                            number: {
                                selector: '#card-number',
                                placeholder: '4111 1111 1111 1111'
                            },
                            cvv: {
                                selector: '#cvv',
                                placeholder: '123'
                            },
                            expirationDate: {
                                selector: '#expiration-date',
                                placeholder: 'MM/YY'
                            }
                        },
                        onApprove: function(data, actions) {
                            return actions.order.capture().then(function(details) {
                                $.ajax({
                                    url: "{{ route('onApprove') }}",
                                    method: "POST",
                                    data: details,
                                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                    success: function() {
                                        alert('Payment successful!');
                                    }
                                });
                            });
                        }
                    }).then(function(hostedFieldsInstance) {
                        $('#submit').on('click', function(event) {
                            event.preventDefault();
                            hostedFieldsInstance.submit({
                                // Optional fields you may include with your submit call
                                cardholderName: $('#card-holder-name').val()
                            });
                        });
                    });
                }
            });
        });
    });
</script> --}}
<script>
    $(document).ready(function() {
        $('#payment-form').on('submit', function(event) {
            event.preventDefault();

            var amount = $('#amount').val();
            // Ensure the amount is a valid numeric value
            if (isNaN(amount) || amount <= 0) {
                alert('Please enter a valid amount.');
                return;
            }

            $.ajax({
                url: "{{ route('createOrder') }}",
                method: "POST",
                data: { amount: amount },
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                success: function(data) {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        var paymentId = data.id;

                        // Get the client token
                        $.ajax({
                            url: "{{ route('paypal.clientToken') }}",
                            method: "GET",
                            success: function(data) {
                                if (data.error) {
                                    alert(data.error);
                                } else {
                                    var clientToken = data.client_token;

                                    paypal.HostedFields.render({
                                        createOrder: function() {
                                            return paymentId;
                                        },
                                        styles: {
                                            'input': {
                                                'font-size': '16px',
                                                'color': '#3A3A3A'
                                            },
                                            '.valid': {
                                                'color': '#0C0'
                                            },
                                            '.invalid': {
                                                'color': '#C00'
                                            }
                                        },
                                        fields: {
                                            number: {
                                                selector: '#card-number',
                                                placeholder: '4111 1111 1111 1111'
                                            },
                                            cvv: {
                                                selector: '#cvv',
                                                placeholder: '123'
                                            },
                                            expirationDate: {
                                                selector: '#expiration-date',
                                                placeholder: 'MM/YY'
                                            }
                                        },
                                        onApprove: function(data, actions) {
                                            return actions.order.capture().then(function(details) {
                                                $.ajax({
                                                    url: "{{ route('onApprove') }}",
                                                    method: "POST",
                                                    data: details,
                                                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                                    success: function() {
                                                        alert('Payment successful!');
                                                    }
                                                });
                                            });
                                        }
                                    }).then(function(hostedFieldsInstance) {
                                        $('#submit').on('click', function(event) {
                                            event.preventDefault();
                                            hostedFieldsInstance.submit({
                                                // Optional fields you may include with your submit call
                                                cardholderName: $('#card-holder-name').val()
                                            });
                                        });
                                    });
                                }
                            }
                        });
                    }
                }
            });
        });
    });
</script>