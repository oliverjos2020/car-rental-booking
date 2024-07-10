
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
        @if(Auth::user()->role_id == 4)
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
                </div>
        @elseif(Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
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
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Notifications</h4>
                            <div class="table-responsive">
                                <table class="table table-nowrap table-centered mb-0">
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
                                                <h5 class="text-truncate font-size-14 m-0"><a href="#" class="text-reset">Your {{$vehicle->vehicleMake}} | {{$vehicle->vehicleModel}} is under review</a></h5>
                                            </td>
                                            <td>
                                               
                                                            <span class=" text-dark">
                                                                <i class="fa fa-car"></i> {{$vehicle->transmission}}
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
            </div>
            
        @elseif(Auth::user()->role_id == 1)
            <div class="row">
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
                                    <p class="mb-2">Transaction Vehicle Approved</p>
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
        @endif
