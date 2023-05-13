<div class="card">
    <div class="card-header text-white bg-info">    
        <i class="fas fa-list"></i>
        <strong>{{ __('form.accounting_cashflow_list') }}</strong>  
    </div>
    <div class="card-body">                
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id ="table">            
                <tbody>
                    @php
                    $totalBalanceAmount = 0;
                    $totalInterestAmount = 0;
                    $totalPrincipalAmount = 0;
                    $i = 1;
                @endphp
                    <tr class="table-success">
                        <td colspan="9" class="text-right">{{ __('form.total') }}</td>
                    </tr>
                    <tr class="table-warning">
                        <td colspan="8" class="text-left text-bold">1. ប្រាក់ហូរចូល</td>
                        <td class="text-right text-nowrap">{{ number_format($loanCashIn->total_interest_paid_amount + $loanCashIn->total_deduct_paid_amount + $depositCashIn->total_deposit_amount,2) }} KHR</td>
                    </tr>
         
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">1.1 ចំណូលការប្រាក់</td>
                        <td class="text-right text-nowrap">{{ number_format($loanCashIn->total_interest_paid_amount,2) }} KHR</td>
                    </tr>
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">1.2 ប្រាក់ដើមសងត្រលប់</td>
                        <td class="text-right text-nowrap">{{ number_format($loanCashIn->total_deduct_paid_amount,2) }} KHR</td>
                    </tr>
                    {{-- <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">1.3 ដាក់ភាគហ៊ុនបន្ថែម</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">1.4 ដាក់ភាគហ៊ុនសង្គម</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr> --}}
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">1.3 ដាក់ប្រាក់សន្សំ</td>
                        <td class="text-right text-nowrap">{{ number_format($depositCashIn->total_deposit_amount, 2) }} KHR</td>
                    </tr>
                    
                    {{-- <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">1.6 ដាក់ប្រាក់បញ្ញើ</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">1.7 សមាគមសន្សំ</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr> --}}
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">1.4 ចំណូលផ្សេងៗ</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>


                    <tr class="table-warning">
                        <td colspan="8" class="text-left text-bold">2. ប្រាក់ហូរចេញ</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>
                    




                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">2.1 សងទៅសមាគមខាងក្រៅ</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">2.2 ប្រាក់ដែលគេដក</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">2.3 បញ្ចេញប្រាក់កម្ចី</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>    
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">2.4 ចំណាយរដ្ឋបាល</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">2.5 ចំណាយទ្រទ្រង់សមាគម</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>  
                    
                    
                  

                    <tr class="table-warning mb-2">
                        <td colspan="8" class="text-left text-bold">3. តុល្យភាពហូរចូលនិងហូរចេញ (1 - 2)</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>

                    <tr class="table-warning">
                        <td colspan="8" class="text-left text-bold">4. សាច់ប្រាក់សល់ក្នុងដៃខែមុន	</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>
                    <tr class="table-warning">
                        <td colspan="8" class="text-left text-bold">5. សាច់ប្រាក់សល់ក្នុងដៃបច្ចុប្បន្ន		(3 + 4)</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>
                    
                </tbody>
            </table>
        </div>        
    </div>
</div>