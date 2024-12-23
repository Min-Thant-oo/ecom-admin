@props(['propName'])
<x-layout>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="px-5">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                        <div class="card-body">
                            <h1 class="card-title" style="font-size:x-large; font-weight: bold">Create Category</h1>
                            <form class="forms-sample" method="POST" action="{{ route('categories.store') }}">
                                @csrf
                                @method('post')

                                <x-form.input name="name" />
                                <x-form.input name="slug" />

                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <a href="{{ route('categories.index') }}" class="btn btn-light">Cancel</a>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </x-layout>
    