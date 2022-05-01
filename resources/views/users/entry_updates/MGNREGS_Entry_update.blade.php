
@extends('users.master')
@section('title', 'MGNREGS Entry update')
@section('style')

<link rel="stylesheet" href="{{ URL('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL('css/entry_update/insert_form.css') }}">

@endsection

@section('content')
    {{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
    <!------ Include the above in your HEAD tag ---------->

    <div class="container contact">
        <div class="row">
            <div class="col-md-3">
                <div class="contact-info">
                    <h2>MGNREGS Entry Update</h2>
                    <h4>Enter The following Details !</h4>
                </div>
            </div>
            <div class="col-md-9">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        <span>
                            {{ session()->get('success') }}
                        </span>
                    </div>
                @endif
                @if (session()->has('fail'))
                    <div class="alert alert-danger">
                        <span>
                            {{ session()->get('fail') }}
                        </span>
                    </div>
                @endif
                <div class="contact-form">
                    <form action="{{ route('users.insertMgnregs') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                @include('users.commonInputs')
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label for="tot_person _days_ generate" class="form-group col-md-6">Enter tot person
                                        days generate</label>
                                    <div class="col-sm-10">
                                        <input type="number" placeholder="days generate" min="1" step="1"
                                            name="tot_person_days_generate" id="tot_person_days_generate"
                                            class="form-control">
                                    </div>
                                    @error('tot_person_days_generate')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-group col-md-10">No. of Kcc Sponsored</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="1" step="1" name="KCC_sponsored" id="KCC_sponsored"
                                            class="form-control" placeholder="KCC_sponsored">
                                    </div>
                                    @error('kcc_sponsored')
                                        <span>{{ $message }}</span><br>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-group col-md-10">Average person days per household</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="1" step="0.0001" name="avg_persondays_per_household" id="avg_persondays_per_household"
                                            class="form-control" placeholder="avg_persondays_per_household">
                                    </div>
                                    @error('avg_persondays_per_household')
                                        <span>{{ $message }}</span><br>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-group col-md-10">Percentage of labour budget achieved</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="1" step="0.0001" name="percentage_of_labour_budget_achieved" id="percentage_of_labour_budget_achieved"
                                            class="form-control" placeholder="percentage_of_labour_budget_achieved">
                                    </div>
                                    @error('percentage_of_labour_budget_achieved')
                                        <span>{{ $message }}</span><br>
                                    @enderror
                               
                                </div>
                                <div class="form-group">
                                    <label class="form-group col-md-10">Expenditure made under Mgnregs</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="1" step="0.0001" name="expenditure_made_under_mgnrega" id="expenditure_made_under_mgnrega"
                                            class="form-control" placeholder="expenditure_made_under_mgnrega">
                                    </div>
                                    @error('expenditure_made_under_mgnrega')
                                        <span>{{ $message }}</span><br>
                                    @enderror
                               
                                </div>
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" value="Submit" id="submit"
                                        style="float: right ; width:fit-content" class="btn btn-default">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script defer type="text/javascript" src="{{ URL('js/jQuery.min.js') }}"></script>

    <script defer type="text/javascript" src="{{ URL('js/dropdown.js') }}"> </script>


@endsection

