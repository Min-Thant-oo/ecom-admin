@props(['products', 'categories'])

<x-layout>
    <div class="main-panel">
        <div class="content-wrapper">
            {{-- <x-flashnoti :success="session('success')" /> --}}
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <x-flashnoti :success="session('success')" />
                        <div class="d-flex flex-column flex-sm-row gap-2 gap-sm-0 justify-content-between mb-4">
                            <h1 class="mt-2" style="font-size:x-large; font-weight: bold">Products</h1>
                            <a href="/admin/products/create" class="btn btn-primary text-white">Create New Item</a>
                        </div>

                        <form action="/admin/products" class="d-flex flex-column flex-sm-row gap-3 col-md- mb-3" method="GET">
                            <div class="d-flex flex-column flex-grow-1 gap-2 col-md- ">
                                <label for="search">Search</label>
                                <input type="text" id="search" name="search" value="{{request('search')}}" class="form-control p-2 rounded" placeholder="Please enter to search">
                            </div>
                    
                            <div class="d-flex flex-column flex-grow-1 gap-2 col-md-">
                                <label for="category">Product category</label>
                                <select name="category" id="category" class="form-select p-1 border ">
                                    <option value="">All</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->slug}}" {{ request('category') == $category->slug ? 'selected' : '' }}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-flex flex-column justify-content-center">
                                <button type="submit" class="btn btn-primary mt-1 mt-sm-3 text-white">Filter</button>
                            </div>

                        </form>


                        <div class="table-responsive">

                            
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="">#</th>
                                    <th>Title</th>
                                    <th style="width: 150px;" scope="col">Image</th>
                                    <th>Price($)</th>
                                    <th >Description</th>
                                    <th scope="col">Category</th>
                                    <th scope="col"># of <span class="text-danger">hearts</span></th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products->reverse() as $index => $product)
                                    <tr>
                                        <th style="width: 20px;">{{ $index + 1 }}</th>
                                        <td style="width: px;">{{\Illuminate\Support\Str::limit($product->title, 10)}}</td>
                                        <td class="py-1">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#productModal{{ $product->id }}">
                                                <img 
                                                    {{-- src='{{ asset($product->image ? "/storage/$product->image" : `https://source.unsplash.com/random/?${$product->category->name}`) }}'  --}}
                                                    src="{{ asset($product->image ? "/storage/$product->image" : 'https://source.unsplash.com/random/?' . $product->id) }}"

                                                    alt="" 
                                                    style="object-fit:contain" 
                                                    width="50" 
                                                    height="50"
                                                >
                                            </a>
                                            {{-- <img src="/storage/{{$product->image}}" alt="" style="object-fit:contain"> --}}
                                        </td>
                                        <td>{{$product->price}}</td>
                                        <td style="width: px;">{{\Illuminate\Support\Str::limit($product->description, 15)}}</td>                                    <td>{{$product->category->name}}</td>
                                        <td>{{$product->users->count()}}</td>
                                        <td class="d-flex gap-2">
                                            <a href="/admin/products/{{$product->id}}/edit" class="btn btn-primary text-white">Edit</a>
                                            <form action="/admin/products/{{$product->id}}/delete" method="post" onsubmit="return confirm('Are you sure you want to delete?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger bg-danger text-white">Delete</button>
                                            </form>
                                            
                                        </td>
                                    </tr>

                                    {{-- example --}}
                                    @foreach ($products->reverse() as $index => $product)
                                        <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1" aria-labelledby="productModalLabel{{ $product->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        {{-- <h5 class="modal-title" id="productModalLabel{{ $product->id }}">{{ $product->title }}</h5> --}}
                                                        {{-- <h5 class="modal-title" id="productModalLabel{{ $product->id }}">$ {{ $product->price }}</h5> --}}
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img 
                                                            src="{{ asset($product->image ? "/storage/$product->image" : 'https://source.unsplash.com/random/?' . $product->id) }}"
                                                            {{-- src="/storage/{{ $product->image }}"  --}}
                                                            class="img-fluid" 
                                                            alt="{{ $product->title }}"
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach



                                    @empty
                                        <tr>
                                            <td colspan="7" class="border border-white ">
                                                <h1 class="text-center text-xs" style="font-size:x-large; font-weight: bold">No Products Found</h1>
                                            </td>
                                        </tr>
                                @endforelse
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>  
</x-layout>