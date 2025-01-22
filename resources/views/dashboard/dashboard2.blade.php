
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Dashboard</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Welcome to D’PRESIDENTIAL LUXXETOUR Dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        @if(Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
                <div class="row h-25">
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <div class="row justify-content-end">
                                    <div class="col-7">
                                        <div class="text-dark-50">
                                            <h4 class="text-dark"><strong>Register Your Car for Rentals</strong></h4>
                                        </div>
                                        <h6>Car Rental</h6>
                                        <div>
                                            <a href="/registration/new/rental" class="btn btn-outline-success btn-sm">View more</a>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="mt-4">
                                            <img src="assets/images/widget-img.png" alt="" class="img-fluid mx-auto d-block">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-primary">
                            <div class="card-body">
                                <div class="row justify-content-end">
                                    <div class="col-7">
                                        <div class="text-light-50">
                                            <h4 class="text-light"><strong>Register as a Ride Provider</strong></h4>
                                        </div>
                                        <h6 class="text-light">Car Booking</h6>
                                        <div>
                                            <a href="/registration/new/booking" class="btn btn-outline-light btn-sm">View more</a>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="mt-4">
                                            <img src="assets/images/widget-img.png" alt="" class="img-fluid mx-auto d-block">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-body">
                                <div class="row justify-content-end">
                                    <div class="col-7">
                                        <div class="text-dark-50">
                                            <h4 class="text-dark"><strong>Register Your Car for Entertainment</strong></h4>
                                        </div>
                                        <h6>Car Entertainment</h6>
                                        <div>
                                            <a href="/registration/new/entertainment" class="btn btn-outline-success btn-sm">View more</a>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="mt-4">
                                            <img src="assets/images/widget-img.png" alt="" class="img-fluid mx-auto d-block">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <p class="mb-2">Pending Booking Orders</p>
                                        <h4 class="mb-0" id="totalCollection">{{$orders->count()}}</h4>
                                    </div>
                                    <div class="col-4">
                                        <div class="text-end">
                                            <div>
                                                <!-- 2.06 % <i class="mdi mdi-arrow-up text-success ms-1"></i> -->
                                            </div>
                                            <div class="progress progress-sm mt-3">
                                                <div class="progress-bar" role="progressbar" style="width: 62%" aria-valuenow="62"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <p class="mb-2">Ongoing Booking Orders</p>
                                        <h4 class="mb-0" id="totalCount">{{$approvedRequest->count()}}</h4>
                                    </div>
                                    <div class="col-4">
                                        <div class="text-end">
                                            <div>
                                                <!-- 3.12 % <i class="mdi mdi-arrow-up text-success ms-1"></i> -->
                                            </div>
                                            <div class="progress progress-sm mt-3">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 78%"
                                                    aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <p class="mb-2">Completed Booking Trips</p>
                                        <h4 class="mb-0" id="totalSettlement">{{$completedTrips->count()}}</h4>
                                    </div>
                                    <div class="col-4">
                                        <div class="text-end">
                                            <div>
                                                <!-- 2.12 % <i class="mdi mdi-arrow-up text-success ms-1"></i> -->
                                            </div>
                                            <div class="progress progress-sm mt-3">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 75%"
                                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <p class="mb-2">Number of active vehicles</p>
                                        <h4 class="mb-0" id="totalSettlement">{{$partnerVehicles->count()}}</h4>
                                    </div>
                                    <div class="col-4">
                                        <div class="text-end">
                                            <div>
                                                <!-- 2.12 % <i class="mdi mdi-arrow-up text-success ms-1"></i> -->
                                            </div>
                                            <div class="progress progress-sm mt-3">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 75%"
                                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Vehicle Status</h4>
                            <div class="table-responsive">
                                <table class="table table-nowrap table-centered mb-0 table-striped table-bordered">
                                    <tbody>
                                        {{-- @if(Auth::user()->vehicle->status == 1) --}}
                                        @forelse(Auth::user()->vehicle as $vehicle)
                                        <tr>
                                            <td style="width: 60px;">
                                                <div class="form-check">
                                                    <i class="mdi mdi-bullseye-arrow me-2"></i>
                                                </div>
                                            </td>
                                            <td style="width:90px;">
                                                <h5 class="text-truncate font-size-14 m-0"><span class="text-truncate">Your {{$vehicle->vehicleMake}} | {{$vehicle->vehicleModel}} is  @if($vehicle->status == 1) Under Review @elseif($vehicle->status == 2) Approved @elseif($vehicle->status == 3) Declined @endif</span></h5>
                                            </td>
                                            <td>

                                                            <span class="text-truncate">
                                                              {{$vehicle->category->category}}
                                                            </span>

                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    @if($vehicle->status == 1)
                                                    <span class="badge rounded-pill bg-warning-subtle text-warning  font-size-11">
                                                        Under Review
                                                    </span>
                                                    @elseif($vehicle->status == 2)
                                                    <span class="badge rounded-pill bg-success-subtle text-success  font-size-11">
                                                        Approved
                                                    </span>
                                                    @elseif($vehicle->status == 3)
                                                    <span class="badge rounded-pill bg-danger-subtle text-danger  font-size-11"><strong>status</strong>: declined</span>
                                                    @endif
                                                </div>
                                            </td>
                                            @if($vehicle->status == 3)
                                            <td>

                                                <div class="text-center">
                                                    <a data-bs-toggle="modal" data-bs-target="#myModal" href="javascript:void()">
                                                        <span class="badge rounded-pill bg-danger-subtle text-danger  font-size-11">View Reason</span></a>
                                                </div>
                                                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title mt-0" id="myModalLabel">Reason for denial
                                                                </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5 class="font-size-16">{{$vehicle->reason}}</h5>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                                                                <a href="/registration/{{$vehicle->id}}/{{Auth::user()->role_id == 2 ? 'rental/': 'booking/'}}"
                                                                    class="btn btn-primary waves-effect waves-light">Edit
                                                                    Application Document</a>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                            </td>
                                            @elseif($vehicle->status == 2)
                                                @if($vehicle->category->category == 'Booking')
                                                <td class="text-center">
                                                    <a href="/start-ride/{{ $vehicle->id}}" class="btn btn-primary btn-sm">Start Ride</a>
                                                </td>
                                                @endif
                                            @endif
                                        </tr>
                                        @empty
                                        <div class="alert alert-info">No Notifications available at the moment</div>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">

                        <div class="card-body">
                            <h4 class="card-title mb-4">Active Orders</h4>
                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active show" id="experience" role="tabpanel">
                                    <div class="timeline-count mt-4">
                                        @forelse($orders as $order)
                                            <div class="row">
                                                <div class="timeline-box col-lg-12 col-md-4">
                                                    <div class="mb-5 mb-lg-0">
                                                        <div class="item-lable bg-danger rounded">
                                                            <p class="text-center text-white">{{$order->pickupDate}}</p>
                                                        </div>
                                                        <div class="timeline-line active">
                                                            <div class="dot bg-primary"></div>
                                                        </div>
                                                        <div class="vertical-line">
                                                            <div class="wrapper-line bg-light"></div>
                                                        </div>
                                                        <div class="bg-light p-4 rounded mx-3">
                                                            <h5>{{$order->vehicle->vehicleMake}} {{$order->vehicle->vehicleModel}} {{$order->vehicle->vehicleYear}}</h5>
                                                            <p class="text-muted mt-1 mb-0">Pickup Date: {{ $order->pickupDate}}</p>
                                                            <p class="text-muted mt-1 mb-0">Pickup / Drop of Time: {{ $order->pickupTime}} / {{ $order->dropoffTime}}</p>
                                                            <p class="text-muted mt-1 mb-0">pick Up / Drop off Location: {{ $order->vehicle->location}}</p>
                                                            <p class="text-muted mt-1 mb-0"><a href="/bookingOrder/pendingA" class="btn btn-primary btn-sm">View</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @empty
                                            <div class="alert alert-danger">No active booking orders yet</div>
                                        @endforelse


                                    </div>
                                </div>
                                <div class="tab-pane" id="revenue" role="tabpanel">
                                    <div id="revenue-chart" class="apex-charts mt-4" style="min-height: 315px;"><div id="apexchartsrslxgg65" class="apexcharts-canvas apexchartsrslxgg65" style="width: 0px; height: 300px;"><svg id="SvgjsSvg1459" width="0" height="300" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><foreignObject x="0" y="0" width="0" height="300"><div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml"></div></foreignObject><g id="SvgjsG1461" class="apexcharts-inner apexcharts-graphical"><defs id="SvgjsDefs1460"></defs></g></svg></div></div>
                                </div>
                                <div class="tab-pane" id="settings" role="tabpanel">

                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="firstname">First Name</label>
                                                <input type="text" class="form-control" id="firstname" placeholder="Enter first name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="lastname">Last Name</label>
                                                <input type="text" class="form-control" id="lastname" placeholder="Enter last name">
                                            </div>
                                        </div> <!-- end col -->
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="userbio">Bio</label>
                                                <textarea class="form-control" id="userbio" rows="4" placeholder="Write something..."></textarea>
                                            </div>
                                        </div> <!-- end col -->
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-0">
                                                <label class="form-label" for="useremail">Email Address</label>
                                                <input type="email" class="form-control" id="useremail" placeholder="Enter email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-0">
                                                <label class="form-label" for="userpassword">Password</label>
                                                <input type="password" class="form-control" id="userpassword" placeholder="Enter password">
                                            </div>
                                        </div> <!-- end col -->
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif(Auth::user()->role_id == 1)
        <div class="alert alert-info alert-dismissible fade show mb-0" role="alert">
            <i class="mdi mdi-alert-circle-outline me-2"></i> You have <strong>{{$pending->count()}}</strong> pending request waiting to be accepted. <a href="/vendorManagement/pending">View</a>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

            </button>
        </div>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <p class="mb-2">Total Users</p>
                                    <h4 class="mb-0" id="totalCollection">{{$users->count()}}</h4>
                                </div>
                                <div class="col-4">
                                    <div class="text-end">
                                        <div>
                                            <!-- 2.06 % <i class="mdi mdi-arrow-up text-success ms-1"></i> -->
                                        </div>
                                        <div class="progress progress-sm mt-3">
                                            <div class="progress-bar" role="progressbar" style="width: 62%" aria-valuenow="62"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <p class="mb-2">Total Vehicle Approved</p>
                                    <h4 class="mb-0" id="totalCount">{{$approved->count()}}</h4>
                                </div>
                                <div class="col-4">
                                    <div class="text-end">
                                        <div>
                                            <!-- 3.12 % <i class="mdi mdi-arrow-up text-success ms-1"></i> -->
                                        </div>
                                        <div class="progress progress-sm mt-3">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 78%"
                                                aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <p class="mb-2">Total Vehicle Pending</p>
                                    <h4 class="mb-0" id="totalSettlement">{{$pending->count()}}</h4>
                                </div>
                                <div class="col-4">
                                    <div class="text-end">
                                        <div>
                                            <!-- 2.12 % <i class="mdi mdi-arrow-up text-success ms-1"></i> -->
                                        </div>
                                        <div class="progress progress-sm mt-3">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 75%"
                                                aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="container" style="width:100%; height:400px;"></div>
            </div>
        @endif
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const chart = Highcharts.chart('container', {
                    chart: {
                        type: 'line'
                    },
                    title: {
                        text: 'Graphical Representations'
                    },
                    xAxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                            'Nov', 'Dec'
                        ]
                    },
                    // yAxis: {
                    //     title: {
                    //         text: 'Fruit eaten'
                    //     }
                    // },
                    series: [{
                        name: 'Users',
                        data: @json(array_values($usersChart))
                    }, {
                        name: 'Approved Vehicles ',
                        data: @json(array_values($approvedVehicleChart))
                    }, {
                        name: 'Pending Vehicles ',
                        data: @json(array_values($pendingVehicleChart))
                    }]
                });
            });
        </script>
