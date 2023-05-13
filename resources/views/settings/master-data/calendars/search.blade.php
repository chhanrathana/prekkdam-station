<div class="card">
    <div class="card-header"><strong>ស្វែងរក</strong></div>
    <div class="card-body">
        
        <form action="{{ route('setting.master-data.calendar.index') }}" class="mt-2" id="frmSearch" method="GET">            
            <div class="form-row">
                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <input
                        type="text"
                        class="form-control"
                        name="year"
                        maxlength="4"
                        value="{{ request('year') }}"
                        placeholder="2022">
                </div>

                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-1">
                    <button type="submit" class="btn btn-primary mb-2">ស្វែងរក</button>
                    <a href="{{route('setting.master-data.calendar.index')}}" class="btn btn-warning mb-2">សំអាត</a>
                </div>
            </div>
        </form>
    </div>
</div>