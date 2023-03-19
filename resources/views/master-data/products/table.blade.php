<div class="row">
    <div class="col-xl-12">
        <div class="card dz-card">
            <div class="card-header flex-wrap border-0">
                <div>
                    <h4 class="card-title">Products</h4>
                </div>                
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-md">
                        <thead class="thead-primary">
                            <tr>
                                <th></th>
                                <th class="text-center"><strong>#</strong></th>
                                <th class="text-center"><strong>CODE</strong></th>
                                <th class="text-center"><strong>NAME KH</strong></th>
                                <th class="text-center"><strong>NAME EN</strong></th>       
                                <th class="text-center"><strong>COST</strong></th>       
                                <th class="text-center"><strong>PRICE</strong></th>                                                             
                                <th class="text-center"><strong>UNIT</strong></th>  
                                <th class="text-center"><strong>CREATED</strong></th>
                                <th class="text-center"><strong>UPDATED</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-success light sharp" data-bs-toggle="dropdown">
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('master-data.product.edit',['id' => $item->id]) }}">Edit</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center"><strong>{{ $loop->index+1}}</strong></td>
                                <td class="text-center">{{ $item->code }}</td>                                
                                <td>{{ $item->name_kh }}</td>
                                <td>{{ $item->name_en }}</td>                                
                                <td class="text-end">{{ number_format($item->cost, 2) }}</td>
                                <td class="text-end">{{ number_format($item->price, 2) }}</td>
                                <td class="text-center">{{ $item->unit->code??'' }}</td>                                
                                <td class="text-center">{{ $item->created_at }}</td>
                                <td class="text-center">{{ $item->updated_at }}</td>
                            </tr>
                            @endforeach                                                     
                        </tbody>
                    </table>
                </div>
            </div>            
        </div>
    </div>
</div>