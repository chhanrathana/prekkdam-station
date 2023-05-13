<div class="card">
    <div class="card-header text-white bg-info">
        <i class="fas fa-list"></i>
        <strong>{{ __('form.client_list') }}</strong>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id ="table">
                <thead>
                    <tr>
                        <th class="text-nowrap"></th>
                        <th class="text-center text-nowrap">{{ __('form.no') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.code') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.type') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.name_kh') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.name_en') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.sex') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.date_of_birth') }}</th>                        
                        <th class="text-center text-nowrap">{{ __('form.phone_number') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.address') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($clients as $client)
                    <tr>                        
                        <td class="text-center text-nowrap">   
                            <div class="btn-group" role="group" aria-label="Action">
                                <a class="btn btn-sm btn-success mr-1" href="{{ route('operation.client.show',['id' => $client->id ])}}" type="button">
                                    <i class="fas fa-eye"></i> {{ __('form.btn_view') }}
                                </a>    
                                <a class="btn btn-sm btn-primary" href="{{ route('operation.client.edit',['id' => $client->id ])}}" type="button">
                                    <i class="fas fa-pen"></i> {{ __('form.btn_edit') }}
                                </a>
                            </div>
                        </td>
                        <td class="text-right text-nowrap">{{ $loop->index + 1 }}</td>
                        <td class="text-left text-nowrap text-center">{{ $client->code??''}}</td>
                        <td class="text-left text-nowrap">{{ $client->type->name_kh??''}}</td>
                        <td class="text-left text-nowrap">{{ $client->name_kh??''}}</td>
                        <td class="text-left text-nowrap">{{ $client->name_en??''}}</td>
                        <td class="text-left text-nowrap text-center">{{ $client->_sex->name_kh??''}}</td>
                        <td class="text-left text-nowrap">{{ $client->date_of_birth??''}}</td>                        
                        <td class="text-left text-nowrap">{{ $client->phone_number??''}}</td>
                        <td class="text-left text-nowrap">{{ $client->address??''}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">{{$clients->appends($_GET)->links()}}</div>            
        </div>        
    </div>
</div>