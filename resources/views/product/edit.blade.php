@props(['product', 'categories'])

<x-layout>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="px-5">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <h1 class="card-title" style="font-size:x-large; font-weight: bold">Edit Product</h1>
                        <form class="forms-sample" method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <x-form.input name="title" value="{{$product->title}}" />
                            <x-form.input name="description" value="{{$product->description}}" />

                            <div class="form-group">
                                <label for="category">Category</label>
                                <select required name="category_id" id="category" class="form-select border p-2 mb-1">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option 
                                            @selected(old('category', $product->category->id) == $category->id)
                                            value="{{$category->id}}" 
                                        >{{ucwords($category->name)}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <x-form.input name="price" type="number" value="{{$product->price}}" />
                            
                            <x-form.input name="image" type="file"/>
                            
                            <img 
                                {{-- src="/storage/{{$product->image}}"  --}}
                                src="{{ asset($product->image ? "/storage/$product->image" : 'https://picsum.photos/520/450?random=' . $product->id) }}"
                                width="200px" 
                                height="100px" 
                                alt="" 
                                style="object-fit: contain"
                            >
                            
                            <button type="Submit" class="btn btn-primary me-2">Submit</button>
                            <a href="{{ route('products.index') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout>

