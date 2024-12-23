@props(['orders'])


<x-layout>
    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex mb-4">
                            <h1 class="t" style="font-size:x-large; font-weight: bold">Purchased Orders</h1>
                        </div>

                        <form action="/orders" class="d-flex flex-column flex-sm-row gap-3 mb-3" method="GET">
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
                                    <th style="width: 150px;" scope="col">Email</th>
                                    <th >Amount</th>
                                    <th># of Products</th>
                                    <th>Total quantity</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $index => $order)
                                    <tr>
                                        <th style="width: 20px;">{{ $index + 1 }}</th>
                                        <td style="width: 200px;">{{\Illuminate\Support\Str::limit($order->user->name, 20)}}</td>
                                        <td><a href="mailto:{{$order->user->email}}">{{$order->user->email}}</a></td>
                                        <td>${{number_format($order->total_amount, 2, '.', ',')}}</td>
                                        <td>{{$order->products->count()}}</td>
                                        <td>{{$order->quantity}}</td>
                                        <td class="d-flex gap-2">
                                            <a href="{{ route('orders.show', $order->id) }}" target="_blank" class="btn btn-primary text-white">View Receipt</a>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="border border-white ">
                                                <h1 class="text-center text-xs" style="font-size:x-large; font-weight: bold">No Orders Found</h1>
                                            </td>
                                        </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>  
</x-layout>