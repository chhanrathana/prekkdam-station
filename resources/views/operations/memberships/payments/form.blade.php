<div class="card">
    <div class="card-header text-white bg-primary">
        <i class="fas fa-pen"></i>
        <strong>{{ __('form.payment_info') }}</strong>
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
                    value="{{ $payment->end_interest_date }}"
                >
                <div class="invalid-feedback">{{ $errors->first('end_interest_date') }}</div>
            </div>

            <div class="form-group col-sm-4">                
                <label>{{ __('form.principal_amount') }}</label>
                <input
                    class="form-control {{ $errors->first('principal_amount') ? 'is-invalid':'' }}"
                    name="principal_amount"
                    pattern="\d*"
                    type="text"
                    readonly
                    placeholder="10000000"
                    value="{{ number_format($payment->principal_amount) }}"
                >
                <div class="invalid-feedback">{{ $errors->first('principal_amount') }}</div>
            </div>
          
            <div class="form-group col-sm-4">
                <label>{{ __('form.interest_amount') }}</label>
                <input
                    class="form-control {{ $errors->first('interest_amount') ? 'is-invalid':'' }}"
                    name="interest_amount"
                    pattern="\d*"
                    type="text"
                    placeholder="10000000"
                    disabled
                    value="{{ number_format($payment->interest_amount) }}"
                >
                <div class="invalid-feedback">{{ $errors->first('interest_amount') }}</div>
            </div>
                                                  
            <div class="form-group col-sm-4">
                <label>{{ __('form.withdraw_amount') }}<span class="text-danger">*</span></label>
                <input
                    class="form-control number {{ $errors->first('withdraw_amount') ? 'is-invalid':'' }}"
                    name="withdraw_amount"
                    pattern="\d*"
                    type="text"
                    placeholder="10000000"
                    autocomplete="off"
                    value="{{ $payment->withdraw_amount??0 }}"
                >
                <div class="invalid-feedback">{{ $errors->first('withdraw_amount') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label>{{ __('form.deposit_amount') }}<span class="text-danger">*</span></label>
                <input
                    class="form-control number {{ $errors->first('deposit_amount') ? 'is-invalid':'' }}"
                    name="deposit_amount"
                    pattern="\d*"
                    type="text"
                    placeholder="10000000"
                    autocomplete="off"     
                    {{ ($payment->deposit->deposit_type_id??null) == 'deposit'?'readonly':'' }}
                    value="{{ $payment->deposit_amount??0 }}"
                >
                <div class="invalid-feedback">{{ $errors->first('deposit_amount') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label>{{ __('form.balance_amount') }}</label>
                <input
                    class="form-control {{ $errors->first('balance_amount') ? 'is-invalid':'' }}"
                    name="balance_amount"
                    pattern="\d*"
                    type="text"
                    placeholder="10000000"
                    disabled
                    value="{{ number_format($payment->balance_amount) }}"
                >
                <div class="invalid-feedback">{{ $errors->first('balance_amount') }}</div>
            </div>

        </div>
    </div>

      <div class="card-footer">
        <div class="row">
            <div class="col">
                <a class="btn btn btn-warning float-left" href="{{ route('operation.deposit.payment.index')}}">
                    <i class="fas fa-arrow-left"></i> {{ __('form.btn_back') }}
                </a>

                <button class="btn btn btn-success float-right" type="submit">                    
                    <i class="fas fa-save"></i> {{ __('form.btn_save') }}
                </button>
            </div>
        </div>
    </div>    
</div>