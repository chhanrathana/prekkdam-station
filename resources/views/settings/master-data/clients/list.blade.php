<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
                <i class="fas fa-list"></i>
                <strong>{{ __('form.client_list') }}</strong>
            </div>
            <div class="col">
                <a class="float-right btn btn-md btn-info" href="{{ route('setting.master-data.client.create') }}">
                     <i class="fas fa-plus"></i>
                    <strong>{{ __('form.add_new') }}</strong>
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="table">
                <thead>
                    <tr>
                        <th ></th>                        
                        <th class="text-center text-nowrap">{{ __('form.no') }}</th>                        
                        <th class="text-center text-nowrap">{{ __('form.status') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.code') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.name_kh') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.name_en') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.sex') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.phone_number') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.address') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $record)
                    <tr>                         
                        <td class="text-center text-nowrap">
                            <a class="btn btn-sm btn-primary mr-1 "
                                href="{{ route('setting.master-data.client.edit',['id' => $record->id ])}}" type="button">                                    
                                <i class="fas fa-pen"></i> {{ __('form.btn_edit') }}
                            </a>

                            <button class="btn btn-sm btn-danger btn-delete  mr-1" data-id="{{ $record->id }}">                                    
                                <i class="fas fa-trash"></i> {{ __('form.btn_remove') }}
                            </button>
                        </td>
                        <td class="text-right text-nowrap">{{ $loop->index + 1 }}</td>
                        <td class="text-center text-nowrap"><span class="{{ $record->_status->css }}">{{ $record->_status->name_kh }}</span></td>
                        <td class="text-left text-nowrap">{{ $record->code??''}}</td>
                        <td class="text-left text-nowrap">{{ $record->name_kh??''}}</td>
                        <td class="text-left text-nowrap">{{ $record->name_en??''}}</td>
                        <td class="text-center text-nowrap">{{ $record->_sex->name_kh??''}}</td>
                        <td class="text-left text-nowrap">{{ $record->phone_number??''}}</td>
                        <td class="text-left text-nowrap">{{ $record->address??''}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center">{{$records->appends($_GET)->links()}}</div>            
        </div>        
    </div>
</div>