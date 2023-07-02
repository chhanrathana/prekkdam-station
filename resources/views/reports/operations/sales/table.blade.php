<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th class="text-center text-nowrap">{{ __('form.no') }}</th>
            <th class="text-center text-nowrap">{{ __('form.code') }}</th>
            <th class="text-center text-nowrap">{{ __('form.sale_date') }}</th>
            <th class="text-center text-nowrap">{{ __('form.oil_type') }}</th>                        
            <th class="text-center text-nowrap" style="width: 30px">{{ __('form.shift') }}</th>
            <th class="text-center text-nowrap">{{ __('form.staff') }}</th>
            <th class="text-center text-nowrap">{{ __('form.client') }}</th>
            
            <th class="text-center text-nowrap" style="width: 80px">{{ __('form.old_motor') }}{{ __('form.right') }}</th>
            <th class="text-center text-nowrap" style="width: 80px">{{ __('form.new_motor') }}{{ __('form.right') }}</th>
            <th class="text-center text-nowrap" style="width: 80px">{{ __('form.old_motor') }}{{ __('form.left') }}</th>
            <th class="text-center text-nowrap" style="width: 80px">{{ __('form.new_motor') }}{{ __('form.left') }}</th>

            <th class="text-center text-nowrap" style="width: 95px">{{ __('form.qty') }}</th>
            <th class="text-center text-nowrap" style="width: 95px">{{ __('form.cost') }}</th>
            <th class="text-center text-nowrap" style="width: 95px">{{ __('form.total_cost') }}</th>
            <th class="text-center text-nowrap" style="width: 95px">{{ __('form.price') }}</th>
            <th class="text-center text-nowrap" style="width: 95px">{{ __('form.total_price') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($records as $record)
            <tr>
                <td class="text-center text-nowrap">{{ $loop->index + 1 }}</td>
                <td class="text-center text-nowrap">{{ $record->code??''}}</td>                            
                <td class="text-center text-nowrap">{{ $record->date??''}}</td>
                <td class="text-center text-nowrap">{{ $record->purchase->type->name_kh??''}}</td>                            
                <td class="text-center text-nowrap">{{ $record->shift->name_kh??''}}</td>
                <td class="text-center text-nowrap">{{ $record->staff->name_kh??''}}</td>
                <td class="text-center text-nowrap">{{ $record->client->name_kh??''}}</td>
                <td class="text-right text-nowrap">{{ number_format($record->old_motor_right,2) }} </td>
                <td class="text-right text-nowrap">{{ number_format($record->new_motor_right,2) }} </td>
                <td class="text-right text-nowrap">{{ number_format($record->old_motor_left,2) }} </td>
                <td class="text-right text-nowrap">{{ number_format($record->new_motor_left,2) }} </td>
                <td class="text-right text-nowrap">{{ number_format($record->qty,2) }} {{ $record->unit }}</td>
                <td class="text-right text-nowrap">{{ number_format($record->cost,2) }} {{ $record->currency }}</td>
                <td class="text-right text-nowrap">{{ number_format($record->total_cost,2) }} {{ $record->currency }}</td>
                <td class="text-right text-nowrap">{{ number_format($record->price,2) }} {{ $record->currency }}</td>
                <td class="text-right text-nowrap">{{ number_format($record->total_price,2) }} {{ $record->currency }}</td>
            </tr>
        @endforeach
        </tbody>
</table>  