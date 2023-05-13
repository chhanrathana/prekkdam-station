<div class="card">

    <div class="card-header text-white bg-info">
        <i class="fas fa-list"></i>
        <strong>{{ __('form.user_list') }}</strong>  
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped table-hover" id ="table">
            <thead>
                <tr>
                    <th class="text-center text-nowrap"></th>
                    <th class="text-center text-nowrap">{{ __('form.no') }}</th>
                    <th class="text-center text-nowrap">{{ __('form.status') }}</th>
                    <th class="text-center text-nowrap">{{ __('form.role') }}</th>
                    <th class="text-center text-nowrap">{{ __('form.account') }}</th>
                    <th class="text-center text-nowrap">{{ __('form.name') }}</th>
                                      
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                <tr>                   
                    <td class="text-center text-nowrap">
                        <a class="btn btn-sm btn-primary mr-1 "
                            href="{{ route('setting.user.edit',['id' => $record->id ])}}" type="button">                                    
                            <i class="fas fa-pen"></i> {{ __('form.btn_edit') }}
                        </a>

                        <button class="btn btn-sm btn-danger btn-delete  mr-1" data-id="{{ $record->id }}">                                    
                            <i class="fas fa-trash"></i> {{ __('form.btn_remove') }}
                        </button>
                    </td>

                    <td class="text-center">{{ $loop->index + 1 }}</td>
                    <td class="text-center"><span class="badge {{$record->status? 'badge-success':'badge-danger'}}">{{$record->status?'active':'inactive'}}</span></td>                        
                    <td>{{$record->type->name_kh??''}}</td>
                    <td>{{$record->email}}</td>
                    <td>{{$record->name_kh}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>