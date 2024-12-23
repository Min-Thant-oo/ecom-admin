@props(['categories'])


<x-layout>
    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <x-flashnoti :success="session('success')" />
                        <div class="d-flex flex-column flex-sm-row gap-2 gap-sm-0 justify-content-between mb-4">
                            <h1 class="" style="font-size:x-large; font-weight: bold">Categories</h1>
                            <a href="{{ route('categories.create') }}" class="btn btn-primary text-white">Create New Item</a>
                        </div>

                        <form action="/categories" class="d-flex flex-column flex-sm-row gap-3 mb-3" method="GET">
                            <div class="d-flex flex-column gap-2 flex-grow-1">
                                <label for="search" class="">Search</label>
                                <input type="text" id="search" name="search" value="{{request('search')}}" class="form-control p-2 rounded" placeholder="Please enter to search">
                            </div>

                            <div class="d-flex flex-column justify-content-center">
                                <button type="submit" class="btn btn-primary mt-1 mt-sm-3 text-white">Filter</button>
                            </div>

                        </form>


                        <div class="table-responsive">

                            
                        <table class="table table-striped mb-1">
                            <thead>
                                <tr>
                                    <th scope="">#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $index => $category)
                                    <tr>
                                        <th style="width: 20px;">{{ $index + 1 }}</th>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->slug}}</td>
                                        <td class="d-flex gap-2">
                                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary text-white">Edit</a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger bg-danger text-white">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="border border-white ">
                                                <h1 class="text-center text-xs" style="font-size:x-large; font-weight: bold">No Categories Found</h1>
                                            </td>
                                        </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>  
</x-layout>