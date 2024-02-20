@props(['receipt'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Receipt</title>
</head>
<body>
    <div style="max-width: 1000px; margin: auto; padding: 40px; background-color: white; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);" id="invoice">
        {{-- div a --}}
        <div style="font-family: Arial, sans-serif; overflow: auto; clear: both;">
            {{-- 1 --}}
            <div style="float: left; width: 100px;">
            <img src="https://companieslogo.com/img/orig/AMZN-e9f942e4.png?t=1632523695" alt="company-logo" height="100" width="100" />
            {{-- <h1>Amazon 2.0</h1> --}}
            </div>
        
            {{-- 2 --}}
            <div style="float: right; width: calc(100% - 120px); text-align: right;">
            <p>Amazon 2.0</p>
            <p style="color: #718096; font-size: 0.875rem;">amazon2.com</p>
            <p style="color: #718096; font-size: 0.875rem; margin-top: 0.25rem;">+1(414)414-4141</p>
            <p style="color: #718096; font-size: 0.875rem; margin-top: 0.25rem;">support.amazon@gmail.com</p>
            </div>
        </div>

        {{-- div b --}}
        <div style="clear: both;">
            {{-- 3 --}}
            <div style="float: left; width: 50%;">
                <p style="font-weight: bold; color: #2d3748;">Bill to :</p>
                <p style="color: #718096;">{{ $receipt->user->name }}
                    <p style="color: #718096;">102, San-Fransico, CA, USA</p>
                </p>
                <p style="color: #718096;">
                {{ $receipt->user->email }}
                </p>
            </div>

            {{-- 4 --}}
            <div style="float: left; width: 50%; text-align: right; margin-top: 0.25rem">
                <p>Receipt id: <span style="color: #718096;">{{ $receipt->id }}</span></p>
                <p>Receipt number: <span style="color: #718096;">{{ $receipt->transaction_id }}</span></p>
                <p>Receipt date: <span style="color: #718096;">{{ \Carbon\Carbon::parse($receipt->created_at)->format("d M Y H:i") }}</span></p>
            </div>
        </div>

        <div style=" clear: both; text-align: right;">
            <table style="width: 100%; margin-top: 2rem;">
                <colgroup>
                    <col style="width: 100%;" />
                    <col style="width: 16.66667%;" />
                    <col style="width: 16.66667%;" />
                    <col style="width: 16.66667%;" />
                </colgroup>
                <thead style="border-bottom:1px solid #cbd5e0; color: #2d3748;">
                    <tr>
                        <th style="padding: 1rem 0.75rem; text-align: left; font-size: 1rem; font-weight: 600;">Items</th>
                        <th style="padding: 1rem 0.75rem; text-align: right; font-size: 1rem; font-weight: 600;">Quantity</th>
                        <th style="padding: 1rem 0.75rem; text-align: right; font-size: 1rem; font-weight: 600;">Price</th>
                        <th style="padding: 1rem 1rem; text-align: right; font-size: 1rem; font-weight: 600;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($receipt->products as $product)
                        <tr style="color: #2d3748;">
                            <td style="max-width: 0; padding: 1rem 0.75rem; text-align: left; font-size: 1rem; border-bottom: 1px solid #cbd5e0;">
                                <div style="font-weight: 600; color: #2d3748;">{{ $product->title }}</div>
                                <div style="margin-top: 0.25rem; color: #718096; overflow: hidden;
                                    text-overflow: ellipsis;
                                    white-space: nowrap;">{{ $product->description }}</div>
                            </td>
                            <td style="padding: 1rem 0.75rem; text-align: right; font-size: 1rem; border-bottom: 1px solid #cbd5e0; color: #718096;">{{ $product->pivot->quantity }}</td>
                            <td style="padding: 1rem 0.75rem; text-align: right; font-size: 1rem; border-bottom: 1px solid #cbd5e0; color: #718096;">${{ $product->price }}</td>
                            <td style="padding: 1rem 1rem; text-align: right; font-size: 1rem; border-bottom: 1px solid #cbd5e0; color: #718096;">${{ $product->pivot->quantity * $product->price }}</td>
                        </tr>
                    @endforeach

                </tbody>
                <tfoot style="">
                    <tr>
                        <th style="padding: 1rem 0.75rem; text-align: right; font-size: 1rem; font-weight: 400; color: #718096;">Subtotal</th>
                        <td></td>
                        <td></td>
                        <td style="padding: 1rem 1rem; text-align: right; font-size: 1rem; color: #718096;">${{ $receipt->total_amount }}</td>
                    </tr>
                    <tr>
                        <th style="padding: 1rem 0.75rem; text-align: right; font-size: 1rem; font-weight: 400; color: #718096;">Tax</th>
                        <td></td>
                        <td></td>
                        <td style="padding: 1rem 1rem; text-align: right; font-size: 1rem; color: #718096;">$00.00</td>
                    </tr>
                    <tr>
                        <th style="padding: 1rem 0.75rem; text-align: right; font-size: 1rem; font-weight: 400; color: #718096;">Discount</th>
                        <td></td>
                        <td></td>
                        <td style="padding: 1rem 1rem; text-align: right; font-size: 1rem; color: #718096;">0%</td>
                    </tr>
                    <tr>
                        <th style="padding: 1rem 0.75rem; text-align: right; font-size: 1rem; font-weight: 600; color: #2d3748;">Total</th>
                        <td></td>
                        <td></td>
                        <td style="padding: 1rem 1rem; text-align: right; font-size: 1rem; font-weight: 600; color: #2d3748;">${{ $receipt->total_amount }}</td>
                    </tr>
                </tfoot>
                
            </table>
        </div>
        <div style="border-top: 2px solid #cbd5e0; padding-top: 1rem; font-size: 0.875rem; color: #718096; text-align: center; margin-top: 1.6rem;">
            Thank you for shopping with Amazon 2.0
        </div>
    </div>
</body>
</html>
