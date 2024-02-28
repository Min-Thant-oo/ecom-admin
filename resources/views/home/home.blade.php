@props(['products', 'orders', 'users', 'totalSale', 'categories', 'data', 'bar'])
<x-layout>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                {{-- Top --}}

                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <p class="card-title text-xl-left">Total Revenue</p>
                        <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                            <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">${{$totalSale}}</h3>
                            <i class="ti-layers-alt icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                        </div>  
                        </div>
                    </div>
                </div>

                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <p class="card-title text-xl-left">Users</p>
                        <div class="d-flex flex-wrap justify-content-between  justify-content-xl-between align-items-center">
                            <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$users->count()}}</h3>
                            <i class="ti-user icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                        </div>  
                        </div>
                    </div>
                </div>

                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <p class="card-title text-xl-left"># of Products</p>
                        <div class="d-flex flex-wrap justify-content-between  justify-content-xl-between align-items-center">
                            <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$products->count()}}</h3>
                            <i class="ti-gift icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                        </div>  
                        </div>
                    </div>
                </div>

                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <p class="card-title text-xl-left">Orders</p>
                        <div class="d-flex flex-wrap justify-content-between  justify-content-xl-between align-items-center">
                            <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$orders->count()}}</h3>
                            <i class="ti-agenda icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                        </div>  
                        </div>
                    </div>
                </div>
                

                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title mb-5">User Spending Chart</h4>
                        <canvas class="mt-2" id="barChart"></canvas>
                      </div>
                    </div>
                </div>

                <div class="col-lg-6 grid-margin  stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title mb-5">Category Chart</h4>
                        <canvas class="mt-2" id="pieChart"></canvas>
                      </div>
                    </div>
                </div>
                  
                

                {{-- left side --}}
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="mb-4 card-title">Recently Added Products</p>

                            <div class="p-2" >
                                @foreach ($products->take(7) as $product)
                                        <div 
                                            {{-- class="d-flex flex-column flex-lg-row p-2 mb-5"  --}}
                                            class="row ps-3 pt-3 pb-2 mb-4 gap-" 
                                            style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"
                                        >
                                            {{-- <div class="col-sm-12 col-md-2 pe-md-5"> --}}
                                                <img 
                                                    src='{{ asset($product->image ? "/storage/$product->image" : 'https://source.unsplash.com/random/?' . $product->id) }}' 
                                                    alt="" 
                                                    style="width: 150px; height: 90px; object-fit: cover"
                                                >
                                            {{-- </div> --}}
                                            <div class="col-sm-12 col-md-8 col-xl- pt-2 pt-md-0 ">
                                                <p class="card-description mb-2">{{$product->category->name}}</p>
                                                <p>${{$product->price}}</p>
                                                <h4 class="card-title text-primary mb-2">{{$product->title}}</h4>
                                                <p class="justify">{{ Str::limit($product->description, 100, '...') }}</p>

                                            </div>
                                        </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- recent purchased orders --}}
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <p class="mb-4 card-title">Recent Purchased Orders</p>
            
                        @foreach ($orders->take(5) as $order)
                            <div class=" p-4 pb-2 mb-4 pt- border rounded cursor-pointer">
                              <div class="col-md-12">
                                  <h4 class="card-title text-primary mb-2">Transactions ID - {{$order->transaction_id}}</h4>
                                  <p class="mb-2">Customer Name - {{$order->user->name}}</p>
                                  <p class="mb-2">Customer Email - <a href="mailto:{{$order->user->email}}" style="text-decoration: none">{{$order->user->email}}</a></p>
                                  <p class="mb-2">Total amount - ${{ number_format($order->total_amount, 2) }}</p>
                                  <p class="mb-2"># of products - {{$order->products()->count()}}</p>
                                  <p class="mb-2">Total quantity - {{$order->quantity}}</p>
                              </div>
                            </div>
                        @endforeach 
                      </div>
                    </div>
                </div>




                    

            </div>
        </div>
    </div>

    
<script>
    var ctx = document.getElementById('pieChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: @json($data['labels']),
            datasets: [{
                data: @json($data['data']),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1
            }]
        },
    });





    var ctx = document.getElementById('barChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: @json($bar['labels']),
        datasets: [{
            label: 'Money Spent',
            data: @json($bar['data']),
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            x: {
                beginAtZero: true
            }
        },
        plugins: {
            legend: {
                position: 'top'
            }
        },
        layout: {
            padding: {
                left: 10,
                right: 10,
                top: 0,
                bottom: 10
            }
        },
        scales: {
            x: {
                ticks: {
                    autoSkip: false, // This prevents ticks from being skipped
                    maxRotation: 0,  // Rotates the labels to 0 degrees
                    minRotation: 0   // Rotates the labels to 0 degrees
                }
            },
            y: {
                beginAtZero: true
            }
        }
    }
});

    
</script>
    
    
</x-layout>






