<div class="card">
    <div class="card-header text-white bg-info">
        <i class="fas fa-list"></i>
        <strong>{{ __('form.expense_list') }}</strong>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id ="table">
                <thead>
                    <tr>
                        <th class="text-nowrap"></th>
                        <th class="text-center text-nowrap">{{ __('form.no') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.type') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.date') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.amount') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.description') }}</th>                        
                    </tr>
                </thead>
                <tbody>
                @foreach ($records as $record)
                    <tr>                        
                        <td class="text-center text-nowrap">   
                            <div class="btn-group" role="group" aria-label="Action">                            
                                <a class="btn btn-sm btn-primary mr-1" href="{{ route('expense.edit',['id' => $record->id ])}}" type="button">
                                    <i class="fas fa-pen"></i> {{ __('form.btn_edit') }}
                                </a>
                                  <button class="btn btn-sm btn-danger btn-delete mr-1" data-id="{{ $record->id }}">                                    
                                    <i class="fas fa-trash"></i> {{ __('form.btn_remove') }}
                                </button>
                            </div>
                        </td>
                        <td class="text-right text-nowrap">{{ $loop->index + 1 }}</td>                        
                        <td class="text-left text-nowrap">{{ $record->type->name_kh??''}}</td>
                        <td class="text-center text-nowrap">{{ $record->date??''}}</td>
                        <td class="text-right text-nowrap">{{ number_format($record->amount??0,2)}} KHR</td>
                        <td class="text-left text-nowrap">{{ $record->description??''}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>        
    </div>
</div>