<div class="card">
    <div class="card-header text-white bg-info">
      
        <div class="row">
            <div class="col">
                <i class="fas fa-list"></i>
                 <strong>{{ __('form.sale_list') }}</strong>
            </div>
            <div class="col">
                <a class="float-right btn btn-sm btn-danger" target="_blank" href="{{ route('report.operation.sale.download', ['type' => 'PDF']).currentParamter() }}">
                    <i class="fas fa-print"></i>
                    <strong>{{ __('form.print') }}</strong>
                </a>
                
                <a class="float-right btn btn-sm btn-warning mr-1" target="_blank" href="{{ route('report.operation.sale.download', ['type' => 'EXCEL']).currentParamter() }}">
                    <i class="fas fa-download"></i>
                    <strong>{{ __('form.download') }}</strong>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">        
        <div class="table-responsive">
            @include('reports.operations.sales.table')
        </div>        
    </div>
</div>