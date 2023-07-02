<div class="card">
    <div class="card-header text-white bg-info">
        <div class="row">
            <div class="col">
                <i class="fas fa-list"></i>
                <strong>{{ __('form.oil_type_list') }}</strong>
            </div>
            {{-- <div class="col">
                <a class="float-right btn btn-md btn-warning" href="{{ route('setting.master-data.expense-type.create') }}">
                    <i class="fas fa-plus"></i>
                    <strong>{{ __('form.add_new') }}</strong>
               </a>
            </div> --}}
        </div>        
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id ="table">
                <thead>
                    <tr>
                        {{-- <th class="text-center text-nowrap"></th> --}}
                        <th class="text-center text-nowrap">{{ __('form.no') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.name_kh') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.name_en') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.unit') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $record)
                    <tr>
                        {{-- <td class="text-center text-nowrap">
                            <a class="btn btn-sm btn-primary mr-1 "
                                href="{{ route('setting.master-data.oil-type.edit',['id' => $record->id ])}}" type="button">                                    
                                <i class="fas fa-pen"></i> {{ __('form.btn_edit') }}
                            </a>

                            <button class="btn btn-sm btn-danger btn-delete  mr-1" data-id="{{ $record->id }}">                                    
                                <i class="fas fa-trash"></i> {{ __('form.btn_remove') }}
                            </button>
                        </td> --}}
                        <td class="text-center text-nowrap">{{ $loop->index + 1 }}</td>                        
                        <td class=" text-nowrap">{{$record->name_kh}}</td>
                        <td class=" text-nowrap">{{$record->name_en}}</td>
                        <td class="text-right text-nowrap">{{ number_format($record->liter_of_ton,0) }} Kg/Ton</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>