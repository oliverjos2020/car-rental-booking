<div>
    <div class="container text-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.html"><i class="ic text-primary fas fa-home"></i> Review</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Review</li>
            </ol>
        </nav>
    </div>
    <div class="b-steps">
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
                <button class="b-steps__btn bg-primary" type="button">3</button><span
                    class="b-steps__info">Review & Book</span>
            </div>
        </div>
    </div>
    <div class="l-main-content">
        <div class="container">
            <main>
                <section class="b-goods-f">
                    <div class="ui-subtitle">Vehicle Details</div>
                    <h1 class="ui-title text-uppercase">{{$vehicle->vehicleMake}} {{$vehicle->vehicleModel}} {{$vehicle->vehicleYear}}</h1>
                    <div class="ui-decor bg-primary"></div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="b-goods-f__slider">
                                <div class="ui-slider-main js-slider-for">
                                    @foreach($vehicle->photos as $photo)
                                    <img class="img-scale" src="{{asset($photo->image_path)}}" alt="{{$photo->image_path}}" />
                                    @endforeach
                                </div>
                                <div class="ui-slider-nav js-slider-nav">
                                    @foreach($vehicle->photos as $photo)
                                    <img class="img-scale" src="{{asset($photo->image_path)}}" alt="{{$photo->image_path}}" />
                                    @endforeach
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"><a class="b-goods-f__link-2 w-100" href="#"><i
                                            class="fas fa-file-alt text-primary"></i> SPECIFICATIONS</a></div>
                                <div class="col-md-6"><a class="b-goods-f__link-2 w-100" href="#"><i
                                            class="fas fa-car-side text-primary"></i> CHANGE vehicle</a></div>
                            </div>
                            <div class="b-goods-f-checks">
                                <div class="b-goods-f-checks__section">
                                    <div class="b-goods-f-checks__title text-primary">Add Rental Option</div>
                                    <div class="row no-gutters justify-content-between">
                                        <div class="col-sm-auto">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" id="customCheck1" type="checkbox" />
                                                <label class="custom-control-label" for="customCheck1">Check this custom
                                                    checkbo</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-auto b-goods-f-checks__price">$9.98</div>
                                    </div>
                                </div>
                                <div class="b-goods-f-checks__section">
                                    <div class="b-goods-f-checks__title text-primary">Add Damage Waivers</div>
                                    <div class="row no-gutters justify-content-between">
                                        <div class="col-sm-auto">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" id="customCheck2" type="checkbox" />
                                                <label class="custom-control-label" for="customCheck2">VIP Plus Theft &
                                                    Damage Waiver</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-auto b-goods-f-checks__price">$25</div>
                                    </div>
                                    <div class="row no-gutters justify-content-between">
                                        <div class="col-sm-auto">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" id="customCheck3" type="checkbox" />
                                                <label class="custom-control-label" for="customCheck3">VIP-ZERO Theft &
                                                    Damage Waiver</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-auto b-goods-f-checks__price">$35</div>
                                    </div>
                                </div>
                                <div class="b-goods-f-checks__section">
                                    <div class="b-goods-f-checks__title text-primary">Add Accessories</div>
                                    <div class="row no-gutters justify-content-between">
                                        <div class="col-sm-auto">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" id="customCheck4" type="checkbox" />
                                                <label class="custom-control-label" for="customCheck4">Helmet Rental - Full
                                                    Face Type</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-auto b-goods-f-checks__price">$18</div>
                                    </div>
                                    <div class="row no-gutters justify-content-between">
                                        <div class="col-sm-auto">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" id="customCheck5" type="checkbox" />
                                                <label class="custom-control-label" for="customCheck5">Jacket Rental</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-auto b-goods-f-checks__price">$30</div>
                                    </div>
                                </div>
                            </div>
                            <section class="b-goods-f__section">
                                <h2 class="b-goods-f__title2">Pricing Details</h2>
                                <div class="table-responsive">
                                    <table class="b-goods-f__table table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ITEM</th>
                                                <th>price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1 Day @ $145 / Day $145</td>
                                                <td>$145</td>
                                            </tr>
                                            <tr>
                                                <td>Special Rate Discount -$5</td>
                                                <td>-$5</td>
                                            </tr>
                                            <tr>
                                                <td>Unlimited Miles Free</td>
                                                <td>Free</td>
                                            </tr>
                                            <tr>
                                                <td>Environmental Surcharge $9.10</td>
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
                                                <td>1 Day @ $9.98 / Day $9.98</td>
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
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </section>
                            <div class="text-right"><a class="btn btn-secondary btn-lg mr-sm-2 mb-1 mb-sm-0" href="#">save &
                                    continue later</a><a class="btn btn-primary btn-lg" href="#">checkout<i
                                        class="ic-r fas fa-chevron-right"></i></a></div>
                        </div>
                        <div class="col-lg-4">
                            <aside class="l-sidebar mt-4 mt-lg-0">
                                <div class="widget section-sidebar bg-gray">
                                    <h3
                                        class="widget-title bg-dark row justify-content-between align-items-center no-gutters">
                                        <i class="ic flaticon-car-2 bg-primary col-auto"></i><span
                                            class="widget-title__inner col">Your Reservation</span></h3>
                                    <div class="widget-content">
                                        <div class="widget-card">
                                            <div class="widget-card-number row no-gutters">
                                                <div class="col-6">
                                                    <div class="widget-card-number__item">
                                                        <div class="text-primary">1</div>
                                                        <div class="widget-card-number__info">Vehicle(s)</div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="widget-card-number__item">
                                                        <div class="text-primary">4</div>
                                                        <div class="widget-card-number__info">Rental Days</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-card-descr">
                                                <div class="widget-card-descr__item">
                                                    <div class="widget-card-descr__title">Vehicle Pickup</div>
                                                    <div class="widget-card-descr__info">03/04/2019 at 2:30 PM</div>
                                                </div>
                                                <div class="widget-card-descr__item">
                                                    <div class="widget-card-descr__title">Flagstaff</div>
                                                    <div class="widget-card-descr__info">800 W. Route 66, Flagstaff, AZ
                                                        86001, United States of America</div>
                                                </div>
                                                <div class="widget-card-descr__item">
                                                    <div class="widget-card-descr__title">Vehicle Drop Off</div>
                                                    <div class="widget-card-descr__info">03/04/2019 at 2:30 PM</div>
                                                </div>
                                                <div class="widget-card-descr__item">
                                                    <div class="widget-card-descr__title">Flagstaff</div>
                                                    <div class="widget-card-descr__info">800 W. Route 66, Flagstaff, AZ
                                                        86001, United States of America</div>
                                                </div>
                                            </div><a class="btn btn-primary btn-lg" href="#">Change</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget section-sidebar bg-gray">
                                    <h3
                                        class="widget-title bg-dark row justify-content-between align-items-center no-gutters">
                                        <i class="ic flaticon-car-2 bg-primary col-auto"></i><span
                                            class="widget-title__inner col">Ride More, Save More</span></h3>
                                    <div class="widget-content">
                                        <div class="widget-rates">
                                            <div class="widget-rates__title">Average Discount Rates</div>
                                            <table class="widget-rates__table">
                                                <tbody>
                                                    <tr>
                                                        <td>1 - 3 days</td>
                                                        <td>Standard Rate</td>
                                                    </tr>
                                                    <tr>
                                                        <td>4 - 6 days</td>
                                                        <td>12% Off</td>
                                                    </tr>
                                                    <tr>
                                                        <td>7 - 13 days</td>
                                                        <td>18% Off</td>
                                                    </tr>
                                                    <tr>
                                                        <td>14 - 20 days</td>
                                                        <td>24% Off</td>
                                                    </tr>
                                                    <tr>
                                                        <td>21+ days</td>
                                                        <td>30% Off</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="widget-rates__note"><strong>Add more days to receive your discounted
                                                    rate!</strong>
                                                *Discount is automatically applied when applicable.
                                            </div>
                                            <div class="widget-rates-info row no-gutters align-items-center">
                                                <div class="col-auto"><i class="ic fas fa-bullhorn"></i></div>
                                                <div class="col">
                                                    <div class="widget-rates-info__text">Seasonal And Multi-Day Discounts
                                                        Are Applied Automatically When Applicable to Booking.</div>
                                                </div>
                                            </div><a class="btn btn-primary btn-lg" href="#">add days to booking</a>
                                        </div>
                                    </div>
                                    <!-- end .widget-->
    
                                </div>
                            </aside>
                        </div>
                    </div>
                </section>
                <!-- end .b-goods-f-->
    
            </main>
        </div>
    </div>
</div>