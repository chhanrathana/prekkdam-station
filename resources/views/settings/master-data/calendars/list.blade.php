<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col"><strong>បញ្ជីប្រតិទិនឈប់សម្រាក់</strong></div>
            <div class="col">
                <a class="float-right btn btn-md btn-info" href="{{ route('setting.master-data.calendar.create') }}">
                     <strong>បញ្ចូលថ្មី</strong>
                </a>
                <a class="btn btn-sm btn-warning float-right mb-2"
                    style="margin-right: 5px;"
                    target="_blank"            
                    href="{{ route('setting.master-data.calendar.download').currentParamter() }}"
                    >
                    <span class="material-icons-outlined">print</span>
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
                        <th class="text-center text-nowrap">ថ្ងៃ</th>
                        <th class="text-center text-nowrap">ពិពណ៍នា</th>                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($calendars as $calendar)
                    <tr>
                        <td class="text-center text-nowrap">
                            <a class="btn btn-sm btn-primary" href="{{ route('setting.master-data.calendar.edit',['id' => $calendar->id]) }}" type="button">
                                <span class="material-icons-outlined">edit</span>
                            </a>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $calendar->id }}">
                                <span class="material-icons-outlined">delete_outline</span>
                            </button>
                        </td>
                        <td class="text-right">{{ $loop->index + 1 }}</td>
                        <td>{{$calendar->date}}</td>
                        <td>{{$calendar->description}}</td>                      
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>