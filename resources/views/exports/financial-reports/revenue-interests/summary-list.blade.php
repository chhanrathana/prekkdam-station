<table class="table table-bordered table-striped table-hover" id ="table">
    <thead>
        <tr>            
            <th class="text-center text-nowrap">ល.រ</th>
            <th class="text-center text-nowrap">សាខា</th>
            <th class="text-center text-nowrap">ថ្ងៃបង់ប្រាក់</th>
            <th class="text-center text-nowrap">ប្រតិបត្តិការ</th>
            <th class="text-center text-nowrap">ប្រាក់បានបង់</th>
            <th class="text-center text-nowrap">ប្រាក់ដើម</th>
            <th class="text-center text-nowrap">ការប្រាក់សរុប</th>                        
        </tr>
    </thead>
    <tbody>
        @php
            $totalTransaction = 0;
            $totalPaidAmount = 0;
            $totalDeductionAmount = 0;
            $totalInterestAmount = 0;
        @endphp
        
        @php
            $i = 1;
        @endphp
        @foreach ($payments as $payment)
        @php
            $totalTransaction = $totalTransaction + $payment->count_transaction;
            $totalPaidAmount = $totalPaidAmount + $payment->total_transaction_amount;
            $totalDeductionAmount = $totalDeductionAmount + $payment->total_deduct_amount;
            $totalInterestAmount = $totalInterestAmount + $payment->total_revenue_amount;
        @endphp
        <tr>                       
            <td class="text-right text-nowrap">{{ $i++ }}</td>
            <td class="text-center text-nowrap">{{ $payment->branch->name_kh??'' }}</td>
            <td class="text-center text-nowrap">{{ $payment->transaction_date }}</td>
            <td class="text-right text-nowrap">{{ number_format($payment->count_transaction)}}</td>
            <td class="text-right text-nowrap">{{ number_format($payment->total_transaction_amount)}}</td>
            <td class="text-right text-nowrap">{{ number_format($payment->total_deduct_amount)}}</td>
            <td class="text-right text-nowrap">{{ number_format($payment->total_revenue_amount)}}</td>                        
        </tr>
        @endforeach

        <tr>
            <td colspan="3" class="text-right text-nowrap">សរុប</td>
            <td class="text-right text-font-bold"><strong>{{ number_format($totalTransaction)}}</strong> </td>
            <td class="text-right text-font-bold"><strong>{{ number_format($totalPaidAmount)}}</strong> </td>
            <td class="text-right text-font-bold"><strong>{{ number_format($totalDeductionAmount)}}</strong></td>
            <td class="text-right text-font-bold"><strong>{{ number_format($totalInterestAmount)}}</strong></td>                             
        </tr>                    
    </tbody>
</table>