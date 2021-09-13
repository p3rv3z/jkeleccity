<div>
  <form wire:submit.prevent="addNewProductFormSubmit" enctype="multipart/form-data">
    <div class="card-body">
      {{-- <div class="form-group"> --}}
      {{-- <label for="code">Barcode/QR-code *</label> --}}
      {{-- <input wire:model.defer="fieldNewCode" type="number" name="code" class="form-control form-control-sm @error('fieldNewCode') is-invalid @enderror" id="code" placeholder="Enter Code" --}}
      {{-- required> --}}
      {{-- @error('fieldNewCode') --}}
      {{-- <span class="text-sm text-danger"><i class="far fa-times-circle"></i> {{ $message }}</span> --}}
      {{-- @enderror --}}
      {{-- </div> --}}
      <div class="form-group">
        <label for="name">Name *</label>
        <input wire:model.lazy="fieldName" type="text" name="name" class="form-control" id="name" placeholder="Enter Name" autofocus required>
        @error('fieldName')
        <span class="text-sm text-danger"><i class="far fa-times-circle"></i>
          {{ $message }}</span>
        @enderror
      </div>
      <div class="form-group">
        <label for="model_name">Model Name *</label>
        <input wire:model.lazy="fieldModelName" type="text" model_="model_name" class="form-control" id="model_name" placeholder="Enter Model Name" autofocus required>
        @error('fieldModelName')
        <span class="text-sm text-danger"><i class="far fa-times-circle"></i>
          {{ $message }}</span>
        @enderror
      </div>
      <div class="form-group" wire:ignore>
        <label for="description">Description</label>
        <textarea wire:model.lazy="fieldDescription" name="description" class="form-control" id="description" cols="30" rows="2">
                            </textarea>
        @error('fieldDescription')
        <span class="text-sm text-danger" for="description"><i class="far fa-times-circle"></i>
          {{ $message }}</span>
        @enderror
      </div>
      <div class="form-group">
        <label for="image">Add Image</label>
        <input wire:model="fieldImage" type="file" name="image" class="form-control" id="image" autofocus>
        @error('fieldImage')
        <span class="text-sm text-danger"><i class="far fa-times-circle"></i>
          {{ $message }}</span>
        @enderror
      </div>
      @if($fieldImage)
      <div class="mb-2">
        <img width="100%" src="{{ $fieldImage->temporaryUrl() }}">
      </div>
      @endif

      <div class="form-group">
        <label for="brand_id">Brand *</label>
        <select wire:model.lazy="fieldBrand" name="brand_id" id="brand_id" class="select2" required>
          <option selected>Select Brand</option>
          @foreach($availableBrands as $brand)
          <option value="{{ $brand->id }}">{{ $brand->name }}</option>
          @endforeach
        </select>
        @error('fieldBrand')
        <span class="text-sm text-danger"><i class="far fa-times-circle"></i>
          {{ $message }}</span>
        @enderror
      </div>
      <div class="form-group">
        <label for="category_id">Category *</label>
        <select wire:model.lazy="fieldCategory" name="category_id" id="category_id" class="select2" style="width: 100%" required>
          <option selected>Select Category</option>
          @foreach($availableCategories as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
        @error('fieldCategory')
        <span class="text-sm text-danger" for="category_id">
          <i class="far fa-times-circle"></i> {{ $message }}
        </span>
        @enderror
      </div>
      @empty(!$availableProductTypes)
      <div class="form-group">
        <label for="product_type_id">Product Type *</label>
        <select wire:model.lazy="fieldProductType" name="product_type_id" id="product_type_id" class="form-control" style="width: 100%" required>
          <option>Select Product Type</option>
          @forelse($availableProductTypes as $availableProductType)
          <option value="{{ $availableProductType->id }}">
            {{ $availableProductType->name }}
          </option>
          @empty
          <option disabled>No product types found...</option>
          @endforelse
        </select>
        @error('fieldProductType')
        <span class="text-sm text-danger" for="product_type_id">
          <i class="far fa-times-circle"></i> {{ $message }}
        </span>
        @enderror
      </div>
      @endempty
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-sm btn-primary">Save & Close</button>
    </div>
  </form>

  @if(session('success'))
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

@push('scripts')
<script>
  //custom js for select 2
  document.addEventListener("livewire:load", () => {
    Livewire.hook('message.processed', (message, component) => {
      $('.select2').select2();
    });
  });

  //custom js for select brand select2
  $('#brand_id').on('change', function () {
    @this.fieldBrand = $(this).val();
  });

  //custom js for select category select2
  $('#category_id').on('change', function () {
    @this.fieldCategory = $(this).val();
  });

  // $('#description').summernote({
  //   tabsize: 2,
  //   height: 200,
  //   toolbar: [
  //     ['style', ['style']],
  //     ['font', ['bold', 'underline', 'clear']],
  //     ['color', ['color']],
  //     ['para', ['ul', 'ol', 'paragraph']],
  //     ['table', ['table']],
  //     ['view', ['fullscreen', 'codeview', 'help']]
  //   ],
  //   callbacks: {
  //     onChange: function (contents, $editable) {
  //       @this.set('fieldDescription', contents);
  //     }
  //   }
  // });
</script>
@endpush