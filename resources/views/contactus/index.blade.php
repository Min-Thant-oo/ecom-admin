@props(['contactmessages'])


<x-layout>
    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <x-flashnoti :success="session('success')" />
                        <div class="d-flex mb-4">
                            <h1 class="t" style="font-size:x-large; font-weight: bold">Contact Messages</h1>
                        </div>

                        <form action="/contactmessages" class="d-flex flex-column flex-sm-row gap-3 mb-3" method="GET">
                            <div class="d-flex flex-column flex-grow-1 gap-2">
                                <label for="search" class="">Search</label>
                                <input type="text" id="search" name="search" value="{{request('search')}}" class="form-control p-2 rounded" placeholder="Please enter to search">
                            </div>

                            <div class=" d-flex flex-column">
                                <button type="submit" class="btn btn-primary mt-1 mt-sm-3 text-white">Filter</button>
                            </div>

                        </form>


                        <div class="table-responsive">
                            <table class="table table-striped mb-1">
                                <thead>
                                    <tr>
                                        <th scope="">#</th>
                                        <th>Name</th>
                                        <th >Email</th>
                                        <th >Subject</th>
                                        {{-- <th>Message</th> --}}
                                        <th>Messaged at</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($contactmessages as $index => $contactmessage)
                                        <tr>
                                            <th style="width: 20px;">{{ $index + 1 }}</th>
                                            <td style="width: 200px;">{{\Illuminate\Support\Str::limit($contactmessage->name, 20)}}</td>
                                            <td><a href="mailto:{{$contactmessage->email}}">{{$contactmessage->email}}</a></td>
                                            <td>{{$contactmessage->subject}}</td>
                                            {{-- <td>{{\Illuminate\Support\Str::limit($contactmessage->message, 30)}}</td> --}}
                                            <td>{{$contactmessage->created_at->format('Y-m-d')}}</td>
                                            <td class="d-flex gap-2">
                                                {{-- <a href="/contactmessages/{{$contactmessages->id}}" target="_blank" class="btn btn-primary text-white">View</a> --}}
                                                <button type="button" class="btn btn-primary bg-primary text-white" data-bs-toggle="modal" data-bs-target="#myModal{{ $contactmessage->id }}">View</button>
                                                <form 
                                                    action="{{ route('contactmessages.destroy', $contactmessage->id) }}" 
                                                    method="post" 
                                                    onsubmit="return confirm('Are you sure you want to delete?');"
                                                >
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger bg-danger text-white">Delete</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="myModal{{ $contactmessage->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content " style="margin-top: ;" >
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><strong>Message Info</strong></h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <strong>Name</strong> - {{$contactmessage->name}}
                                                    </div>
                                                    <div class="modal-body">
                                                        <strong>Email</strong> - <a href="mailto:{{$contactmessage->email}}" class="text-primary">{{$contactmessage->email}}</a>
                                                    </div>
                                                    <div class="modal-body">
                                                        <strong>Subject</strong> - {{$contactmessage->subject}}
                                                    </div>
                                                    <div class="modal-body">
                                                        <strong>Message</strong> - <div class="text-justify">{{$contactmessage->message}}</div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary bg-primary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        @empty
                                            <tr>
                                                <td colspan="7" class="border border-white ">
                                                    <h1 class="text-center text-xs" style="font-size:x-large; font-weight: bold">No Message Found</h1>
                                                </td>
                                            </tr>
                                        @endforelse
                                </tbody>
                            </table>
                            {{ $contactmessages->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>  
</x-layout>