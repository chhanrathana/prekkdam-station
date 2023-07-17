<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <div class="text-center heading-title-center khmer-moul">
        តារាងលក់ប្រចាំថ្ងៃ
        <br/>
        {{  $fromDate }} - {{ $toDate }}
    </div>
    <div class="text-right">
        <small class="print-date"><i>printed at {{ \Carbon\Carbon::now() }}</i></small>   
    </div>
    @include('reports.operations.sales.table')
</html>