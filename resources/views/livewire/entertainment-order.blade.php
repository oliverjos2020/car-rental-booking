<div>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">Booking Orders</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li> -->
                        <!-- <li class="breadcrumb-item active">Welcome to Tax Drive Dashboard</li> -->
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    {{-- <div class="alert alert-info alert-dismissible fade show mb-0" role="alert">
                        <i class="mdi mdi-alert-circle-outline me-2"></i> Kindly click on approve on any pending request to approve the order
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                        </button>
                    </div> --}}

                    <div class="row mt-2">
                        <div class="col-md-1">
                            <select name="limit" wire:model="limit" class="form-control form-control-sm mt-2">
                                <option value="10">10</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="500">500</option>
                            </select>
                        </div>
                        <div class="col-md-7"></div>
                        <div class="col-md-4">
                            <input type="search" wire:model.live.debounce.500ms="search" placeholder="Search by name..."
                                class="form-control form-control-sm mt-2">
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Name</th>
                                    <th>Event</th>
                                    <th>Address</th>
                                    <th>Amount</th>
                                    <th>Participants</th>
                                    <th>No of Stops</th>
                                    <th>Hours</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Payment Status</th>
                                    <th>Created</th>
                                    <th colspan="2">Requested Items</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    @php
                                        // Fetch all menu items and amounts for the order in one go
                                        $menus = collect(json_decode($order->selectedMenus, true));
                                        $menuItems = \App\Models\EntertainmentMenu::whereIn('id', $menus)->get(['item', 'amount']);
                                    @endphp
                                    <tr>
                                        <td>{{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->event }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>{{ $order->amount }}</td>
                                        <td>{{ $order->participants }}</td>
                                        <td>{{ $order->no_of_stops }}</td>
                                        <td>{{ $order->hours }}</td>
                                        <td>{{ $order->entertainment_date }}</td>
                                        <td>{{ $order->amount }}</td>
                                        <td>
                                            <span class="badge bg-{{ $order->payment_status == 1 ? 'success' : 'danger' }}">
                                                {{ $order->payment_status == 1 ? 'Paid' : 'Pending' }}
                                            </span>
                                        </td>

                                        <td>{{ $order->created_at }}</td>
                                        <td colspan="2">
                                            @forelse($menuItems as $menuItem)
                                                {{ $menuItem->item }} ({{ $menuItem->amount }}),<br>
                                            @empty
                                                No requested items
                                            @endforelse
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="13" class="text-center text-danger">No record available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="loader text-center">
                            <div class="my-2">
                                {{ $orders->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
