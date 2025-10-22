<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Entertainment Menu</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">

                </ol>
            </div>

        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">

                <div class="form-group">
                    <label for="item">Item name</label>
                    <input type="text" wire:model="item" class="form-control" placeholder="item Name">
                    @error('item')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror

                    @if(session('message'))
                    <div class="bg-success p-2 text-light mx-2 mt-3">{{session('message')}}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" wire:model="amount" class="form-control" placeholder="Amount">
                    @error('amount')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror

                    @if(session('message'))
                    <div class="bg-success p-2 text-light mx-2 mt-3">{{session('message')}}</div>
                    @endif
                </div>
                <div class="form-group mt-3">

                    <input type="checkbox" value='1' wire:model="required"> Required <br>
                    <input type="checkbox" value='1' wire:model="charge_per_hour"> Charged Per Hour
                    <small for="required">(if checked will be added to client list automatically)</small><br>
                    <input type="checkbox" value='1' wire:model="is_vehicle"> Is Vehicle <br>
                    @error('required')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror

                    @if(session('message'))
                    <div class="bg-success p-2 text-light mx-2 mt-3">{{session('message')}}</div>
                    @endif
                </div>

                <button class="btn btn-primary btn-sm mt-3" wire:click.prevent="create">
                    Create Category
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <div class="row">
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
                        <input type="search" wire:model.live.debounce.500ms="search" placeholder="Search..."
                            class="form-control form-control-sm mt-2">
                    </div>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-striped table-bordered"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Item</th>
                                <th>Is Vehicle</th>
                                <th>Amount</th>
                                <th>Edit</th>
                                <th>Delete</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($entertainments as $ent)
                            <tr>
                                <td>{{ ($entertainments->currentPage() - 1) * $entertainments->perPage() + $loop->iteration }}</td>
                                <td>{{ $ent->item }} ({{$ent->required == 1 ? 'Required':'Not required'}}{{$ent->charge_per_hour == 1 ? ' & charged per hour':' & Not charged per hour'}})</td>
                                <td>{{ $ent->is_vehicle? 'Is Vehicle' : 'Not Vehicle' }}</td>
                                <td>{{ $ent->amount }}</td>
                                <td><a class="btn btn-primary btn-sm text-light" style="cursor:pointer;"
                                        wire:click="edit({{$ent->id}})"><i class="fa fa-edit"></i> Edit</a> </td>
                                <td><a  class="text-light btn btn-danger btn-sm" wire:click="delete({{$ent->id}})"><i
                                            class="fa fa-trash"></i> Delete</a></a></td>
                            </tr>

                            @if($editingID === $ent->id)
                            <tr>
                                <td colspan="5">
                                    <input type="text" wire:model="editingItem" placeholder="item..." class="form-control mx-1">
                                    @error('editingItem')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    
                                </td>
                                </tr>
                                <tr>
                                <td colspan="5">
                                    <input type="number" {{$ent->required == 1 ? 'checked:checked': 'checked:notchecked'}} wire:model="editingAmount" placeholder="amount..." class="form-control mx-1">

                                    @error('editingAmount')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                </tr>
                                <tr>
                                <td colspan="5">
                                    <input type="checkbox" value='1' wire:model="editingRequired" {{$ent->required == 1 ? 'checked:checked': 'checked:notchecked'}}> Required
                                    {{-- <select wire:model="editingRequired" class="form-control">
                                        <option value="0">Not Required</option>
                                        <option value="1">Required</option>
                                    </select> --}}
                                </td>
                                </tr>
                                <tr>
                                <td colspan="5">
                                    <input type="checkbox" value='1' wire:model="editingChargePerHour" {{$ent->charge_per_hour == 1 ? 'checked:checked': 'checked:notchecked'}}> Charge Per Hour
                                </td>
                                </tr>
                                <tr>
                                <td colspan="5">
                                  <input type="checkbox" wire:model="editingIsVehicle" value="1"> Is Vehicle

                                </td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <br>
                                    <button type="submit" wire:click="update"
                                        class="btn btn-success btn-sm">Update</button> <button type="submit"
                                        wire:click="cancelEdit" class="btn btn-danger btn-sm">Cancel</button>
                                    </td>
                            </tr>
                            @endif

                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-danger"> No record available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="loader text-center">
                        <div class="my-2">
                            {{ $entertainments->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
