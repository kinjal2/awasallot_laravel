@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5>{{ __('Select Designation') }}</h5></div>

                <div class="card-body">
				<form method='POST' action='designationselection'>
				<input type='hidden' name='_token' value="{{ csrf_token() }}" />
                    <div class="form-group row">
					<label class="col-sm-2 col-form-label">Office</label>
					<div class="col-sm-10">
					<select name="officedesignation" id="officedesignation" class="form-control"  required>
					<option value="">Select Office:Designation</option>
					@foreach ($office_designations as $item)
						<option value="{{ $item->officecode }}:{{ $item->designationcode }}">{{ $item->officename }}:{{ $item->designation }}</option>
					@endforeach
					</select>
					</div>
					@error('officedesignation')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
					</div>
			
			
					<div class="row m-t-30">
					<div class="col-md-12"></div>
					<div class="col-md-12">
					<button type="submit" class="btn btn-primary">
						{{ __('Submit') }}
					</button>
					</div>
					</div>
				</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection