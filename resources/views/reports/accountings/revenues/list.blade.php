<div class="card">    
    <div class="card-header text-white bg-info">      
        <div class="row">
            <div class="col">
                <i class="fas fa-list"></i>
                 <strong>{{ __('form.accounting_revenue_list') }}</strong>
            </div>
            <div class="col">
                <div class="btn-group float-right"role="group"aria-label="Action">
                    <a class="btn btn-sm btn-danger mr-1" target="_blank" href="{{ route('report.accounting.revenue.download', ['type' => 'PDF']).currentParamter() }}">
                        <i class="fas fa-print"></i>
                        <strong>{{ __('form.print') }}</strong>
                    </a>                                        
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">                
        <div class="table-responsive">
            @include('reports.accountings.revenues.table')           
        </div>        
    </div>
</div>