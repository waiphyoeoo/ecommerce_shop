@extends('admin.layout.master')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<style>
    .select2-selection{
        height: 45px!important;
    }
</style>
@endsection
@section('content')
    <div>
        <a href="{{ route('product.index') }}" class="btn btn-dark">All Products</a>
    </div>
    <hr>
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="row">
            <div class="col-8">
                {{-- product infro --}}
                <div class="card p-4">
                    <small class="text-muted">Product Information</small>
                    <div class="form-group">
                        <label for="name">Enter Product Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Choose Product Image</label>
                        <input type="file" name="image" id="image" class="form-control" value="{{ old('image') }}">
                        {{-- @error('image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror --}}
                    </div>
                    <div class="form-group">
                        <label for="des">Enter Product Description</label>
                       <textarea name="description" id="des" class="form-control">{{ old('description') }}</textarea>
                       @error('description')
                       <p class="text-danger">{{ $message }}</p>
                   @enderror
                    </div>
                </div>
                {{-- product pricing --}}
                <div class="card p-4">
                    <small class="text-muted">Product Pricing</small>
                    <div class="form-group">
                        <label for="total_quantity">Enter Total Quantity</label>
                        <input type="number" name="total_quantity" id="total_quantity" class="form-control" value="{{ old('total_quantity') }}">
                        @error('total_quantity')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="sale_price">Enter Sale Price</label>
                        <input type="number" name="sale_price" id="sale_price" class="form-control" value="{{ old('sale_price') }}">
                        @error('sale_price')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="buy_price">Enter Buy Price</label>
                        <input type="number" name="buy_price" id="buy_price" class="form-control" value="{{ old('buy_price') }}">
                        @error('buy_price')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="discount_price">Enter Discount Price</label>
                        <input type="number" name="discount_price" id="discount_price" class="form-control" value="{{ old('discount_price') }}">
                        @error('discount_price')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card p-4">
                    <div class="form-group">
                        <label for="supplier">Choose Supplier</label>
                        <select name="supplier_slug" id="supplier">
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                        @error('supplier_slug')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category">Choose Category</label>
                        <select name="category_slug" id="category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->slug }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_slug')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="brand">Choose Brand</label>
                        <select name="brand_slug" id="brand">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->slug }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @error('brand_slug')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="color">Choose Color</label>
                        <select name="color_slug[]" id="color" multiple>
                            @foreach ($colors as $color)
                                <option value="{{ $color->slug }}">{{ $color->name }}</option>
                            @endforeach
                        </select>
                        @error('color_slug[]')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    </div>
                    <input type="submit" value="Create" class="btn btn-primary">
                </div>
            </div>
        </div>


    </form>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(function(){
        $('#supplier').select2();
        $('#category').select2();
        $('#brand').select2();
        $('#color').select2();
        $('#des').summernote({
            callbacks:{
                onImageUpload:function(files){
                    var frmData = new FormData();
                    frmData.append('image',files[0]);
                    frmData.append('_token','@php echo csrf_token(); @endphp')
                    $.ajax({
                        method : "POST",
                        url : '/admin/product-upload',
                        contentType : false,
                        processData : false,
                        data : frmData, 
                        success:function(data){
                            $('#des').summernote('insertImage',data);
                        }
                    })
                }
            }
        });
    })
</script>
@endsection