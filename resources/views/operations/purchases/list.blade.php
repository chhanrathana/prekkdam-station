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
                        <th class="text-nowrap"></th>
                        <th class="text-center text-nowrap">{{ __('form.no') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.code') }}</th>
                        {{-- <th class="text-center text-nowrap">{{ __('form.tank') }}</th> --}}
                        <th class="text-center text-nowrap">{{ __('form.status') }}</th>  
                        <th class="text-center text-nowrap">{{ __('form.type') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.vendor') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.purchase_date') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.qty') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.pending_qty') }}</th>                        
                        <th class="text-center text-nowrap">{{ __('form.cost') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.total_cost') }}</th>
                    </tr>                  
                </thead>
                <tbody>
                @foreach ($records as $record)
                    <tr>
                        <td class="text-center text-nowrap">
                            <div class="btn-group"role="group"aria-label="Action">
                               
                                <a class="btn btn-sm btn-primary mr-1 "
                                    href="{{ route('operation.purchase.edit',['id' => $record->id ]) }}"type="button">                                    
                                    <i class="fas fa-pen"></i> {{ __('form.btn_edit') }}
                                </a>
    
                                <button class="btn btn-sm btn-danger btn-delete  mr-1"data-id="{{ $record->id }}">                                    
                                    <i class="fas fa-trash"></i> {{ __('form.btn_remove') }}
                                </button>
                            </div>                            
                        </td>
                        <td class="text-center text-nowrap">{{ $loop->index + 1 }}</td>
                        <td class="text-center text-nowrap">{{ $record->code??''}}</td>
                        {{-- <td class="text-center text-nowrap">{{ $record->tank->name_kh??''}}</td> --}}
                        <td class="text-center text-nowrap"><span class="{{ $record->_status->css??'' }}">{{ $record->_status->name_kh??'' }}</span></td>
                        <td class="text-left text-nowrap">{{ $record->type->name_kh??''}}</td>
                        <td class="text-left text-nowrap">{{ $record->vendor->name_kh??''}}</td>
                        <td class="text-center text-nowrap">{{ $record->date??''}}</td>
                        <td class="text-right text-nowrap">{{ number_format($record->qty,4) }} {{ $record->unit }}</td>
                        <td class="text-right text-nowrap">{{ number_format($record->qty - ($record->sales->sum('qty')??0),2) }} {{ $record->unit }}</td>
                        <td class="text-right text-nowrap">{{ number_format($record->cost,2) }} {{ $record->currency }}</td>
                        <td class="text-right text-nowrap">{{ number_format($record->total_cost,2) }} {{ $record->currency }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">{{$records->appends($_GET)->links()}}</div>            
        </div>        
    </div>
</div>