<div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="form-row">

            <div class="mb-2 col-md-12">
              <livewire:anywhere.add-customer />
            </div>
            <div class="mb-0 form-group col-sm-4 col-md-3">
              <label for="user_id">Customer *</label>
              <select class="select2" id="user_id" name="user_id" form="sale-store-form" required wire:model.lazy="invoiceUser">
                <option selected>Select Customer</option>
                @foreach ($availableUsers as $user)
                  <option value="{{ $user->id }}" >{{ $user->name . ' (' . $user->phone . ')' }}</option>
                @endforeach
              </select>
              @error ('user_id')
              <span class="text-sm text-danger"><i class="far fa-times-circle"></i> {{ $message }}</span>
              @enderror
            </div>
            <div class="mb-0 form-group col-sm-4 col-md-3">
              <label for="invoice_no">Invoice No *</label>
              <input type="text" name="invoice_no" value="{{ $invoiceNumber }}" class="form-control" id="invoice_no"
                form="sale-store-form" placeholder="Enter Invoice No" required readonly>
              @error ('invoiceNumber')
              <span class="text-xs text-danger"><i class="far fa-times-circle"></i> {{ $message }}</span>
              @enderror
            </div>
            <div class="mb-0 form-group col-sm-4 col-md-3">
              <label for="date">Date *</label>
              <input wire:model.debounce.400ms="invoiceDate" type="date" name="date"
                value="{{ old('date', $invoiceDate) }}" class="form-control" id="date" form="sale-store-form"
                placeholder="Select delivery date" required>
              @error ('invoiceDate')
              <span class="text-xs text-danger"><i class="far fa-times-circle"></i>{{ $message }}</span>
              @enderror
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <form wire:submit.prevent="addProductFormSubmit">
            <div class="form-group">
              <label for="fieldProduct">Product *</label>
              <select class="select2" id="fieldProduct" wire:model.lazy="fieldProduct">
                <option selected>Select Product</option>
                @foreach ($availableProducts->except($exceptProducts) as $product)
                <option value="{{ $product->id }}" {{ (old('fieldProduct')==$product->id) ? 'selected' : null }}>{{
                  $product->model_name . ' (Available: ' . $product->final_stock . ')' }}</option>
                @endforeach
              </select>
              @error ('fieldProduct')
              <span class="text-xs text-danger" for="product"><i class="far fa-times-circle"></i> {{ $message }}</span>
              @enderror
            </div>
            <div class="form-group">
              <label for="quantity">Quantity *</label>
              <input type="number" wire:model.lazy="fieldQuantity"
                class="form-control @error ('fieldQuantity') is-invalid @enderror" id="quantity"
                value="{{ old('unit_price') }}" placeholder="Enter product quantity">
              @error ('fieldQuantity')
              <span class="text-xs text-danger" for="quantity"><i class="far fa-times-circle"></i> {{ $message }}</span>
              @enderror
            </div>
            <div class="form-group">
              <label for="unit_price">Unit Price *</label>
              <div class="input-group">
                <input type="number" wire:model.lazy="fieldUnitPrice"
                  class="form-control @error ('fieldUnitPrice') is-invalid @enderror" id="unit_price"
                  value="{{ old('unit_price') }}" placeholder="Enter product price per unit">
                <div class="input-group-append">
                  <span class="input-group-text">TK</span>
                </div>
              </div>
              @error ('fieldUnitPrice')
              <span class="text-xs text-danger" for="unit_price"><i class="far fa-times-circle"></i> {{ $message
                }}</span>
              @enderror
            </div>
            <button type="submit" class="btn btn-sm btn-block btn-dark">
              @if ($update === false) Add @else Update @endif To Product List
            </button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <label class="text-center w-100">Product List *</label>
          @empty($idProducts)
          <h6 class="p-2 text-sm text-center text-muted">Product not added yet.</h6>
          @error ('idProducts')
          <h6 class="p-2 text-xs text-center text-danger"><i class="far fa-times-circle"></i> {{ $message }}</h6>
          @enderror
          @else
          <div class="table-responsive">
            <table class="table text-sm text-center table-bordered table-sm text-nowrap">
              <thead>
                <th>#</th>
                <th>Product</th>
                <th>Quantity</th>
                <th class="text-right">Unit Price</th>
                <th class="text-right" width="120px">Price</th>
                <th>Action</th>
              </thead>
              <tbody>
                @foreach ($idProducts as $index => $productID)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $availableProducts->find($productID)->model_name }}</td>
                  <td>{{ $productQuantities[$index] }}</td>
                  <td class="text-right">{{ $productUnitPrices[$index] }} TK</td>
                  <td class="text-right">{{ $productQuantities[$index] * $productUnitPrices[$index] }} TK</td>
                  <td>
                    <button type="button" class="btn btn-dark btn-xs" wire:click="editFromProductList({{ $index }})">
                      <i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-xs"
                      wire:click="removeFromProductList({{ $index }})"><i class="fa fa-trash-alt"></i></button>
                  </td>
                </tr>
                <input type="hidden" form="sale-store-form" name="idProducts[]" value="{{ $productID }}">
                <input type="hidden" form="sale-store-form" name="productQuantities[]"
                  value="{{ $productQuantities[$index] }}">
                <input type="hidden" form="sale-store-form" name="productUnitPrices[]"
                  value="{{ $productUnitPrices[$index] }}">
                @if (array_key_exists($index, $saleDetailsID))
                <input type="hidden" form="sale-store-form" name="saleDetailsID[]" value="{{ $saleDetailsID[$index] }}">
                @endif
                @endforeach
                @php
                $totalDue = $totalCost - ($fieldDiscount != '' ? $fieldDiscount : 0) - ($fieldPaid != '' ? $fieldPaid :
                0)
                @endphp
                <tr>
                  <td colspan="4" class="text-right"> Total</td>
                  <td class="text-right">{{ $totalCost > 0 ? $totalCost : old('cost_amount') }}</td>
                </tr>
                <tr>
                  <td colspan="4" class="text-right"> Due</td>
                  <td class="text-right">{{ old('due_amount') ?? ($totalDue > 0 ? $totalDue : ($totalCost > 0 ? 0 :
                    null)) }}</td>
                </tr>
                <tr>
                  <td colspan="4" class="text-right"> Discount</td>
                  <td class="text-right">
                    <input type="text" wire:model.debounce.400ms="fieldDiscount" wire:keyDown.debounce.500ms="fullPaid"
                      name="discount" class="form-control form-control-sm @error('discount') is-invalid @enderror"
                      id="discount" form="sale-store-form" placeholder="Discount" required>

                    @error ('discount')
                    <span class="text-xs text-danger"><i class="far fa-times-circle"></i> {{ $message }}</span>
                    @enderror
                  </td>
                </tr>
                <tr>
                  <td colspan="4" class="text-right"> Paid</td>
                  <td class="text-right">
                    <input type="text" wire:model.debounce.500ms="fieldPaid" name="paid_amount"
                      class="form-control form-control-sm @error('paid_amount') is-invalid @enderror" id="paid_amount"
                      form="sale-store-form" placeholder="Amount paid" required>

                    @error ('paid_amount')
                    <span class="text-xs text-danger"><i class="far fa-times-circle"></i> {{ $message }}</span>
                    @enderror
                  </td>
                  <td>
                    <button type="button" class="btn btn-primary btn-xs" wire:click="fullPaid">
                      <i class="fa fa-arrow-left"></i> Full Paid
                    </button>
                  </td>
                </tr>
                <tr>
                  <td colspan="4" class="text-right"> Payment Type</td>
                  <td class="text-right">
                    <select wire:model.lazy="paymentType" class="form-control form-control-sm" id="payment_type"
                      form="sale-store-form" name="payment_type" required>
                      <option value="cash">Cash</option>
                      <option value="cheque">Cheque</option>
                      <option value="card">Card</option>
                    </select>
                    @error ('payment_type')
                    <span class="text-xs text-danger"><i class="far fa-times-circle"></i> {{ $message }}</span>
                    @enderror
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          {{-- payment body --}}
          @if ($paymentType === 'cheque')
          <div class="row">
            <div class="col-md-8">
              <div class="card bg-gradient-light">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="bank_name">Bank Name</label>
                      <input type="text" name="bank_name" value="{{ old('bank_name', $sale->bank_name ?? null) }}"
                        class="form-control form-control-sm" id="bank_name" form="sale-store-form"
                        placeholder="Bank name">
                      @error ('bank_name')
                      <span class="text-xs text-danger" for="bank_name"><i class="far fa-times-circle"></i> {{ $message
                        }}</span>
                      @enderror
                    </div>
                    <div class="form-group col-md-6">
                      <label for="cheque_no">Cheque Number</label>
                      <input type="text" name="cheque_no" value="{{ old('cheque_no', $sale->cheque_no ?? null) }}"
                        class="form-control form-control-sm" id="cheque_no" form="sale-store-form"
                        placeholder="Check number">
                      @error ('cheque_no')
                      <span class="text-xs text-danger" for="cheque_no"><i class="far fa-times-circle"></i> {{ $message
                        }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif

          @if ($paymentType === 'card')
          <div class="row">
            <div class="col-md-8">
              <div class="card bg-gradient-light">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="bank_name">Card Type</label>
                      <input type="text" name="card_type" value="{{ old('card_type', $sale->card_type ?? null) }}"
                        class="form-control form-control-sm" id="card_type" form="sale-store-form"
                        placeholder="Card Type">
                      @error ('card_type')
                      <span class="text-xs text-danger" for="card_type"><i class="far fa-times-circle"></i> {{ $message
                        }}</span>
                      @enderror
                    </div>
                    <div class="form-group col-md-6">
                      <label for="card_no">Card Number</label>
                      <input type="text" name="card_no" value="{{ old('card_no', $sale->card_no ?? null) }}"
                        class="form-control form-control-sm" id="card_no" form="sale-store-form"
                        placeholder="Card number">
                      @error ('card_no')
                      <span class="text-xs text-danger" for="card_no"><i class="far fa-times-circle"></i> {{ $message
                        }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif
          {{-- payment body --}}

          {{-- total amount and due and payment --}}
          <input type="hidden" name="cost_amount" value="{{ $totalCost > 0 ? $totalCost : old('cost_amount') }}"
            id="cost_amount" form="sale-store-form" readonly>
          <input type="hidden" name="due_amount"
            value="{{ old('due_amount') ?? ($totalDue > 0 ? $totalDue : ($totalCost > 0 ? 0 : null)) }}" id="due_amount"
            form="sale-store-form" readonly>
          {{--/ total amount and due and payment --}}
          @endempty
          @foreach ($deletableSaleDetailsID as $detailsID)
          <input type="hidden" form="sale-store-form" name="deletableSaleDetailsID[]" value="{{ $detailsID }}">
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="pt-3 pb-5 text-center">
        <button type="submit" name="action" value="{{ $action }}&print" form="sale-store-form"
          class="btn btn-primary btn-sm">{{ ucFirst($action) }} & Print</button>
        <button type="submit" name="action" value="{{ $action }}&close" form="sale-store-form"
          class="btn btn-primary btn-sm">{{ ucFirst($action) }} & Close
        </button>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <livewire:product.products-table />
    </div>
  </div>
</div>

@push('scripts')
<script>

  //custom js for select 2
  document.addEventListener("livewire:load", () => {
    Livewire.hook('message.processed', (message, component) => {
      $('.select2').select2()
    });
  });

  //custom js for select product select2
  $('#fieldProduct').on('change', function () {
    @this.fieldProduct
      = $(this).val();
  });

  //custom js for select product select2
  $('#user_id').on('change', function () {
    @this.invoiceUser
      = $(this).val();
  });

</script>
@endpush