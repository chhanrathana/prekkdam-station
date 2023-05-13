<div class="card">
    <div class="card-header text-white bg-primary">
        <i class="fas fa-pen"></i>
        <strong>{{ __('form.loan_payment_info') }}</strong>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-sm-4">
                <label>{{ __('form.end_interest_date') }}</label>
                <input
                    class="form-control {{ $errors->first('end_interest_date') ? 'is-invalid':'' }}"
                    name="end_interest_date"
                    pattern="\d*"
                    type="text"                            
                    disabled
                    placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                    value="{{ $record->end_interest_date }}"
                >
                <div class="invalid-feedback">{{ $errors->first('end_interest_date') }}</div>
            </div>

            <div class="form-group col-sm-4">                
                <label>{{ __('form.deduct_pending_amount') }}</label>
                <input
                    class="form-control {{ $errors->first('deduct_pending_amount') ? 'is-invalid':'' }}"
                    name="deduct_pending_amount"
                    pattern="[0-9.]+"
                    type="text"
                    readonly
                    placeholder="10000000"
                    value="{{ number_format($record->deduct_pending_amount) }}"
                >
                <div class="invalid-feedback">{{ $errors->first('deduct_pending_amount') }}</div>
            </div>
          
            <div class="form-group col-sm-4">
                <label>{{ __('form.interest_pending_amount') }}</label>
                <input
                    class="form-control {{ $errors->first('interest_pending_amount') ? 'is-invalid':'' }}"
                    name="interest_pending_amount"
                    pattern="\d*"
                    type="text"
                    placeholder="10000000"
                    disabled
                    value="{{ number_format($record->interest_pending_amount) }}"
                >
                <div class="invalid-feedback">{{ $errors->first('interest_pending_amount') }}</div>
            </div>
                                                  
            <div class="form-group col-sm-4">
                <label>{{ __('form.deduct_paid_amount') }}</label>
                <input
                    class="form-control number {{ $errors->first('deduct_paid_amount') ? 'is-invalid':'' }}"
                    name="deduct_paid_amount"
                    pattern="\d*"
                    type="text"
                    placeholder="10000000"
                    autocomplete="off"
                    value="{{ number_format($record->deduct_paid_amount>0?$record->deduct_paid_amount:$record->deduct_pending_amount ) }}"
                >
                <div class="invalid-feedback">{{ $errors->first('deduct_paid_amount') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label>{{ __('form.interest_paid_amount') }}</label>
                <input
                    class="form-control number {{ $errors->first('interest_paid_amount') ? 'is-invalid':'' }}"
                    name="interest_paid_amount"
                    pattern="\d*"
                    type="text"
                    placeholder="10000000"
                    autocomplete="off"
                    value="{{ number_format($record->interest_paid_amount>0?$record->interest_paid_amount:$record->interest_pending_amount ) }}"
                >
                <div class="invalid-feedback">{{ $errors->first('interest_paid_amount') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label>{{ __('form.loan_add_amount') }}</label>
                <input
                    class="form-control number {{ $errors->first('loan_amount') ? 'is-invalid':'' }}"
                    name="loan_amount"
                    pattern="\d*"
                    type="text"
                    placeholder="10000000"
                    autocomplete="off"
                    value="{{ number_format($record->loan_amount ) }}"
                >
                <div class="invalid-feedback">{{ $errors->first('loan_amount') }}</div>
            </div>

        </div>
    </div>

      <div class="card-footer">
        <div class="row">
            <div class="col">
                <a class="btn btn btn-warning float-left" href="{{ route('operation.loan.payment.index')}}">
                    <i class="fas fa-arrow-left"></i> {{ __('form.btn_back') }}
                </a>

                <button class="btn btn btn-success float-right" type="submit">                    
                    <i class="fas fa-save"></i> {{ __('form.btn_save') }}
                </button>
            </div>
        </div>
    </div>    
</div>