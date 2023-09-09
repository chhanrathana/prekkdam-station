<div class="card">
    <div class="card-header text-white bg-info">
        <i class="fas fa-list"></i>
        <strong>{{ __('form.sale_list') }}</strong>
    </div>
    <div class="card-body">
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id ="table">
                <thead>
                    <tr>
                        <th class="text-nowrap"></th>
                        <th class="text-center text-nowrap">{{ __('form.no') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.code') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.tank') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.type') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.sale_date') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.shift') }}</th>
                        {{-- <th class="text-center text-nowrap">{{ __('form.staff') }}</th> --}}
                        {{-- <th class="text-center text-nowrap">{{ __('form.client') }}</th> --}}
                        <th class="text-center text-nowrap">{{ __('form.qty') }}</th>                        
                        <th class="text-center text-nowrap">{{ __('form.cost') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.total_cost') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.price') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.total_price') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.total_revenue') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $record)
                        <tr>
                            <td class="text-center text-nowrap">
                                <div class="btn-group"role="group"aria-label="Action">
        
                                    <a class="btn btn-sm btn-primary mr-1 "
                                        href="{{ route('operation.sale.edit',['id' => $record->id ]) }}"type="button">
                                        <i class="fas fa-pen"></i> {{ __('form.btn_edit') }}
                                    </a>

                                    {{-- <a class="btn btn-sm btn-warning mr-1" target="_blank" 
                                        href="{{ route('operation.sale.print',['id' => $record->id ]) }}"type="button">
                                        <i class="fas fa-print"></i>
                                        <strong>{{ __('form.print') }}</strong>
                                    </a> --}}

                                    {{-- <a class="btn btn-sm btn-warning  mr-1" target="_blank" href="#">
                                        <i class="fas fa-trash"></i> {{ __('form.print') }}
                                    </a> --}}
                                            
                                    <button class="btn btn-sm btn-danger btn-delete  mr-1"data-id="{{ $record->id }}">                                    
                                        <i class="fas fa-trash"></i> {{ __('form.btn_remove') }}
                                    </button>
                                </div>                            
                            </td>
                            <td class="text-center text-nowrap">{{ $loop->index + 1 }}</td>
                            <td class="text-center text-nowrap">{{ $record->code??''}}</td>
                            <td class="text-center text-nowrap">{{ $record->tank->name_kh??''}}</td>
                            <td class="text-left text-nowrap">{{ $record->purchase->type->name_kh??''}}</td>
                            <td class="text-center text-nowrap">{{ $record->date??''}}</td>
                            <td class="text-left text-nowrap">{{ $record->shift->name_kh??''}}</td>
                            {{-- <td class="text-left text-nowrap">{{ $record->staff->name_kh??''}}</td>
                            <td class="text-left text-nowrap">{{ $record->client->name_kh??''}}</td> --}}
                            <td class="text-right text-nowrap">{{ number_format($record->qty,5) }} {{ $record->unit }}</td>
                            <td class="text-right text-nowrap">{{ number_format($record->cost,2) }} {{ $record->currency }}</td>
                            <td class="text-right text-nowrap">{{ number_format($record->total_cost,2) }} {{ $record->currency }}</td>
                            <td class="text-right text-nowrap">{{ number_format($record->price,2) }} {{ $record->currency }}</td>
                            <td class="text-right text-nowrap">{{ number_format($record->total_price,2) }} {{ $record->currency }}</td>
                            <td class="text-right text-nowrap">{{ number_format($record->total_revenue,2) }} {{ $record->currency }}</td>
                        </tr>
                    @endforeach
                    </tbody>
            </table>
            <div class="text-center">{{$records->appends($_GET)->links()}}</div>            
        </div>        
    </div>
</div>