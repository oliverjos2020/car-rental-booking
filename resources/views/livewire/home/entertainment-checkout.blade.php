<div>
    <div class="section-title-page area-bg area-bg_dark area-bg_op_60">
        <div class="area-bg__inner">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md">
                        <h1 class="b-title-page">Checkout</h1>
                        <div class="ui-decor bg-primary"></div>
                    </div>
                    {{-- <div class="col-md-auto"><a class="b-title-page__btn bg-primary" href="#">Smarter Way to
                            Buy or
                            Sell
                            Cars</a>
                        </div> --}}
                </div>
            </div>
        </div>
    </div>
    @if(\Session::has('error'))
    <div class="text-center" style="text-align: center !important; background: #cc4040; color: #fff; padding: 5px;">
        {{ \Session::get('error') }}
    </div>
    {{ \Session::forget('error') }}
    @endif


    @if(\Session::has('success'))
    <div class="text-center" style="text-align: center !important; background: #40cc6c; color: #fff; padding: 5px;">
        {{ \Session::get('success') }}
    </div>
    {{ \Session::forget('success') }}
    @endif

    <div class="container text-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="ic text-primary fas fa-home"></i> Checkout</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </nav>
    </div>

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
                                        <th>Event</th>
                                        <th>Address</th>
                                        <th>Date</th>
                                        <th>Hours</th>
                                        <th>No of Stops</th>
                                        <th>Selected Items</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @forelse($orders as $order)
                                    <tbody>
                                        <tr>
                                            <td>{{$order->event}}</td>

                                            <td>{{$order->address}}</td>

                                            <td>{{$order->entertainment_date}}</td>

                                            <td>{{$order->hours}}</td>

                                            <td>{{$order->no_of_stops}}</td>

                                            <td>
                                                    @php
                                                        $menus = json_decode($order->selectedMenus, true)
                                                    @endphp
                                                    @forelse($menus as $menu)

                                                    @php
                                                    $item = \App\Models\EntertainmentMenu::where('id', $menu)->pluck('item')->first();
                                                    @endphp
                                                    {{ $item }}

                                                    @php
                                                    $amount = \App\Models\EntertainmentMenu::where('id', $menu)->pluck('amount')->first();
                                                    @endphp
                                                    ({{ $amount }}), <br>
                                                    @empty
                                                    @endforelse
                                                </td>

                                        {{-- @empty
                                        @endforelse --}}
                                            </td>

                                            <td>
                                                @php
                                                    $subtotal = $order->amount/$order->hours
                                                @endphp
                                                Selected Items ({{ $subtotal }}) * {{$order->hours}} hours = {{$order->amount}}
                                            </td>
                                            <td>
                                                <button type="submit" style="background:tomato; color:white;"
                                                class="btn btn-danger btn-sm"
                                                wire:click="deleteOrder({{ $order->id }})">Delete</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                @empty
                                @endforelse
                            </table>
                        </div>
                    </section>
                    @if(count($orders) > 0)
                    <form method="GET" action="/processPaypalEntertainment/{{$totalAmount}}/">
                        @csrf
                        <input type="hidden" name="amount" value="{{$totalAmount}}">
                        <div class="text-right">
                            {{-- <a style="color:#fff" class="btn btn-secondary btn-sm mr-sm-2 mb-1 mb-sm-0"
                                href="/review/">Cancel</a> --}}
                            <button class="btn btn-primary btn-sm">Pay With Paypal ({{$totalAmount}})</button>
                        </div>
                    </form>
                    @endif
                </div>


                <div id="paypal-button-container"></div>

                <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}"></script>
            </div>
        </main>
    </div>
</div>
{{-- <script
    src="https://www.paypal.com/sdk/js?client-id=AYhy25KmTjDNZDCvrmriP4PfzNf1xY939tywQcyG90wOETn_OnZ_ef9nCGlOwNABLWzclfJRkIHOGOk8&components=buttons,funding-eligibility">
</script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
