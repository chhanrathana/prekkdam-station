<div class="card">
    <div class="card-header text-white bg-info">    
        <i class="fas fa-list"></i>
        <strong>{{ __('form.accounting_balancesheet_list') }}</strong>  
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
                        <td colspan="8" class="text-left text-bold">1. សរុបទ្រព្យ</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>
                    
                    
                    
                    
                    
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">1.1 សាច់ប្រាក់ក្នុងដៃ</td>
                        <td class="text-right text-nowrap">7,156,400៛ </td>
                    </tr>
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">1.2 ឥណទាននៅដៃអតិថិជន (បុគ្គល)</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">1.3 ឥណទាននៅដៃអតិថិជន (សមាគម)</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">1.4 ការប្រាក់នៅជំពាក់</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">1.5 បុរេប្រទាន</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>
                                      


                    <tr class="table-warning">
                        <td colspan="8" class="text-left text-bold">2. សរុបបំណុល</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">2.1 សមាជិកសន្សំ</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">2.2 សមាជិកបញ្ញើ</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">2.3 សមាគមសន្សំ</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>    
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">2.4 ទ្រទ្រង់ថ្នាក់ជាតិ</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">2.5 ជំពាក់ការប្រាក់</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>  

                    	
	
	
	
	
                    
                    <tr class="table-warning">
                        <td colspan="8" class="text-left text-bold">3. សរុបមូលធន</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">3.1 ដើមទុនរបស់ម្ចាស់ភាគហ៊ុន</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">3.2 ភាគហ៊ុនសង្គម</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">3.3 ប្រាក់បំរុងសមាគម</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>    
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">3.4 ប្រាក់ទ្រទ្រង់សមាគម</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>
                    <tr class="table-default">
                        <td class="text-left"></td>
                        <td colspan="7" class="text-left">3.5 ប្រាក់បណ្តុះបណ្តាល</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>  
                  
                    <tr class="table-warning mb-2">
                        <td colspan="8" class="text-left text-bold">សរុបបំណុល និងមូលធន			</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                    </tr>                   
                </tbody>
            </table>
        </div>        
    </div>
</div>