@extends('layouts.app')
@section('title')
    <title>edit product</title>
@endsection
@section('content')
    <div class="col-xl-10 m-auto">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="{{ route('products.index') }}" class="btn btn-sm btn-info"> &laquo; Products</a>
            </div>
            <h4 class="m-t-0 m-b-30 header-title">Edit Product</h4>
            <form class="form-horizontal" role="form" action="{{ route('products.update', Crypt::encrypt($product->id)) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter product name" value="{{ $product->name }}">
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price">Product Price</label>
                            <input type="number" class="form-control" name="price" id="price" placeholder="Enter product price" value="{{ $product->price }}">
                            <span class="text-danger">
                                @error('price')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category_id" id="category" class="form-control">
                                <option value="">----------Select a Category</option>
                                @foreach ($categories as $category)
                                    <option {{ $product->category_id == $category->id ? 'selected' : '' }} value="{{ Crypt::encrypt($category->id) }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                @error('category_id')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="stock">Product Stock</label>
                            <input class="form-control" id="stock" name="stock" placeholder="Enter product stock" value="{{ $product->stock }}">
                            <span class="text-danger">
                                @error('stock')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="brands">Product Brand</label>
                            <select name="brands" id="brands" class="form-control">
                                <option value="">-------Select A Brand</option>
                                    @foreach ($brands as $brand)
                                        <option {{ $brand->id == $product->brand_id ? 'selected' : '' }} value="{{ Crypt::encrypt($brand->id) }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            <span class="text-danger">
                                @error('brands')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="description">Product Description</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Enter product description" rows="5">{{ $product->description }}</textarea>
                            <span class="text-danger">
                                @error('description')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image">Product Image</label>
                            <input type="file" class="form-control" name="image" id="image">
                            <span class="text-danger">
                                @error('image')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <img style="width: 80px; border:3px solid #aaa; border-radius:5px;" src="{{ asset('image/product') }}/{{  $product->image  }}" alt="image">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="thumbnails">Product Thumbnails</label>
                            <input type="file" class="form-control" name="thumbnails[]" multiple="multiple" id="thumbnails">
                            <span class="text-danger">
                                @error('thumbnails')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        @foreach ($thumbnails as $thumbnail)
                            <img style="width: 80px;padding: 5px; border:3px solid #aaa; border-radius:5px" src="{{ asset('image/thumbnails') }}/{{  $thumbnail->thumbnails  }}" alt="thumbnail">
                        @endforeach
                    </div>
                </div><br>
                <button type="submit" class="btn btn-primary">Update Product</button>
            </form>
        </div>
    </div>
@endsection
@section('footer_script')
    <script type="text/javascript">
        $(document).ready(function () {
            if($("#description").length > 0){
                tinymce.init({
                    selector: "textarea#description",
                    theme: "modern",
                    height:250,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                    style_formats: [
                        {title: 'Bold text', inline: 'b'},
                        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                        {title: 'Example 1', inline: 'span', classes: 'example1'},
                        {title: 'Example 2', inline: 'span', classes: 'example2'},
                        {title: 'Table styles'},
                        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                    ]
                });
            }
        });
    </script>
@endsection
