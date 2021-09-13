<div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="form-row">
            <div class="form-group col-sm-4 col-md-3 mb-0">
              <label for="sale_id">Invoice No *</label>
              <select wire:model.lazy="sale_id" class="select2" id="sale_id" name="sale_id" form="sale-return-form" required>
                <option selected value="null">Select Invoice</option>
                @forelse ($invoices as $invoice)
                  <option value="{{ $invoice->id }}" {{ (old('sale_id') == $invoice->id) ? 'selected' : null }}>{{ $invoice->invoice_no }}</option>
                @empty
                  <option disabled>No Invoice Found</option>
                @endforelse
              </select>
              @error ('sale_id')
              <span class="text-sm text-danger" for="sale_id"><i class="far fa-times-circle"></i> {{ $message }}</span>
              @enderror
            </div>
            @if ($sale)
              <div class="form-group col-sm-4 col-md-3 mb-0">
                <label for="customer_name">Customer Name</label>
                <input type="text" value="{{ $sale->user->name }}" class="form-control" id="customer_name" readonly>
              </div>
              <div class="form-group col-sm-4 col-md-3 mb-0">
                <label for="sale_date">Sale Date</label>
                <input type="text" value="{{ $sale->date }}" class="form-control" id="sale_date" readonly>
              </div>
            @endif
          </div>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </div>

  @if ($sale)
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <form wire:submit.prevent="returnProductFormSubmit" id="add-edit-form">
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="product">Products Sold *</label>
                  <select class="custom-select @error ('saleDetailId') is-invalid @enderror" style="width: 100%" id="product" wire:model.lazy="saleDetailId">
                    <option selected>Select product</option>
                    @forelse ($sale->details->except($except) as $detail)
                      <option value="{{ $detail->id }}" {{ (old('saleDetailId') == $detail->id) ? 'selected' : null }}>{{ $detail->product->name . ' (Sold Quantity: ' . $detail->quantity . ')' }}</option>
                    @empty
                      <option disabled selected>Nothing to select.</option>
                    @endforelse
                  </select>
                  @error ('saleDetailId')
                  <span class="text-xs text-danger" for="product"><i class="far fa-times-circle"></i> {{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group col-md-3">
                  <label for="quantity">Quantity *</label>
                  <input type="number" wire:model.defer="quantity" class="form-control @error ('quantity') is-invalid @enderror" id="quantity" value="{{ old('unit_price') }}" placeholder="Product quantity">
                  @error ('quantity')
                  <span class="text-xs text-danger" for="quantity"><i class="far fa-times-circle"></i> {{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group col-md-3">
                  <label for="unit_price">Unit Price *</label>
                  <div class="input-group">
                    <input type="number" wire:model.defer="unitPrice" class="form-control @error ('unitPrice') is-invalid @enderror" id="unit_price" value="{{ old('unit_price') }}" placeholder="Product unit price">
                    <div class="input-group-append">
                      <span class="input-group-text">TK</span>
                    </div>
                  </div>
                  @error ('unitPrice')
                  <span class="text-xs text-danger" for="unit_price"><i class="far fa-times-circle"></i> {{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group col-sm-4 col-md-3 mb-0">
                  <label for="date">Return Date *</label>
                  <input type="date" name="date" wire:model.lazy="date" value="{{ old('date') }}" class="form-control" id="date" form="add-edit-form" placeholder="Select delivery date" required>
                  @error ('date')
                  <span class="text-xs text-danger" for="date"><i class="far fa-times-circle"></i>{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group col-md-3">
                  <label for="policy">Return Policy *</label>
                  <select id="policy" wire:model.defer="policy" class="form-control">
                    <option value="">Select Policy</option>
                    @foreach($returnPolicies as $policy)
                      <option value="{{ $policy }}">{{ ucfirst($policy) }}</option>
                    @endforeach
                  </select>
                  @error ('policy')
                  <span class="text-xs text-danger" for="policy"><i class="far fa-times-circle"></i> {{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group col-md-3">
                  <label for="cause">Cause *</label>
                  <input type="text" class="form-control" id="cause" wire:model.defer="cause">
                  @error ('cause')
                  <span class="text-xs text-danger" for="cause"><i class="far fa-times-circle"></i> {{ $message }}</span>
                  @enderror
                </div>
              </div>
              <button type="submit" class="btn btn-sm btn-dark">
                {{ ($updating === false) ? "Return Product" : "Update Return" }}
              </button>
              @if($updating)
                <button type="button" class="btn btn-sm btn-danger" wire:click="resetForm()">Reset</button>
              @endif
            </form>
          </div>
        </div>
      </div>
    </div>
    @if($saleReturn && !$saleReturn->isEmpty())
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <span>Returned Products</span>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm text-nowrap text-center text-sm">
                  <thead>
                  <th>Product</th>
                  <th>Date</th>
                  <th>Cause</th>
                  <th>Quantity</th>
                  <th class="text-right">Unit Price</th>
                  <th class="text-right" width="120px">Amount</th>
                  <th>Policy</th>
                  <th>Action</th>
                  </thead>
                  <tbody>
                  @foreach ($saleReturn as $return)
                    <tr>
                      <td>{{ $return->saleDetail->product->name }}</td>
                      <td>{{ $return->date }}</td>
                      <td>{{ $return->cause }}</td>
                      <td>{{ $return->quantity }}</td>
                      <td class="text-right">{{ $return->unit_price }} TK</td>
                      <td class="text-right">{{ $return->quantity * $return->unit_price }} TK</td>
                      <td>{{ ucfirst($return->policy) }}</td>
                      <td>
                        <button type="button" class="btn btn-dark btn-xs" wire:click="editReturnedProduct({{ $return->id }})"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-xs" wire:click="deleteReturnedProduct({{ $return->id }})"><i class="fa fa-trash-alt"></i></button>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif
  @else
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body text-center">
            <span class="text-muted">Select invoice to mange sale return.</span>
          </div>
        </div>
      </div>
    </div>
  @endif
</div>

@push('scripts')
  <script>

    //custom js for select 2
    document.addEventListener("livewire:load", () => {
      Livewire.hook('message.processed', (message, component) => {
        $('.select2').select2()
      });
    });

    //custom js for select invoice select2
    $('#sale_id').on('change', function () {
    @this.sale_id
      = $(this).val();
    });

    // //custom js for select invoice select2
    // $('#product').on('change', function () {
    // @this.purchaseDetailId
    //   = $(this).val();
    // });

  </script>
@endpush
