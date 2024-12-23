@props(['categories'])

<x-layout>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="px-5">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <h1 class="card-title" style="font-size:x-large; font-weight: bold">Create Product</h1>
                        <form class="forms-sample" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf
                            @method('post')

                            <x-form.input name="title" />
                            <x-form.input name="description" />

                            <div class="form-group">
                                <label for="category">Category</label>
                                <select required name="category_id" id="category" class="form-select border p-2 mb-1">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}" @selected(old('category') == $category->name)>{{ucwords($category->name)}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <x-form.input name="price" type="number" step="0.01" />
                            <x-form.input name="image" type="file"/>
                            
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
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