<div>
    
    <div class="group-sections">
        <div class="container" style="margin-top:-80px">
            <div class="b-main-filter bg-primary">
                <div class="row align-items-center">
                    <div class="col-lg">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select wire:model="category" class="home-input is-invalid" title="Select Vehicle Type">
                                        <option value="">Choose Car Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->item}}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <span class="text-light"> {{ $message }} </span>
                                    @enderror
                                    
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="home-input" wire:model="brand" title="Select Brand">
                                        <option value="">Choose Car Brand</option>
                                        @foreach($brands as $brand)
                                        <option value="{{$brand->brand}}">{{$brand->brand}}</option>
                                        @endforeach
                                    </select>
                                    @error('brand')
                                    <span class="text-light"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="home-input" wire:model="transmission">
                                        <option value="">Choose Transmission</option>
                                        <option value="automatic">Automatic</option>
                                        <option value="manual">Manual</option>
                                    </select>
                                    @error('transmission')
                                    <span class="text-light"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <select class="selectpicker" data-width="100%" title="Make Year" multiple="multiple"
                                        data-max-options="1" data-style="ui-select">
                                        <option>Select 1</option>
                                        <option>Select 2</option>
                                        <option>Select 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="selectpicker" data-width="100%" title="Body Type" multiple="multiple"
                                        data-max-options="1" data-style="ui-select">
                                        <option>Select 1</option>
                                        <option>Select 2</option>
                                        <option>Select 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 align-self-end">
                                <div class="form-group">
                                    <div class="b-main-filter-slider ui-filter-slider pb-3">
                                        <div id="filterPrice"></div>
                                        <div class="b-main-filter__row">
                                            <input class="b-main-filter__item" id="input-with-keypress-0" />
                                            <input class="b-main-filter__item" id="input-with-keypress-1" />
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-auto">
                        <button class="btn btn-secondary btn-lg ml-lg-3" wire:click.prevent="submitRequest"><i
                                class="ic icon-magnifier"></i> search</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end .b-main-filter-->

        
    </div>
</div>