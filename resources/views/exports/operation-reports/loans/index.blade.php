
<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/css/style.css" rel="stylesheet">
    <table class="table table-bordered">
    <thead>
        <tr>
            <th>ល.រ</th>
            <th>សភាព</th>
            <th>កូដអតិថិជន</th>
            <th>អតិថិជន</th>
            <th>ប្រភេទកម្ចី</th>
            <th>ថ្ងៃខ្ចី</th>
            <th>ចំនួនកម្ចី</th>
            <th>សមតុល្យ</th>
            <th>ការបរិច្ឆេទបង់ផ្តាច់</th>
        </tr>
    </thead>
    <tbody>
         @foreach ($loans as $loan)
        <tr>
            <td>{{ $loop->index+1}}</td>
            <td><span class="{{ $loan->_status->css }}">{{ $loan->_status->name_kh }}</span></td>
            <td>{{ $loan->client->code??''}}</td>
            <td>{{ $loan->client->name_kh??''}}</td>
            <td>{{ $loan->interest->name_kh??''}}</td>
            <td>{{ $loan->registration_date??''}}</td>
            <td>{{ number_format($loan->principal_amount) }}</td>
            <td>{{ number_format($loan->pending_amount) }}</td>
            <td>{{ $loan->last_end_interest_date??''}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</html>
