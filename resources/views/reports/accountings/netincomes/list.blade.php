<div class="card">
    <div class="card-header text-white bg-info">    
        <i class="fas fa-list"></i>
        <strong>{{ __('form.accounting_netincome_list') }}</strong>  
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
                        <td colspan="9" class="text-right text-bold">{{ __('form.total') }}</td>
                    </tr>
                    <tr class="table-warning">
                        <td colspan="8" class="text-left text-bold">1. ចំណូល</td>
                        <td class="text-right text-nowrap text-bold">{{ number_format($interestRevenue->total_interest_amount,2) }} KHR</td>
                    </tr>
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">1.1 ចំណូលការប្រាក់</td>
                        <td class="text-right text-nowrap">{{ number_format($interestRevenue->total_interest_amount,2) }} KHR</td>
                    </tr>               
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">1.2 ចំណូលផ្សេងៗ</td>
                        <td class="text-right text-nowrap">{{ number_format(0,2) }} KHR</td>
                    </tr>
                    
                    <tr class="table-warning">
                        <td colspan="8" class="text-left text-bold">2. ចំណាយ</td>
                        <td class="text-right text-nowrap text-bold">{{ number_format($interestExpense->total_interest_amount,2) }} KHR</td>
                    </tr>
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">2.1 ការប្រាក់អោយសមាជិកសន្សំ</td>
                        <td class="text-right text-nowrap">{{ number_format($interestExpense->total_interest_amount,2) }} KHR</td>
                    </tr>
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">2.2 ចំណាយផ្សេងៗ</td>
                        <td class="text-right text-nowrap">{{ number_format(0,2) }} KHR</td>
                    </tr>

                    <tr class="table-warning mb-2">
                        <td colspan="8" class="text-left text-bold">3. ចំណេញដុល	(1 - 2)</td>
                        <td class="text-right text-nowrap">{{ number_format($interestRevenue->total_interest_amount - $interestExpense->total_interest_amount) }} KHR</td>
                    </tr>

                    
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">5.1 ប្រាក់បំរុងសមាគម (10.00%)</td>
                        <td class="text-right text-nowrap">{{ number_format(0,2) }} KHR</td>
                    </tr>
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">5.2 ប្រាក់ទ្រទ្រង់សមាគម	0.00%</td>
                        <td class="text-right text-nowrap">{{ number_format(0,2) }} KHR</td>
                    </tr>
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">5.3 ទ្រទ្រង់ថ្នាក់ជាតិ	0.00%</td>
                        <td class="text-right text-nowrap">{{ number_format(0,2) }} KHR</td>
                    </tr>
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">5.4 ប្រាក់បណ្តុះបណ្តាល	0.00%</td>
                        <td class="text-right text-nowrap">{{ number_format(0,2) }} KHR</td>
                    </tr>

                    <tr class="table-warning mb-2">
                        <td colspan="8" class="text-left text-bold">6. ផលចំណេញសំរាប់ម្ចាស់ភាគហ៊ុន		(5 - 5.1 - 5.2 - 5.3)</td>
                        <td class="text-right text-nowrap">{{ number_format($interestRevenue->total_interest_amount - $interestExpense->total_interest_amount) }} KHR</td>
                    </tr>

                    
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">ភាគហ៊ុនសង្គម</td>
                        <td class="text-right text-nowrap">{{ number_format(0,2) }} KHR</td>
                    </tr>
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">ភាគហ៊ុនយកភាគលាភ</td>
                        <td class="text-right text-nowrap">{{ number_format(0,2) }} KHR</td>
                    </tr>


                </tbody>
            </table>
        </div>        
    </div>
</div>