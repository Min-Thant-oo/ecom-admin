@props(['category'])

<x-layout>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="px-5">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                        <div class="card-body">
                            <h1 class="card-title" style="font-size:x-large; font-weight: bold">Edit Category</h1>
                            <form class="forms-sample" method="POST" action="{{ route('categories.update', $category->id) }}">
                                @csrf
                                @method('patch')

                                <x-form.input name="name" value="{{$category->name}}" />
                                <x-form.input name="slug" value="{{$category->slug}}" />

                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <a href="/categories" class="btn btn-light">Cancel</a>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
    