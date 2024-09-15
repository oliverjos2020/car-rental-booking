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
                    {{ $menu->item }} ({{ $menu->amount }})
                </label>
            </div>
        @empty
        @endforelse
        @if (Auth::check())
            <a style="color:#fff" class="btn btn-primary text-light btn-lg mt-3 mb-3"
                wire:click="proceed"> Proceed</a>
        @else
            <a style="color:#fff" class="btn btn-primary text-light btn-lg mt-3 mb-3" href="/login">
                Proceed</a>
        @endif

    </div>

</div>
