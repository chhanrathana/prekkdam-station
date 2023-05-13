
<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/css/style.css" rel="stylesheet">
    <table>
        <thead>
            <tr>
                <th>ល.រ</th>                
                <th>កូដអតិថិជន</th>
                <th>កូដកម្ចី</th>
                <th>អតិថិជន</th>
                <th>ថ្ងៃត្រូវបង់</th>                
                <th>ថ្ងៃបានបង់</th>
                <th>ប្រាក់បានបង់</th>
                <th>កាត់ប្រាក់ដើម</th>
                <th>ការប្រាក់</th>
                <th>សេវាប្រតិបត្តិការ</th>
                <th>សរុបការប្រាក់</th>                                
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
                $totalRevneueAmount = 0;
            @endphp
            @foreach ($payments as $payment)
                @php
                    $totalRevneueAmount = $totalRevneueAmount + $payment->revenue_amount;
                @endphp
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $payment->payment->loan->client->code??'' }}</td>
                    <td>{{ $payment->payment->loan->code??'' }}</td>
                    <td>{{ $payment->payment->loan->client->name_kh??'' }}</td>
                    <td>{{ $payment->payment->end_interest_date??'' }}</td>   
                    <td>{{ $payment->transaction_datetime??'' }}</td>   
                    <td>{{ number_format($payment->transaction_amount??0,2)  }}</td>              
                    <td>{{ number_format($payment->deduct_amount??0,2)  }}</td>
                    <td>{{ number_format($payment->interest_amount??0,2)  }}</td>
                    <td>{{ number_format($payment->commission_amount??0,2)  }}</td>
                    <td>{{ number_format($payment->revenue_amount??0,2)  }}</td>                                                            
                </tr>
            @endforeach  
            <tr>     
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ number_format($totalRevneueAmount??0,2)  }}</td>
            </tr>    
        </tbody>
    </table>
</html>
