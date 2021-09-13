<div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="form-row">
            <div class="form-group col-sm-4 col-md-3 mb-0">
              <label for="purchase_id">Invoice No *</label>
              <select wire:model.lazy="purchase_id"
                      class="select2"
                      id="purchase_id"
                      name="purchase_id"
                      form="purchase-return-form"
                      required>
                <option selected>Select Invoice</option>
                @forelse ($invoices as $invoice)
                  <option value="{{ $invoice->id }}" {{ (old('purchase_id') == $invoice->id) ? 'selected' : null }}>{{ $invoice->invoice_no }}</option>
                @empty
                  <option disabled>No Invoice Found</option>
                @endforelse
              </select>
              @error ('purchase_id')
              <span class="text-sm text-danger"
                    for="purchase_id"><i class="far fa-times-circle"></i> {{ $message }}</span>
              @enderror
            </div>
            @if ($purchase)
              <div class="form-group col-sm-4 col-md-3 mb-0">
                <label for="customer_name">Supplier Name</label>
                <input type="text"
                       value="{{ $purchase->user->name }}"
                       class="form-control"
                       id="customer_name"
                       readonly>
              </div>
              <div class="form-group col-sm-4 col-md-3 mb-0">
                <label for="c_invoice_no">C-Invoice Name</label>
                <input type="text"
                       value="{{ $purchase->c_invoice_no }}"
                       class="form-control"
                       id="c_invoice_no"
                       readonly>
              </div>
              <div class="form-group col-sm-4 col-md-3 mb-0">
                <label for="purchase_date">Purchase Date</label>
                <input type="text"
                       value="{{ $purchase->date }}"
                       class="form-control"
                       id="purchase_date"
                       readonly>
              </div>
            @endif
          </div>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </div>

  @if ($purchase)
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <form wire:submit.prevent="returnProductFormSubmit" id="add-edit-form">
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="product">Products Purchase *</label>
                  <select wire:model.lazy="purchaseDetailId"
                          class="custom-select @error ('purchaseDetailId') is-invalid @enderror"
                          style="width: 100%"
                          id="product"
                  >
                    <option value="" selected>Select product</option>
                    @forelse ($purchase->details->except($except) as $detail)
                      <option value="{{ $detail->id }}" {{ (old('purchaseDetailId') == $detail->id) ? 'selected' : null }}>{{ $detail->product->model_name . ' (Purchase Quantity: ' . $detail->quantity . ')' }}</option>
                    @empty
                      <option disabled selected>Nothing to select.</option>
                    @endforelse
                  </select>
                  @error ('purchaseDetailId')
                  <span class="text-xs text-danger"
                        for="product"><i class="far fa-times-circle"></i> {{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group col-md-3">
                  <label for="quantity">Quantity *</label>
                  <input type="number"
                         wire:model.defer="quantity"
                         class="form-control @error ('quantity') is-invalid @enderror"
                         id="quantity"
                         value="{{ old('unit_price') }}"
                         placeholder="Product quantity">
                  @error ('quantity')
                  <span class="text-xs text-danger"
                        for="quantity"><i class="far fa-times-circle"></i> {{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group col-md-3">
                  <label for="unit_price">Unit Price *</label>
                  <div class="input-group">
                    <input type="number"
                           wire:model.defer="unitPrice"
                           class="form-control @error ('unitPrice') is-invalid @enderror"
                           id="unit_price"
                           value="{{ old('unit_price') }}"
                           placeholder="Product unit price">
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
                  <input type="date"
                         name="date"
                         wire:model.lazy="date"
                         value="{{ old('date') }}"
                         class="form-control"
                         id="date"
                         form="add-edit-form"
                         placeholder="Select delivery date"
                         required>
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
                  <span class="text-xs text-danger"
                        for="policy"><i class="far fa-times-circle"></i> {{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group col-md-3">
                  <label for="cause">Cause *</label>
                  <input type="text" class="form-control" id="cause" wire:model.defer="cause">
                  @error ('cause')
                  <span class="text-xs text-danger"
                        for="cause"><i class="far fa-times-circle"></i> {{ $message }}</span>
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
    @if($purchaseReturn && !$purchaseReturn->isEmpty())
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
                  @foreach ($purchaseReturn as $return)
                    <tr>
                      <td>{{ $return->purchaseDetail->product->model_name }}</td>
                      <td>{{ $return->date }}</td>
                      <td>{{ $return->cause }}</td>
                      <td>{{ $return->quantity }}</td>
                      <td class="text-right">{{ $return->unit_price }} TK</td>
                      <td class="text-right">{{ $return->quantity * $return->unit_price }} TK</td>
                      <td>{{ ucfirst($return->policy) }}</td>
                      <td>
                        <button type="button"
                                class="btn btn-dark btn-xs"
                                wire:click="editReturnedProduct({{ $return->id }})"><i class="fa fa-edit"></i></button>
                        <button type="button"
                                class="btn btn-danger btn-xs"
                                wire:click="deleteReturnedProduct({{ $return->id }})"><i class="fa fa-trash-alt"></i>
                        </button>
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
            <span class="text-muted">Select invoice to mange purchase return.</span>
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
    $('#purchase_id').on('change', function () {
    @this.purchase_id
      = $(this).val();
    });

    // //custom js for select invoice select2
    // $('#product').on('change', function () {
    // @this.purchaseDetailId
    //   = $(this).val();
    // });

  </script>
@endpush
