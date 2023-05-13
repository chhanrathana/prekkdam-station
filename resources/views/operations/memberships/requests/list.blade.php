<div class="card">
    <div class="card-header text-white bg-info">
        <i class="fas fa-list"></i>
        <strong>{{ __('form.membership_list') }}</strong>
    </div>
    <div class="card-body">
        
        <div class="table-responsive-lg">
            <table class="table table-bordered table-striped table-hover" id ="table">
                <thead>
                    <tr>
                        <th class="text-nowrap" rowspan="2"></th>
                        <th class="text-center text-nowrap align-middle" rowspan="2">{{ __('form.no') }}</th>
                        <th class="text-center text-nowrap align-middle" rowspan="2">{{ __('form.status') }}</th>  

                        <th class="text-center text-nowrap align-middle" colspan="2">{{ __('form.client') }}</th>
                        <th class="text-center text-nowrap align-middle" colspan="4">{{ __('form.deposit') }}</th>                        
                        <th class="text-center text-nowrap align-middle" rowspan="2">{{ __('form.balance_amount') }}</th>                        
                    </tr>
                    <tr>                        
                        <th class="text-center text-nowrap">{{ __('form.code') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.name') }}</th>

                        <th class="text-center text-nowrap">{{ __('form.code') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.amount') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.loan_date') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.interest_rate') }}</th>                                                
                    </tr>
                </thead>
                <tbody>

                @foreach ($records as $record)
                    <tr>
                        <td class="text-center text-nowrap">
                            <div class="btn-group" role="group" aria-label="Action">
                                {{-- <a class="btn btn-sm btn-warning mr-1" target="_blank" href="{{ route('membershipdownload',['id' => $record->id ])}}">
                                    <i class="fas fa-print"></i> {{ __('form.btn_print') }}
                                </a> --}}
    
                                <a class="btn btn-sm btn-success mr-1" href="{{ route('operation.membership.request.show',['id' => $record->id ])}}">
                                    <i class="fas fa-eye"></i> {{ __('form.btn_view') }}
                                </a>
    
                                <a class="btn btn-sm btn-primary mr-1 {{ $record->status <> 'pending'?'disabled':'' }}"
                                    href="{{ route('operation.membership.request.edit',['id' => $record->id ])}}" type="button">                                    
                                    <i class="fas fa-pen"></i> {{ __('form.btn_edit') }}
                                </a>
    
                                <button {{ $record->status <> 'pending'?'disabled':'' }} class="btn btn-sm btn-danger btn-delete  mr-1" data-id="{{ $record->id }}">                                    
                                    <i class="fas fa-trash"></i> {{ __('form.btn_remove') }}
                                </button>
                            </div>
                            
                        </td>
                        <td class="text-right text-nowrap">{{ $loop->index + 1 }}</td>
                        <td class="text-center text-nowrap"><span class="{{ $record->_status->css }}">{{ $record->_status->name_kh }}</span></td>
                        <td class="text-center text-nowrap">{{ $record->client->code??''}}</td>
                        
                        <td class="text-left text-nowrap">{{ $record->client->name_kh??''}}</td>
                        <td class="text-center text-nowrap">{{ $record->code??''}}</td>
                        <td class="text-right text-nowrap">{{ number_format($record->principal_amount) }} KHR</td>
                        <td class="text-center text-nowrap">{{ $record->registration_date??''}}</td>
                        <td class="text-center text-nowrap">{{ number_format($record->interest_rate,2)}} %</td>
                        
                        <td class="text-right text-nowrap">{{ number_format($record->balance_amount) }} KHR</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">{{$records->appends($_GET)->links()}}</div>            
        </div>        
    </div>
</div>