<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Voucher Management</h4>

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
                    <label for="voucher_name">Voucher name</label>
                    <input type="text" wire:model="voucher_name" class="form-control" placeholder="Voucher Name">
                    @error('voucher_name')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="discount_type">Discount Type</label>
                    <select wire:model="discount_type" class="form-select">
                        <option value="">::Select an option::</option>
                        <option value="percentage">Percentage</option>
                        <option value="fixed">Fixed</option>
                    </select>
                    @error('discount_type')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="discount_amount">Discount Amount</label>
                    <input type="number" wire:model="discount_amount" class="form-control"
                        placeholder="Discount Amount">
                    @error('discount_amount')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="valid_from">Valid From</label>
                    <input type="date" wire:model="valid_from" class="form-control" placeholder="Valid From">
                    @error('valid_from')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="valid_from">Valid Until</label>
                    <input type="date" wire:model="valid_until" class="form-control" placeholder="Valid Until">
                    @error('valid_until')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>

                <button class="btn btn-primary btn-sm mt-3" wire:click.prevent="create">
                    Save
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
                                <th>Voucher Name</th>
                                <th>Voucher Code</th>
                                <th>Discount Type</th>
                                <th>Discount Amount</th>
                                <th>Valid From</th>
                                <th>Valid Until</th>
                                <th>Edit</th>
                                <th>Delete</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($vouchers as $voucher)
                                <tr>
                                    <td>{{ ($vouchers->currentPage() - 1) * $vouchers->perPage() + $loop->iteration }}
                                    </td>
                                    <td>{{ $voucher->voucher_name }}</td>
                                    <td>{{ $voucher->voucher_code }}</td>
                                    <td>{{ $voucher->discount_type }}</td>
                                    <td>{{ $voucher->discount_amount }}</td>
                                    <td>{{ $voucher->valid_from }}</td>
                                    <td>{{ $voucher->valid_until }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm text-light" style="cursor:pointer;"
                                            wire:click="edit({{ $voucher->id }})">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-light btn btn-danger btn-sm"
                                            wire:click="delete({{ $voucher->id }})">
                                            <i class="fa fa-trash"></i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>

                                @if ($editingID === $voucher->id)
                                    <tr>
                                        <td colspan="9">
                                            <input type="text" wire:model="editing_voucher_name"
                                                placeholder="voucher name" class="form-control mx-1">
                                            @error('editing_voucher_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">
                                            <select wire:model="editing_discount_type" class="form-select">
                                                <option value="">::Select an option::</option>
                                                <option value="percentage">Percentage</option>
                                                <option value="fixed">Fixed</option>
                                            </select>
                                            @error('editing_discount_type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        </tr>
                                    <tr>
                                        <td colspan="9">
                                            <input type="number" wire:model="editing_discount_amount"
                                                placeholder="Discount amount" class="form-control mx-1">
                                            @error('editing_discount_amount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        </tr>
                                    <tr>
                                        <td colspan="9">
                                            <input type="date" wire:model="editing_valid_from"
                                                placeholder="Valid from" class="form-control mx-1">
                                            @error('editing_valid_from')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        </tr>
                                    <tr>
                                        <td colspan="9">
                                            <input type="date" wire:model="editing_valid_until"
                                                placeholder="Valid until" class="form-control mx-1">
                                            @error('editing_valid_until')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        </tr>
                                    <tr>
                                        <td colspan="9">
                                            <button type="submit" wire:click="update"
                                                class="btn btn-success btn-sm">Update</button> <button type="submit"
                                                wire:click="cancelEdit" class="btn btn-danger btn-sm">Cancel</button>
                                        </td>
                                    </tr>
                                @endif

                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-danger"> No record available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="loader text-center">
                        <div class="my-2">
                            {{ $vouchers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
