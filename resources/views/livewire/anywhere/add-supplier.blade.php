<div>
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addSupplierModal">
    New Supplier
  </button>

  <!-- Modal -->
  <div class="modal fade"
       wire:ignore.self
       id="addSupplierModal"
       tabindex="-1"
       aria-labelledby="addSupplierModalLabel"
       aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addSupplierModalLabel">Supplier Info</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form wire:submit.prevent="addNewSupplierFormSubmit">
          <div class="text-left modal-body">
            <div class="form-group">
              <label for="fieldName">Name *</label>
              <input wire:model.defer="fieldName"
                     type="text"
                     class="form-control form-control-sm @error ('fieldName') is-invalid @enderror"
                     id="fieldName"
                     name="name"
                     placeholder="Enter full name"
                     required>
              @error ('fieldName')
              <span class="text-sm text-danger"><i class="far fa-times-circle"></i> {{ $message }}</span>
              @enderror
            </div>
            <div class="form-group">
              <label for="supplier-description">Description</label>
              <textarea wire:model.defer="fieldDescription"
                        name="supplier-description"
                        class="form-control"
                        id="supplier-description"
                        cols="30"
                        rows="2"
                        >
              </textarea>
              @error ('fieldDescription')
              <span class="text-sm text-danger"
                    for="supplier-description"><i class="far fa-times-circle"></i> {{ $message }}</span>
              @enderror
            </div>
            <div class="form-group">
              <label for="phone">Phone Number *</label>
              <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                  <span class="input-group-text">+880</span>
                </div>
                <input wire:model.defer="fieldPhone"
                       type="number"
                       name="phone"
                       class="form-control form-control-sm @error('fieldPhone') is-invalid @enderror"
                       id="phone"
                       form="sale-store-form"
                       placeholder="Enter user contact number"
                       required>
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
              <label for="faxNumber">Fax Number</label>
              <input wire:model.defer="fieldFaxNumber"
                     type="text"
                     class="form-control form-control-sm @error('fieldFaxNumber') is-invalid @enderror"
                     id="faxNumber"
                     name="fax"
                     placeholder="Enter Fax Number">
              @error ('fieldFaxNumber')
              <span class="text-sm text-danger"><i class="far fa-times-circle"></i> {{ $message }}</span>
              @enderror
            </div>
            <div class="form-group">
              <label for="website">Website</label>
              <input wire:model.defer="fieldWebsite"
                     type="text"
                     class="form-control form-control-sm @error('fieldWebsite') is-invalid @enderror"
                     id="website"
                     name="fieldWebsite"
                     placeholder="Enter Fax Number">
              @error ('fieldWebsite')
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
            <button type="submit" class="btn btn-sm btn-primary">Add Supplier</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  @if (session('success'))
    <div class="text-left alert alert-dismissible fade show alert-success">
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
