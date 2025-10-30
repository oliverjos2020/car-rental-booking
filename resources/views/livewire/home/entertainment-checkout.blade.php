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
                    {{-- Voucher Eligibility Notification - Show above pricing details --}}
                    @if(count($orders) > 0 && $totalAmounts > 200)
                        <div class="alert alert-success" role="alert" style="border-left: 5px solid #28a745;">
                            <h5 class="alert-heading"><i class="fas fa-gift"></i> Congratulations!</h5>
                            <p class="mb-2">Your order is over 200! You're eligible to use a voucher code.</p>
                            @if($eligibleVoucher)
                                <hr>
                                <p class="mb-1"><strong>Available Voucher:</strong> {{ $eligibleVoucher->voucher_name }} (Code: <strong class="text-primary">{{ $eligibleVoucher->voucher_code }}</strong>)</p>
                                <p class="mb-0">
                                    <small>
                                        <strong>Discount:</strong>
                                        @if($eligibleVoucher->discount_type === 'percentage')
                                            {{ $eligibleVoucher->discount_amount }}%
                                        @else
                                            ${{ number_format($eligibleVoucher->discount_amount, 2) }}
                                        @endif
                                    </small>
                                </p>
                            @endif
                        </div>
                    @endif

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
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0" style="color:#fff"><i class="fas fa-calendar-alt text-light"></i> Order Details</h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-borderless mb-3">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 20%;"><strong><i class="fas fa-glass-cheers"></i> Event:</strong></td>
                                                    <td>{{ $order->event }}</td>
                                                    <td style="width: 20%;"><strong><i class="fas fa-map-marker-alt"></i> Address:</strong></td>
                                                    <td>{{ $order->address }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong><i class="fas fa-calendar"></i> Date:</strong></td>
                                                    <td>{{ $order->entertainment_date }}</td>
                                                    <td><strong><i class="fas fa-clock"></i> Hours:</strong></td>
                                                    <td>{{ $order->hours }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong><i class="fas fa-map-signs"></i> No of Stops:</strong></td>
                                                    <td>{{ $order->no_of_stops }}</td>
                                                    <td colspan="2"></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <h6 class="mt-4 mb-3"><i class="fas fa-list"></i> Selected Items</h6>
                                        <table class="table table-hover table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th style="width: 40%;">Item</th>
                                                    <th style="width: 25%;">Rate</th>
                                                    <th style="width: 35%; text-align: right;">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
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
                                                            $itemTotal = $amount * $order->hours;
                                                            $totalAmount += $itemTotal;
                                                        } else {
                                                            $itemTotal = $amount;
                                                            $totalAmount += $amount;
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $menuDetails->item ?? 'Unknown Item' }}</td>
                                                        <td>
                                                            ${{ number_format($amount, 2) }}
                                                            @if($chargePerHour == 1)
                                                                <span class="badge badge-info">per hour</span>
                                                            @endif
                                                        </td>
                                                        <td style="text-align: right;">
                                                            @if($chargePerHour == 1)
                                                                ${{ number_format($amount, 2) }} × {{ $order->hours }} = <strong>${{ number_format($itemTotal, 2) }}</strong>
                                                            @else
                                                                <strong>${{ number_format($itemTotal, 2) }}</strong>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center text-muted">No menus selected</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <tfoot class="bg-light">
                                                <tr>
                                                    <td colspan="2" style="text-align: right;"><strong>Order Total:</strong></td>
                                                    <td style="text-align: right;"><strong class="text-primary" style="font-size: 1.2em;">${{ number_format($totalAmount, 2) }}</strong></td>
                                                </tr>
                                            </tfoot>
                                        </table>

                                        <div class="text-right mt-3">
                                            <button type="button" class="btn btn-danger btn-sm" wire:click="deleteOrder({{ $order->id }})">
                                                <i class="fas fa-trash"></i> Delete Order
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $overallTotal += $totalAmount;
                                @endphp
                                @empty
                                    <div class="alert alert-warning text-center">
                                        <i class="fas fa-info-circle"></i> No orders found
                                    </div>
                                @endforelse


                        </div>
                    </section>

                    {{-- Voucher Section --}}
                    @if(count($orders) > 0)
                        @if($totalAmounts > 200)
                            <section class="b-goods-f__section mt-4">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="mb-0"><i class="fas fa-ticket-alt"></i> Apply Voucher Code</h5>
                                    </div>
                                    <div class="card-body">
                                        @if($appliedVoucher)
                                            <div class="alert alert-info mb-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <strong><i class="fas fa-check-circle"></i> Applied Voucher:</strong> {{ $appliedVoucher->voucher_name }} ({{ $appliedVoucher->voucher_code }})
                                                        <br>
                                                        <strong>Discount:</strong> <span class="text-success">${{ number_format($voucherDiscount, 2) }}</span>
                                                    </div>
                                                    <button wire:click="removeVoucher" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-times"></i> Remove
                                                    </button>
                                                </div>
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <input
                                                        type="text"
                                                        wire:model="voucherCode"
                                                        class="form-control @error('voucherError') is-invalid @enderror"
                                                        placeholder="Enter voucher code (e.g., AMU6ZK0WO8)"
                                                        style="text-transform: uppercase;"
                                                    >
                                                    @if($voucherError)
                                                        <div class="invalid-feedback d-block">
                                                            <i class="fas fa-exclamation-circle"></i> {{ $voucherError }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-4">
                                                    <button
                                                        wire:click="applyVoucher"
                                                        class="btn btn-success btn-block"
                                                        wire:loading.attr="disabled"
                                                    >
                                                        <span wire:loading.remove wire:target="applyVoucher">
                                                            <i class="fas fa-check"></i> Apply
                                                        </span>
                                                        <span wire:loading wire:target="applyVoucher">
                                                            <i class="fas fa-spinner fa-spin"></i> Applying...
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </section>

                            {{-- Order Summary --}}
                            <section class="b-goods-f__section mt-4">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-info text-white">
                                        <h5 class="mb-0" ><i class="fas fa-receipt"></i> Order Summary</h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-borderless mb-0">
                                            <tr>
                                                <td style="font-size: 1.1em;"><strong>Subtotal:</strong></td>
                                                <td class="text-right" style="font-size: 1.1em;">${{ number_format($totalAmounts, 2) }}</td>
                                            </tr>
                                            @if($voucherDiscount > 0)
                                                <tr class="text-success">
                                                    <td style="font-size: 1.1em;"><strong><i class="fas fa-tag"></i> Voucher Discount:</strong></td>
                                                    <td class="text-right" style="font-size: 1.1em;">-${{ number_format($voucherDiscount, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><hr class="my-2"></td>
                                                </tr>
                                            @endif
                                            <tr class="bg-light">
                                                <td style="font-size: 1.3em;"><strong>Total Amount:</strong></td>
                                                <td class="text-right" style="font-size: 1.3em;"><strong class="text-primary">${{ number_format($finalAmount, 2) }}</strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </section>
                        @endif

                        <div class="card shadow-sm mt-4">
                            <div class="card-body text-center py-4">
                                <form method="GET" action="/processPaypalEntertainment/{{ $finalAmount }}/">
                                    @csrf
                                    <input type="hidden" name="amount" value="{{ $finalAmount }}">
                                    @if($appliedVoucher)
                                        <input type="hidden" name="voucher_code" value="{{ $appliedVoucher->voucher_code }}">
                                    @endif
                                    <button class="btn btn-primary btn-lg px-5" style="font-size: 1.2em;">
                                        <i class="fab fa-paypal"></i> Pay With PayPal - ${{ number_format($finalAmount, 2) }}
                                    </button>
                                    <p class="text-muted mt-3 mb-0">
                                        <small><i class="fas fa-lock"></i> Secure payment powered by PayPal</small>
                                    </p>
                                </form>
                            </div>
                        </div>
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
