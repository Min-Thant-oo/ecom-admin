@props(['user'])

<x-layout>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="px-5">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <x-flashnoti :success="session('success')" />
                        <h1 class="card-title" style="font-size:x-large; font-weight: bold">Admin Info</h1>
                        <form class="forms-sample" method="POST" action="/admin/info/{{$user->id}}/update">
                            @csrf
                            @method('patch')

                            <x-form.input name="name" value="{{$user->name}}" />
                            <x-form.input name="email" value="{{$user->email}}" />
                            <x-form.input name="phone" value="{{$user->phone}}"/>


                            <button type="Submit" class="btn btn-primary me-2">Submit</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout>

