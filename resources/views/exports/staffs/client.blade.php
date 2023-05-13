
<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/css/style.css" rel="stylesheet">
    <table class="table table-bordered table-striped table-hover" id ="table">
        <thead>
            <tr>
                <th>ល.រ</th>
                <th>សភាព</th>
                <th>កូដអតិថិជន</th>
                <th>អតិថិជន</th>
                <th>លេខទូរសព្ទ</th>
                <th>ប្រភេទកម្ចី</th>
                <th>ការប្រាក់</th>
                <th>សេវា</th>
                <th>រដ្ឋបាល</th>
                <th>ថ្ងៃខ្ចី</th>
                <th>ចំនួនកម្ចី</th>
                <th>សមតុល្យ</th>
                <th>ប្រាក់ដើមក្នុងដៃអតិថិជន</th>
                <th>ប្រាក់ដើមយឺត</th>
                <th>សមតុល្យ</th>
                <th>ការបរិច្ឆេទបង់ផ្តាច់</th>បង់លើកទី
                <th>អាសយដ្ឋាន</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalPrincipleAmount = 0;
                $totalPendingAmount = 0;
                $totalLateAmount = 0;
                $totalInhandAmount = 0;
                $totalPendingAmount = 0;

            @endphp
            @foreach ($loans as $loan)
            @php
                $totalPrincipleAmount = $totalPrincipleAmount + $loan->principal_amount;
                $totalPendingAmount = $totalPendingAmount + $loan->pending_amount;
                $totalLateAmount = $totalLateAmount+ $loan->sum_late_deduction;
                $inhandAmount = ($loan->pending_amount >= $loan->sum_late_deduction)? ($loan->pending_amount - $loan->sum_late_deduction):0;
                $totalInhandAmount = $totalInhandAmount + $inhandAmount;
            @endphp
            <tr>
                <td>{{ $loop->index+1}}</td>
                <td>{{ $loan->_status->name_kh }}</td>
                <td>{{ $loan->client->code??''}}</td>
                <td>{{ $loan->client->name_kh??''}}</td>
                <td>{{ $loan->client->phone_number??''}}</td>
                <td>{{ $loan->interest->name_kh??''}}</td>
                <td>{{ number_format($loan->rate) }} %</td>
                <td>{{ number_format($loan->commission_rate)}} %</td>
                <td>{{ number_format($loan->admin_rate)}} %</td>
                <td>{{ $loan->registration_date??''}}</td>
                <td>{{ number_format($loan->principal_amount) }}</td>
                <td>{{ number_format($loan->pending_amount) }}</td>
                <td>{{ number_format($inhandAmount) }}</td>
                <td>{{ number_format($loan->sum_late_deduction) }}</td>

                <td>{{ $loan->last_end_interest_date??''}}</td>
                <td>{{ $loan->client->address??''}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="10"></td>
                <td>{{ number_format($totalPrincipleAmount) }}</td>
                <td>{{ number_format($totalPendingAmount) }}</td>
                <td>{{ number_format($totalInhandAmount) }}</td>
                <td>{{ number_format($totalLateAmount) }}</td>
            </tr>
        </tbody>
    </table>
</html>
