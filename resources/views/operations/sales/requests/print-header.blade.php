<div class="text-center heading-title-center khmer-moul"><h4>{{ __('form.payment_schedule') }}</h4></div>
<div class="row">
    <table style="width: 100%; font-size:12px" class="table-non-border td-border-non line-height-2">
        <tr>
            <td>{{ __('form.client_code') }}</td>
            <td>{{$record->client->code}}</td>                
            <td>{{ __('form.loan_code') }}</td>
            <td>{{$record->code}}</td> 
        </tr>
        <tr>                                           
            <td >{{ __('form.client') }}</td>
            <td>{{$record->client->name_kh}}</td>
            <td>{{ __('form.phone_number') }}</td>
            <td>{{$record->client->phone_number}}</td>        
        </tr>
        <tr>
            <td>{{ __('form.address') }}</td>
            <td>{{$record->client->address}}</td>                
        </tr>
        <tr>                
            <td>{{ __('form.principal_amount') }}</td>
            <td>{{ number_format($record->principal_amount, 2) }}</td>
            <td>{{ __('form.interest_rate') }}</td>
            <td>{{ number_format($record->interest_rate, 2)}} %</td>
        </tr>
        <tr>
            <td>{{ __('form.registration_date') }}</td>
            <td>{{$record->registration_date}}</td>

            <td>{{ __('form.term') }}</td>
            <td>{{$record->term}} </td>
        </tr>           
    </table>
</div>
<div class="text-right">
    <small class="print-date"><i>printed at {{ \Carbon\Carbon::now() }}</i></small>   
</div>

