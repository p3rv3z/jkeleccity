<div>
    <form wire:submit.prevent="updateProductFormSubmit">
        <div class="card-body">
            <div class="form-group">
                <label for="existingName">Name *</label>
                <input wire:model.defer="fieldName" type="text" name="name" class="form-control"
                    id="existingName" placeholder="Enter Name" autofocus required>
                @error('fieldName')
                    <span class="text-sm text-danger" for="existingName"><i class="far fa-times-circle"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="form-group">
              <label for="existingModelName">Model Name *</label>
              <input wire:model.defer="fieldModelName" type="text" name="model_name" class="form-control"
                  id="existingModelName" placeholder="Enter Model Name" autofocus required>
              @error('fieldModelName')
                  <span class="text-sm text-danger" for="existingModelName"><i class="far fa-times-circle"></i>
                      {{ $message }}
                  </span>
              @enderror
            </div>
            <div class="form-group" wire:ignore>
                <label for="existingDescription">Description</label>
                <textarea wire:model.lazy="fieldDescription" name="description" class="form-control summernote"
                    id="existingDescription" cols="30" rows="2">
                    {{ $product->description }}
                              </textarea>
                @error('fieldDescription')
                    <span class="text-sm text-danger" for="existingDescription"><i class="far fa-times-circle"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="form-group">
              <label for="image">Update Image</label>
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
            @else
              <div class="mb-2">
                <img width="100%" src="{{ $product->getFirstMediaUrl('product_image') }}">
              </div>
            @endif
            <div class="form-group">
                <label for="existingBrand_id">Brand *</label>
                <select wire:model.lazy="fieldBrand" name="brand_id" id="existingBrand_id" class="form-control select2"
                    required>
                    <option selected>Select Brand</option>
                    @foreach ($availableBrands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
                @error('fieldBrand')
                    <span class="text-sm text-danger" for="existingBrand_id"><i class="far fa-times-circle"></i>
                        {{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="existingCategory_id">Category *</label>
                <select wire:model.lazy="fieldCategory" name="category_id" id="existingCategory_id"
                    class="form-control select2" style="width: 100%" required>
                    <option selected>Select Category</option>
                    @foreach ($availableCategories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('fieldCategory')
                    <span class="text-sm text-danger" for="existingCategory_id">
                        <i class="far fa-times-circle"></i> {{ $message }}
                    </span>
                @enderror
            </div>
            @empty(!$availableProductTypes)
                <div class="form-group">
                    <label for="existingProduct_type_id">Product Type *</label>
                    <select wire:model="fieldProductType" name="product_type_id" id="existingProduct_type_id"
                        class="form-control" style="width: 100%" required>
                        <option disabled>Select Product Type</option>
                        @forelse ($availableProductTypes as $availableProductType)
                            <option value="{{ $availableProductType->id }}">
                                {{ $availableProductType->name }}</option>
                        @empty
                            <option disabled>No product types found...</option>
                        @endforelse
                    </select>
                    @error('fieldProductType')
                        <span class="text-sm text-danger" for="existingProduct_type_id">
                            <i class="far fa-times-circle"></i> {{ $message }}
                        </span>
                    @enderror
                </div>
            @endempty
        </div>
        <!-- /.card-body -->
        <div class="text-right card-footer">
            <button type="submit" class="btn btn-primary btn-sm">Update</button>
        </div>
    </form>

    <!-- Product Save Modal -->


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

@push('scripts')
    <script>


        //custom js for select 2
        document.addEventListener("livewire:load", () => {
            Livewire.hook('message.processed', (message, component) => {
                $('.select2').select2()
            });
        });

        //custom js for select brand select2
        $('#existingBrand_id').on('change', function() {
            @this.fieldBrand = $(this).val();
        });

        //custom js for select category select2
        $('#existingCategory_id').on('change', function() {
            @this.fieldCategory = $(this).val();
        });

        // $('#existingDescription').summernote({
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
        //       onChange: function(contents, $editable) {
        //           @this.set('fieldDescription', contents);
        //       }
        //   }
        // });

    </script>
@endpush
