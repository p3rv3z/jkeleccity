<div>
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addCustomerModal">
    New Customer
  </button>

  <!-- Modal -->
  <div class="modal fade"
       wire:ignore.self
       id="addCustomerModal"
       tabindex="-1"
       aria-labelledby="addCustomerModalLabel"
       aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addCustomerModalLabel">Customer Info</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form wire:submit.prevent="addNewCustomerFormSubmit">
          <div class="modal-body text-left">
            <div class="form-group">
              <label for="name">Name *</label>
              <input wire:model.defer="fieldName"
                     type="text"
                     class="form-control form-control-sm @error ('fieldName') is-invalid @enderror"
                     id="name"
                     name="name"
                     placeholder="Enter full name"
                     required>
              @error ('fieldName')
              <span class="text-sm text-danger"><i class="far fa-times-circle"></i> {{ $message }}</span>
              @enderror
            </div>
            <div class="form-group">
              <label for="nid">NID Number</label>
              <input wire:model.defer="fieldNID"
                     type="text"
                     class="form-control form-control-sm @error ('fieldNID') is-invalid @enderror"
                     id="nid"
                     name="nid"
                     placeholder="Enter NID Number"
                     required>
              @error ('fieldNID')
              <span class="text-sm text-danger"><i class="far fa-times-circle"></i> {{ $message }}</span>
              @enderror
            </div>
            <div class="form-group">
              <label for="birth_certificate_number">Birth Certificate Number</label>
              <input wire:model.defer="fieldBCN"
                     type="text"
                     class="form-control form-control-sm @error ('fieldBCN') is-invalid @enderror"
                     id="birth_certificate_number"
                     name="birth_certificate_number"
                     placeholder="Enter Birth Certificate Number"
                     required>
              @error ('fieldBCN')
              <span class="text-sm text-danger"><i class="far fa-times-circle"></i> {{ $message }}</span>
              @enderror
            </div>
            <div class="form-group">
              <label for="phone_no">Phone Number *</label>
              <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                  <span class="input-group-text">+880</span>
                </div>
                <input wire:model.defer="fieldPhone"
                       type="number"
                       name="phone"
                       class="form-control form-control-sm @error('fieldPhone') is-invalid @enderror"
                       id="phone_no"
                       form="sale-store-form"
                       placeholder="Enter user contact number"
                >
              </div>
              @error ('fieldPhone')
              <span class="text-xs text-danger"><i class="far fa-times-circle"></i> {{ $message }}</span>
              @enderror
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input wire:model.defer="fieldEmail"
                     type="email"
                     class="form-control form-control-sm @error('fieldEmail') is-invalid @enderror"
                     id="email"
                     name="email"
                     placeholder="Enter email address">
              @error ('fieldEmail')
              <span class="text-sm text-danger"><i class="far fa-times-circle"></i> {{ $message }}</span>
              @enderror
            </div>
            <div class="form-group">
              <label for="address">Address</label>
              <textarea wire:model.defer="fieldAddress"
                        name="address"
                        class="form-control"
                        id="address"
                        cols="30"
                        rows="2">
              </textarea>
              @error ('fieldAddress')
              <span class="text-sm text-danger"
                    for="address"><i class="far fa-times-circle"></i> {{ $message }}</span>
              @enderror
            </div>
            <small class="text-gray">Default password is "12345678"</small>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-primary">Add Customer</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  @if (session('success'))
    <div class="alert alert-dismissible fade show alert-success text-left">
      <div class="alert-heading">
        Success!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="alert-body">
        {{ session('success') }}
      </div>
    </div>
  @endif
</div>
