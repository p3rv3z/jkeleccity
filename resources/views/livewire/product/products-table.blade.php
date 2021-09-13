<div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="mb-2 d-flex">
                        <div class="d-flex">
                            <div>
                                <div class="ml-4 d-flex align-items-center">
                                    <label for="paginate" class="mb-0 mr-2 text-nowrap">Per Page</label>
                                    <select wire:model="productPerPage" name="paginate" id="paginate"
                                        class="form-control form-control-sm">
                                        <option disabled>Select option</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <div class="ml-4 d-flex align-items-center">
                                    <label for="brand" class="mb-0 mr-2 text-nowrap">Brand</label>
                                    <select wire:model="selectedBrand" name="brand" id="brand"
                                        class="form-control form-control-sm">
                                        <option value="">All Brands</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div>
                                <div class="ml-4 d-flex align-items-center">
                                    <label for="category" class="mb-0 mr-2 text-nowrap">Category</label>
                                    <select wire:model="selectedCategory" name="category" id="category"
                                        class="form-control form-control-sm">
                                        <option value="">Select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            @empty(!$product_types)
                                <div>
                                    <div class="ml-4 d-flex align-items-center">
                                        <label for="product_type" class="mb-0 mr-2 text-nowrap">Product
                                            Type</label>
                                        <select wire:model="selectedProductType" name="product_type" id="product_type" class="form-control form-control-sm">
                                            <option value="">Select Types</option>
                                            @forelse ($product_types as $product_type)
                                                <option value="{{ $product_type->id }}">{{ $product_type->name }}</option>
                                            @empty
                                                <option>No product types found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            @endempty


                        </div>
                        <div class="ml-auto col-md-4">
                            <input wire:model.debounce.500ms="search" type="search" class="form-control form-control-sm"
                                placeholder="search">
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    @if ($products->count())
                        <table class="table" id="product-data-table">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Model Name</th>
                                    <th>Description</th>
                                    <th class="text-center">Dealer Price</th>
                                    <th class="text-center">Regular Price</th>
                                    <th class="text-center">Offer Price</th>
                                    <th class="text-center">In Stock</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $index => $product)
                                    <tr>
                                        <td>{{ $index + $products->firstItem() }}</td>

                                        <td>{{ $product->model_name }}</td>
                                        <td>{{ Str::limit($product->description, 60, '...') }}</td>
                                        <td class="text-center">
                                            {{ $product->purchase->first()->unit_price ?? 0 }}
                                        </td>
                                        <td class="text-center">
                                            {{ $product->purchase->first()->regular_price ?? 0 }}
                                        </td>
                                        <td class="text-center">
                                            {{ $product->purchase->first()->offer_price ?? 0 }}
                                        </td>
                                        <td class="text-center">{{ $product->final_stock }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h6 class="text-center">No product found!
                        </h6>
                    @endif
                </div>
                <!-- /.card-body -->
                <div class="card-footer d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
