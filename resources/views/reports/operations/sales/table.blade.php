<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th class="text-center text-nowrap" style="width: 40px">{{ __('form.no') }}</th>
            <th class="text-center text-nowrap" style="width: 50px">{{ __('form.code') }}</th>
            <th class="text-center text-nowrap" style="width: 20px">{{ __('form.tank') }}</th>
            <th class="text-center text-nowrap" style="width: 50px">{{ __('form.sale_date') }}</th>
            <th class="text-center text-nowrap" style="width: 70px">{{ __('form.oil_type') }}</th>                        
            <th class="text-center text-nowrap" style="width: 30px">{{ __('form.shift') }}</th>
            <th class="text-center text-nowrap" style="width: 80px">{{ __('form.staff') }}</th>
            <th class="text-center text-nowrap" style="width: 70px">{{ __('form.client') }}</th>
            
            <th class="text-center text-nowrap" style="width: 80px">{{ __('form.old_motor') }}{{ __('form.right') }}</th>
            <th class="text-center text-nowrap" style="width: 80px">{{ __('form.new_motor') }}{{ __('form.right') }}</th>
            <th class="text-center text-nowrap" style="width: 80px">{{ __('form.old_motor') }}{{ __('form.left') }}</th>
            <th class="text-center text-nowrap" style="width: 80px">{{ __('form.new_motor') }}{{ __('form.left') }}</th>
            <th class="text-center text-nowrap" style="width: 80px">{{ __('form.cost') }}</th>
            <th class="text-center text-nowrap" style="width: 60px">{{ __('form.qty') }}</th>
            
            <th class="text-center text-nowrap" style="width: 95px">{{ __('form.total_cost') }}</th>
            <th class="text-center text-nowrap" style="width: 95px">{{ __('form.price') }}</th>
            <th class="text-center text-nowrap" style="width: 95px">{{ __('form.total_price') }}</th>
            <th class="text-center text-nowrap" style="width: 95px">{{ __('form.total_revenue') }}</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalQty = 0;
            $totalCost = 0;
            $totalPrice = 0;
            $totalRevenue = 0;
        @endphp
        @foreach ($records as $record)
            <tr>
                @php
                    $totalQty = $totalQty + $record->qty;
                    $totalCost = $totalCost + $record->total_cost;
                    $totalPrice = $totalPrice + $record->total_price;
                    $totalRevenue = $totalRevenue + $record->total_revenue;
                @endphp
                <td class="text-center text-nowrap">{{ $loop->index + 1 }}</td>
                <td class="text-center text-nowrap">{{ $record->code??''}}</td>                            
                <td class="text-center text-nowrap">{{ $record->tank->name_kh??''}}</td>
                <td class="text-center text-nowrap">{{ $record->date??''}}</td>
                <td class="text-left text-nowrap">{{ $record->purchase->type->name_kh??''}}</td>                            
                <td class="text-left text-nowrap">{{ $record->shift->name_kh??''}}</td>
                <td class="text-left text-nowrap">{{ $record->staff->name_kh??''}}</td>
                <td class="text-left text-nowrap">{{ $record->client->name_kh??''}}</td>
                <td class="text-right text-nowrap">{{ number_format($record->old_motor_right,2) }} </td>
                <td class="text-right text-nowrap">{{ number_format($record->new_motor_right,2) }} </td>
                <td class="text-right text-nowrap">{{ number_format($record->old_motor_left,2) }} </td>
                <td class="text-right text-nowrap">{{ number_format($record->new_motor_left,2) }} </td>
                <td class="text-right text-nowrap">{{ number_format($record->cost,2) }} {{ $record->currency }}</td>
                <td class="text-right text-nowrap">{{ number_format($record->qty,2) }} {{ $record->unit }}</td>                
                <td class="text-right text-nowrap">{{ number_format($record->total_cost,2) }} {{ $record->currency }}</td>
                <td class="text-right text-nowrap">{{ number_format($record->price,2) }} {{ $record->currency }}</td>
                <td class="text-right text-nowrap">{{ number_format($record->total_price,2) }} {{ $record->currency }}</td>
                <td class="text-right text-nowrap">{{ number_format($record->total_revenue,2) }} {{ $record->currency }}</td>
            </tr>
        @endforeach
        <tr class="text-bold">
            <td colspan="13" class="text-center"> {{ __('form.total') }}</td>
            <td class="text-right text-nowrap">{{ number_format($totalQty,2) }} L</td>            
            <td class="text-right text-nowrap">{{ number_format($totalCost,2) }} KHR</td>
            <td class="text-center text-nowrap">-</td>
            <td class="text-right text-nowrap">{{ number_format($totalPrice,2) }} KHR</td>
            <td class="text-right text-nowrap">{{ number_format($totalRevenue,2) }} KHR</td>
        </tr>
        </tbody>
</table>  