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
                        <form class="forms-sample" method="POST" action="/admin/products/store" enctype="multipart/form-data">
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

                            <x-form.input name="price" type="number"/>
                            <x-form.input name="image" type="file"/>
                            
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <a href="/admin/products" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout>













































{{-- <x-layout>
    <div class=" d-flex justify-center mt-10 ml-10">
        <div class="col-7 grid-margin stretch-card">
          <div class="card custom-card border border-grey">
            <div class="card-body custom-card">
              <h4 class="card-title">Create New Blog</h4>
                <form class="forms-sample" method="POST" action="/admin/products/store" enctype="multipart/form-data" >
                    @csrf
                    @method('post')
                    <x-input name='thumbnail' type='file' class="border border-black p-2"/>
                    <x-input name='title' />
                    <x-input name='slug' />
                    <x-textarea name='body' />
    
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select required name="category" id="category" class="form-select border border-dark mb-1">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->slug}}" @selected(old('category') == $category->name)>{{ucwords($category->name)}}</option>
                            @endforeach
                        </select>
                        <a href="/createCategory" class="text-primary">Create New Category</a>
                        <x-error name="category" />
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <a href="/admin/products" class="btn btn-light me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary bg-primary">Submit</button>
                    </div>
                </form>
            </div>
          </div>
      </div>
    </div>
</x-layout> --}}