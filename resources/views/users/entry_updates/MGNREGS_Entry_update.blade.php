
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
                                    <label class="form-group col-md-6">No. of Kcc Sponsored</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="1" step="1" name="kcc_sponsored" id="kcc_sponsored"
                                            class="form-control" placeholder="Kcc Sponsored">
                                    </div>
                                    @error('kcc_sponsored')
                                        <span>{{ $message }}</span><br>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-group col-md-6">Average person days per household</label>
                                    {{-- <div class="col-sm-10">
                                        <input type="number" min="1" step="1" name="kcc_sanctioned" id="kcc_sanctioned"
                                            class="form-control" placeholder="Kcc Sanctioned">
                                    </div>
                                    @error('kcc_sanctioned')
                                        <span>{{ $message }}</span><br>
                                    @enderror --}}
                                </div>
                                <div class="form-group">
                                    <label class="form-group col-md-6">Percentage of labour budget achieved</label>
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
