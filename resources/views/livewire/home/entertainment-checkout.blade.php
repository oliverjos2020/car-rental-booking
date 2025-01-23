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

                            {{-- <table class="b-goods-f__table table table-striped table-bordered" style="text-align:left">

                                @forelse($orders as $order)
                                    <thead>
                                        <tr style="font-weight:bold">
                                            <th>Event</th>
                                            <th>Address</th>
                                            <th>Date</th>
                                            <th>Hours</th>
                                            <th>No of Stops</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$order->event}}</td>

                                            <td>{{$order->address}}</td>

                                            <td>{{$order->entertainment_date}}</td>

                                            <td>{{$order->hours}}</td>

                                            <td>{{$order->no_of_stops}}</td>
                                        </tr>


                                                    @php
                                                        $menus = json_decode($order->selectedMenus, true)
                                                        $totalAmount = 0;
                                                    @endphp
                                                    @forelse($menus as $menu)
                                                    <tr style="text-align:left !important">
                                                        <td colspan="1" style="text-align:left !important">
                                                            @php
                                                                $item = \App\Models\EntertainmentMenu::where('id', $menu)->pluck('item')->first();
                                                            @endphp
                                                            {{ $item }}
                                                        </td>
                                                        <td colspan="1" style="text-align:left !important">
                                                            @php
                                                            $amount = \App\Models\EntertainmentMenu::where('id', $menu)->pluck('amount')->first();
                                                            $chargePerHour = \App\Models\EntertainmentMenu::where('id', $menu)->pluck('charge_per_hour')->first();
                                                            @endphp
                                                            {{ $amount }} {{$chargePerHour == 1 ? ' (charged per hour)':''}}
                                                        </td>
                                                        <td>
                                                            @if($chargePerHour == 1)
                                                                = {{number_format($amount * $order->hours, 2)}}
                                                            @else
                                                                = {{$amount}}
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    @empty
                                                    @endforelse
                                                    <tr>
                                                        <td colspan="2" style="text-align:right;"> <strong>Total</strong></td>
                                                        <td>
                                                            @forelse($menus as $menu)
                                                                @php
                                                                    $amount = \App\Models\EntertainmentMenu::where('id', $menu)->pluck('amount')->first();
                                                                    $chargePerHour = \App\Models\EntertainmentMenu::where('id', $menu)->pluck('charge_per_hour')->first();

                                                                @endphp
                                                                    @if($chargePerHour == 1)
                                                                        {{$totalAmount += $amount * $order->hours}}
                                                                    @else
                                                                        {{$totalAmount += $amount}}
                                                                    @endif
                                                            @endforelse
                                                            {{$totalAmount}}
                                                        </td>
                                                    </tr>
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
                                    </tbody>
                                @empty
                                @endforelse
                            </table> --}}
                            @php
                                $overallTotal = 0;
                            @endphp
                                @forelse($orders as $order)
                                <table class="b-goods-f__table table table-striped table-bordered" style="text-align:left">
                                    <thead>
                                        <tr style="font-weight:bold">
                                            <th>Event</th>
                                            <th>Address</th>
                                            <th>Date</th>
                                            <th>Hours</th>
                                            <th>No of Stops</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $order->event }}</td>
                                            <td>{{ $order->address }}</td>
                                            <td>{{ $order->entertainment_date }}</td>
                                            <td>{{ $order->hours }}</td>
                                            <td>{{ $order->no_of_stops }}</td>
                                        </tr>

                                        @php
                                            $menus = json_decode($order->selectedMenus, true);
                                            $totalAmount = 0;
                                        @endphp

                                        @forelse($menus as $menu)
                                            @php
                                                $menuDetails = \App\Models\EntertainmentMenu::find($menu);
                                                $amount = $menuDetails->amount ?? 0;
                                                $chargePerHour = $menuDetails->charge_per_hour ?? 0;

                                                // Accumulate the total amount
                                                if ($chargePerHour == 1) {
                                                    $totalAmount += $amount * $order->hours;
                                                } else {
                                                    $totalAmount += $amount;
                                                }

                                            @endphp
                                            <tr style="text-align:left !important">
                                                <td colspan="1" style="text-align:left !important">
                                                    {{ $menuDetails->item ?? 'Unknown Item' }}
                                                </td>
                                                <td colspan="1" style="text-align:left !important">
                                                    {{ $amount }} {{ $chargePerHour == 1 ? ' (charged per hour)' : '' }}
                                                </td>
                                                <td>
                                                    @if($chargePerHour == 1)
                                                        = {{ number_format($amount * $order->hours, 2) }}
                                                    @else
                                                        = {{ $amount }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" style="text-align:center;">No menus selected</td>
                                            </tr>
                                        @endforelse

                                        <tr>
                                            <td colspan="2" style="text-align:right;"><strong>Total</strong></td>
                                            <td>{{ number_format($totalAmount, 2) }}</td>
                                            <td colspan="2"><button type="submit" style="background:tomato; color:white;"
                                                class="btn btn-danger btn-sm"
                                                wire:click="deleteOrder({{ $order->id }})">Delete</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                                @php
                                    $overallTotal +=$totalAmount;
                                @endphp
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align:center;">No orders found</td>
                                    </tr>
                                @endforelse


                        </div>
                    </section>
                    @if(count($orders) > 0)
                    <form method="GET" action="/processPaypalEntertainment/{{$overallTotal}}/">
                        @csrf
                        <input type="hidden" name="amount" value="{{$overallTotal}}">
                        <div class="text-right">
                            {{-- <a style="color:#fff" class="btn btn-secondary btn-sm mr-sm-2 mb-1 mb-sm-0"
                                href="/review/">Cancel</a> --}}
                            <button class="btn btn-primary btn-sm">Pay With Paypal ({{$overallTotal}})</button>
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
