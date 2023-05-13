<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col"><strong>បញ្ជីសាខា</strong></div>
            <div class="col">
                <a class="float-right btn btn-md btn-info" href="{{ route('setting.master-data.branch.create') }}">
                     <strong>បញ្ចូលថ្មី</strong>
                </a>
            </div>
        </div>
    </div>    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id ="table">
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-center text-nowrap">ល.រ</th>
                        <th class="text-center text-nowrap">កូដ</th>
                        <th class="text-center text-nowrap">ឈ្មោះ</th>
                        <th class="text-center text-nowrap">ពិពណ៍នា</th>                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($branches as $branch)
                    <tr>
                        <td class="text-center text-nowrap">
                            <a class="btn btn-sm btn-primary" href="{{ route('setting.master-data.branch.edit',['id' => $branch->id]) }}" type="button">
                                <span class="material-icons-outlined">edit</span>
                            </a>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $branch->id }}">
                                <span class="material-icons-outlined">delete_outline</span>
                            </button>
                        </td>
                        <td class="text-right">{{ $loop->index + 1 }}</td>
                        <td>{{$branch->code}}</td>
                        <td>{{$branch->name_kh}}</td>
                        <td>{{$branch->description}}</td>                      
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>