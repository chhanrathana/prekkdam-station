<div class="card">
    <div class="card-header text-white bg-info">
        <i class="fas fa-search"></i>
        <strong>{{ __('form.search_client') }}</strong>
    </div>
    <div class="card-body">        
        <form action="{{ $url }}" class="mt-2" id="frmSearch" method="GET">
            <div class="form-row">
                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <input 
                        class="form-control" 
                        name="code" 
                        pattern="\d*"
                        type="text" 
                        placeholder="{{ __('form.client_code') }}" 
                        value="{{ request('code') }}" 
                        maxlength="50">
                </div>

                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <input 
                        class="form-control" 
                        name="name" type="text" 
                        placeholder="{{ __('form.name') }}" 
                        value="{{ request('name') }}" 
                        maxlength="50">
                </div>
                
                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-1">
                    <button type="submit" class="btn btn-primary mb-2">
                        <i class="fas fa-search"></i>
                        {{ __('form.search') }}
                    </button>
                    <a href="{{ $url }}" class="btn btn-warning mb-2">
                        <i class="fas fa-times"></i>
                        {{ __('form.clear') }}
                    </a>
                </div>
            </div>
        </form>
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr>
                        <th class="text-nowrap"></th>
                        <th class="text-center text-nowrap">{{ __('form.code') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.name_kh') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.name_en') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.sex') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.phone_number') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.address') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($clients as $client)
                    <tr>                       
                        <td class="text-center text-nowrap">                            
                            <a class="btn btn-sm btn-info"
                                href={{ url()->current().'?'.http_build_query(array_merge(request()->all(),['selected' => $client->id])) }}>
                                <i class="fas fa-check"></i>
                            </a>
                        </td>                                                
                        <td class="text-center text-nowrap">{{ $client->code??''}}</td>
                        <td class="text-left text-nowrap">{{ $client->name_kh??''}}</td>
                        <td class="text-left text-nowrap">{{ $client->name_en??''}}</td>
                        <td class="text-center text-nowrap">{{ $client->_sex->name_kh??''}}</td>
                        <td class="text-left text-nowrap">{{ $client->phone_number??''}}</td>
                        <td class="text-left text-nowrap">{{ $client->address??''}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
