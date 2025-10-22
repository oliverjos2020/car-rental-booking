<div>
    <div class="container text-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/entertainment-listing"><i class="ic text-primary fas fa-home"></i> Entertainment
                    </a>
                </li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class="swiffy-slider">
            <ul class="slider-container">
                <li><img src="{{ asset('img/slider1.jpg') }}" style="width: 100%;height: auto;"></li>
                <li><img src="{{ asset('img/slider2.jpg') }}" style="width: 100%;height: auto;"></li>
                <li><img src="{{ asset('img/slider3.jpg') }}" style="width: 100%;height: auto;"></li>
                <li><img src="{{ asset('img/1.jpeg') }}" style="width: 100%;height: auto;"></li>
                <li><img src="{{ asset('img/2.jpeg') }}" style="width: 100%;height: auto;"></li>
                <li><img src="{{ asset('img/3.jpeg') }}" style="width: 100%;height: auto;"></li>
                <li><img src="{{ asset('img/4.jpeg') }}" style="width: 100%;height: auto;"></li>
                <li><img src="{{ asset('img/5.jpeg') }}" style="width: 100%;height: auto;"></li>
                <li><img src="{{ asset('img/6.jpeg') }}" style="width: 100%;height: auto;"></li>
                <li><img src="{{ asset('img/11.jpeg') }}" style="width: 100%;height: auto;"></li>
                <li><img src="{{ asset('img/8.jpeg') }}" style="width: 100%;height: auto;"></li>
                <li><img src="{{ asset('img/9.jpeg') }}" style="width: 100%;height: auto;"></li>
                <li><img src="{{ asset('img/12.jpeg') }}" style="width: 100%;height: auto;"></li>
                <li><img src="{{ asset('img/13.jpeg') }}" style="width: 100%;height: auto;"></li>
                <li><img src="{{ asset('img/14.jpeg') }}" style="width: 100%;height: auto;"></li>
                <li><img src="{{ asset('img/15.jpeg') }}" style="width: 100%;height: auto;"></li>
                <li><img src="{{ asset('img/16.jpeg') }}" style="width: 100%;height: auto;"></li>
                <li><img src="{{ asset('img/17.jpeg') }}" style="width: 100%;height: auto;"></li>
                <li><img src="{{ asset('img/18.jpeg') }}" style="width: 100%;height: auto;"></li>
                <li><img src="{{ asset('img/19.jpeg') }}" style="width: 100%;height: auto;"></li>
                <li><img src="{{ asset('img/20.jpeg') }}" style="width: 100%;height: auto;"></li>
                <li><img src="{{ asset('img/21.jpeg') }}" style="width: 100%;height: auto;"></li>
                <li><img src="{{ asset('img/22.jpeg') }}" style="width: 100%;height: auto;"></li>
                <li><img src="{{ asset('img/23.jpeg') }}" style="width: 100%;height: auto;"></li>
            </ul>

            <button type="button" class="slider-nav"></button>
            <button type="button" class="slider-nav slider-nav-next"></button>

            <div class="slider-indicators">
                <button class="active"></button>
                <button></button>
                <button></button>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="b-filter__row mt-3">
            <label for="vehicle">Select Vehicle</label>
            <select class="review-input-ent" wire:model="selectedVehicle">
                <option value="">::Select an option::</option>
                @forelse($isVehicles as $isVehicle)
                    <option value="{{$isVehicle->id}}">{{$isVehicle->item}}</option>
                @empty
                @endforelse
            </select>
            @error('vehicle')
                <span style="color:red" class="text-danger"> {{ $message }} </span>
            @enderror
        </div>
        <div class="b-filter__row mt-3">
            <label for="event">Your Event</label>
            <input type="text" wire:model="event" placeholder="Your Event" class="review-input-ent">
            @error('event')
                <span style="color:red" class="text-danger"> {{ $message }} </span>
            @enderror
        </div>
        <div class="b-filter__row">
            <label for="address">Address</label>
            <input type="text" wire:model="address" placeholder="Address" class="review-input-ent">
            @error('address')
                <span style="color:red" class="text-danger"> {{ $message }} </span>
            @enderror
        </div>
        <div class="b-filter__row">
            <label for="participants">Participants</label>
            <input type="text" wire:model="participants" placeholder="Participants" class="review-input-ent">
            @error('participants')
                <span style="color:red" class="text-danger"> {{ $message }} </span>
            @enderror
        </div>
        <div class="b-filter__row">
            <label for="hours">No of hours</label>
            <input type="text" wire:model="hours" placeholder="Number of Hours" class="review-input-ent">
            @error('hours')
                <span style="color:red" class="text-danger"> {{ $message }} </span>
            @enderror
        </div>
        <div class="b-filter__row">
            <label for="no_of_stops">Number of stops</label>
            <input type="text" wire:model="no_of_stops" placeholder="Number of Stops" class="review-input-ent">
            @error('no_of_stops')
                <span style="color:red" class="text-danger"> {{ $message }} </span>
            @enderror
        </div>
        <div class="b-filter__row">
            <label for="stop_location">Stop Location</label>
            <input type="text" wire:model="stop_location" placeholder="Stop Location" class="review-input-ent">
            @error('stop_location')
                <span style="color:red" class="text-danger"> {{ $message }} </span>
            @enderror
        </div>
        <div class="b-filter__row">
            <label for="no_of_stops">Date of Event</label>
            <input type="date" wire:model="entertainment_date" placeholder="Date of Event" class="review-input-ent">
            @error('entertainment_date')
                <span style="color:red" class="text-danger"> {{ $message }} </span>
            @enderror
        </div>

        @forelse($menus as $menu)
            <div class="custom-control custom-checkbox">
                <input wire:model="selectedMenus" class="custom-control-inputx" value="{{ $menu->id }}"
                    type="checkbox" @if ($menu->required == 1) checked @endif
                    @if ($menu->required == 1) disabled @endif />
                <label class="custom-control-labelx" for="customCheck1">
                    {{ $menu->item }} [{{ $menu->amount }} {{ $menu->charge_per_hour == 1 ? 'charged per hour' : '' }}]
                </label>
            </div>
        @empty
        @endforelse
 
    @if($vehicle)
        <input type="checkbox" value="{{$vehicle->id}}" checked disabled> {{$vehicle->item}} [{{$vehicle->amount}}]<br>
    @endif
        @if (Auth::check())
            <a style="color:#fff" class="btn btn-primary text-light btn-lg mt-3 mb-3"
                wire:click="proceed"> Proceed</a>
        @else
            <a style="color:#fff" class="btn btn-primary text-light btn-lg mt-3 mb-3" href="/login">
                Proceed</a>
        @endif

    </div>


</div>
