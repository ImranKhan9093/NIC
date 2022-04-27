
@extends('users.master')
@section('title', 'KM Entry update')
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
                    <h2>KM Entry Update</h2>
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
                    <form action="{{ route('users.insertKishanMandi') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                @include('users.commonInputs')
                                <div class="form-group">
                                    <label for="KM_operational" class="form-group col-md-6">Municipality:</label>
                                    <div class="col-sm-10">
                                        <select name="KM_operational" id="KM_operational" required
                                            class="form-control selectpicker">

                                            <option value="">Select KM_operational</option>
                                            <option value="FO">Fully Operational</option>
                                            <option value="PO">Partially Operational</option>
                                            <option value="NA">Not available</option>

                                        </select>
                                    </div>
                                    @error('KM_operational')
                                        <span>{{ $message }}</span><br>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label for="KM_sanctioned" class="form-group col-md-6">Enter KM sanctioned</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="1" step="1" name="KM_sanctioned" id="KM_sanctioned"
                                            class="form-control" placeholder="KM sanctioned">
                                    </div>
                                    @error('KM_sanctioned')
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
