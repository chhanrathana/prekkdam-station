<div class="card">
    <div class="card-header text-white bg-info">
        <i class="fas fa-search"></i>
        <strong>{{ __('form.search') }}</strong>
    </div>
    <div class="card-body">
        <form action="{{ route('report.operation.sale-daily.index') }}" class="mt-2" id="frmSearch" method="GET">
            <div class="form-row">
                                    
                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <input
                        type="text"
                        maxlength="10"
                        pattern="[0-9/]+"
                        data-inputmask-alias="dd/mm/yyyy"
                        data-val="true"
                        data-val-required="Required"
                        class="form-control"
                        name="date"
                        value="{{ request('date')??$date }}"
                        placeholder="{{ __('form.date') }}">
                </div>
                
                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <select class="form-control select2" name="work_shift_id" >
                        <option value="" disabled selected>[-- {{ __('form.shift') }} --]</option>
                        <option value="all" {{ request('work_shift_id') == 'all'?'selected':'' }}>{{__('form.all')}}</option>
                        @foreach ($shifts as $shift)
                            <option value="{{ $shift->id }}" {{ request('work_shift_id') == $shift->id?'selected':'' }}>{{ $shift->name_kh }}</option>
                        @endforeach
                    </select>
                </div>
                                                                                  
                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-1">
                    <button type="submit" class="btn btn-primary mb-2">
                        <i class="fas fa-search"></i>
                        {{ __('form.search') }}
                    </button>
                    <a href="{{ url()->current() }}" class="btn btn-warning mb-2">
                        <i class="fas fa-times"></i>
                        {{ __('form.clear') }}
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>