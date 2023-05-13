
<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/css/style.css" rel="stylesheet">

    <div class="row">
        <table style="width: 100%; font-size:12px" class="table-non-border td-border-non line-height-2">
            <tr>
                <td>កូដអតិថិជន</td>
                <td>{{$loan->client->code}}</td>
                <td>ភ្នាក់ងារ</td>
                <td> {{$loan->staff->name_kh??''}} </td>
            </tr>
            <tr>
                <td>លេខកូដកម្ចី</td>
                <td>{{$loan->code}}</td>

                <td>លេខទូរសព្ទភ្នាក់ងារ</td>
                <td>{{$loan->staff->phone_number??''}} </td>
            </tr>
            <tr>
                <td >អតិថិជន</td>
                <td>{{$loan->client->name_kh}}</td>

                <td>ប្រភេទកម្ចី</td>
                <td>{{$loan->interest->name_kh??''}} </td>
            </tr>
            <tr>
                <td>អាសយដ្ឋាន</td>
                <td>{{$loan->client->address}}</td>

                <td>ចំនួនកាលវិភាគ</td>
                <td>{{count($loan->payments)}} </td>
            </tr>
            <tr>
                <td>លេខទូរសព្ទ</td>
                <td>{{$loan->client->phone_number}}</td>

                <td>ចំនួនទឹកប្រាក់</td>
                <td>{{ number_format($loan->principal_amount) }}</td>
            </tr>
            <tr>
                <td>ជំហាន</td>
                <td>{{$loan->client->loans->count()}}</td>
                <td>រូបិយប័ណ្ណ</td>
                <td>រៀល </td>
            </tr>
            <tr>
                <td>ថ្ងៃសងដំបូង</td>
                <td>{{$loan->start_end_interest_date}}</td>

                <td>ថ្ងៃផុតកំណត់</td>
                <td>{{$loan->last_end_interest_date}} </td>
            </tr>
        </table>
    </div>
    
    <table>
        <thead>
            <tr>
                <th class="text-center text-nowrap">បង់លើកទី</th>
                <th class="text-center text-nowrap">សភាព</th>
                <th class="text-center text-nowrap">ថ្ងៃបង់ប្រាក់</th>
                <th class="text-center text-nowrap">ប្រាក់ដើម</th>
                <th class="text-center text-nowrap">ការប្រាក់</th>
                <th class="text-center text-nowrap">សេវាប្រតិបត្តិការ</th>
                <th class="text-center text-nowrap">ប្រាក់ត្រូវបង់សរុប</th>
                <th class="text-center text-nowrap">សមតុល្យ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loan->payments as $payment)
            <tr>
                <td class="text-right text-nowrap">{{ $payment->sort }}</td>
                <td class="text-center text-nowrap"><span class="{{ $payment->_status->css }}">{{ $payment->_status->name_kh }}</span></td>
                <td>{{ convertDaytoKhmer(date('D',strtotime($payment->getRawOriginal('end_interest_date')))).' '.$payment->end_interest_date }}</td>
                <td class="text-right text-nowrap">{{ number_format($payment->deduct_amount) }}</td>
                <td class="text-right text-nowrap">{{ number_format($payment->interest_amount) }} </td>
                <td class="text-right text-nowrap">{{ number_format($payment->commission_amount) }} </td>
                <td class="text-right text-nowrap">{{ number_format($payment->total_amount) }} </td>
                <td class="text-right text-nowrap">{{ number_format($payment->pending_amount) }} </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</html>
