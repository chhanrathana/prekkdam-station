<div class="card">
    <div class="card-header text-white bg-info">
        <i class="fas fa-list"></i>
        <strong>{{ __('form.purchase_list') }}</strong>
    </div>
    <div class="card-body">
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover"id ="table">
                <thead>
                    <tr>
                        <th class="text-center text-nowrap">{{ __('form.no') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.code') }}</th>                        
                        <th class="text-center text-nowrap">{{ __('form.oil_type') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.total_purchase') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.total_sale') }}</th>                        
                        <th class="text-center text-nowrap">{{ __('form.pending_qty') }}</th>

                    </tr>                  
                </thead>
                <tbody>
                    @php
                        $totalPurchaseQty = 0;
                        $totalSaleQty = 0;
                        $totalStockQty = 0;
                    @endphp
                @foreach ($records as $record)
                    @php
                        $purchaseQty = $record->purchases->sum('qty')??0;
                        $totalPurchaseQty = $totalPurchaseQty + $purchaseQty; 

                        $saleQty = $record->sales->sum('qty')??0;
                        $totalSaleQty = $totalSaleQty + $saleQty;

                        $stockQty = $purchaseQty - $saleQty;
                        $totalStockQty = $totalStockQty + $stockQty;
                    @endphp
                    <tr>                       
                        <td class="text-center text-nowrap">{{ $loop->index + 1 }}</td>
                        <td class="text-center text-nowrap">{{ $record->id??''}}</td>                                                         
                        <td class="text-center text-nowrap">{{ $record->name_kh??''}}</td>
                        <td class="text-right text-nowrap">{{ number_format($purchaseQty,2) }} L</td>
                        <td class="text-right text-nowrap">{{ number_format($saleQty,2) }} L</td>
                        <td class="text-right text-nowrap">{{ number_format($stockQty,2) }} L</td>                        
                    </tr>
                @endforeach
                <tr class="text-bold">
                    <td colspan="3" class="text-center"> {{ __('form.total') }}</td>
                    <td class="text-right text-nowrap">{{ number_format($totalPurchaseQty,2) }} L</td>            
                    <td class="text-right text-nowrap">{{ number_format($totalSaleQty,2) }} L</td>
                    <td class="text-right text-nowrap">{{ number_format($totalStockQty,2) }} L</td>                    
                </tr>
                </tbody>
            </table>        
        </div>        
    </div>
</div>