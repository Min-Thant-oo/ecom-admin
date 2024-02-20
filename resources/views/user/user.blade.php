@props(['users'])

<x-layout>
    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h1 class="text-xs" style="font-size:x-large; font-weight: bold">Users</h1>
                        </div>

                        <form action="/admin/users" class="d-flex flex-column flex-sm-row gap-3 mb-3" method="GET">
                            <div class="d-flex flex-column flex-grow-1 gap-2">
                                <label for="search" class="">Search</label>
                                <input type="text" id="search" name="search" value="{{request('search')}}" class="form-control p-2 rounded" placeholder="Please enter to search">
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
                                    <th>Name</th>
                                    <th>Profile Picture</th>
                                    <th>Email</th>
                                    <th># of Orders</th>
                                    <th scope="col">Total Money Spent($)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users->reverse() as $index => $user)
                                    <tr>
                                        <th style="width: 20px;">{{ $index + 1 }}</th>
                                        <td>{{$user->name}}</td>
                                        <td>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#userModal{{ $user->id }}">
                                                <img 
                                                    src="{{ asset($user->image ? "/storage/$user->image" : 'https://source.unsplash.com/random/?' . $user->id) }}"
                                                    alt=""
                                                >           
                                            </a>   
                                        </td>
                                        <td><a href="mailto:{{$user->email}}" style="text-decoration: none">{{$user->email}}</a></td>
                                        <td>{{$user->orders->count()}}</td>
                                        <td>${{ number_format($user->orders->sum('total_amount'), 2, '.', ',') }}</td>
                                    </tr>


                                    @foreach ($users->reverse() as $index => $user)
                                        <div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1" aria-labelledby="userModalLabel{{ $user->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="userModalLabel{{ $user->id }}">{{ $user->name }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img 
                                                            src="{{ asset($user->image ? "/storage/$user->image" : 'https://source.unsplash.com/random/?' . $user->id) }}"
                                                            class="img-fluid" 
                                                            alt="{{ $user->name }}"
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    @empty
                                        <tr>
                                            <td colspan="7" class="border border-white ">
                                                <h1 class="text-center text-xs" style="font-size:x-large; font-weight: bold">No Users Found</h1>
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