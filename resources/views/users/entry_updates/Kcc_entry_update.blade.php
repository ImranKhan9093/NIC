@extends('layout')
@section('title', 'KCC Entry update')
@section('style')

{{-- <link rel="stylesheet" href="{{ URL('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL('css/entry_update/insert_form.css') }}"> --}}

@endsection

@section('content')
    {{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
    <!------ Include the above in your HEAD tag ---------->

    {{-- <div class="container contact">
        <div class="row">
            <div class="col-md-3">
                <div class="contact-info">
                    <h2>KCC Entry Update</h2>
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

                    <div class="" id="dataAlreadyExists">

                    </div>

                <div class="contact-form">
                    <form action="{{ route('users.insertKcc') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                @include('users.commonInputs')
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label class="form-group col-md-6">Target</label>
                                    <div class="col-sm-10">
                                        <input type="number" placeholder="Enter Target" min="1" step="1" name="target"
                                            id="target" class="form-control">
                                    </div>
                                    @error('target')
                                        <span>{{ $message }}</span><br>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-group col-md-6">No. of Kcc Sponsored</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="1" step="0.0001" name="kcc_sponsored" id="kcc_sponsored"
                                            class="form-control" placeholder="Kcc Sponsored">
                                    </div>
                                    @error('kcc_sponsored')
                                        <span>{{ $message }}</span><br>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-group col-md-6">No. of Kcc Sanctioned</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="1" step="1" name="kcc_sanctioned" id="kcc_sanctioned"
                                            class="form-control" placeholder="Kcc Sanctioned">
                                    </div>
                                    @error('kcc_sanctioned')
                                        <span>{{ $message }}</span><br>
                                    @enderror
                                </div>
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" value="Insert" id="submit"
                                        style="float: right ; width:fit-content" class="btn btn-default">Insert</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <div id="content">           
        <section class="tables-section">
            <!-- form -->
            

            <div class="outer-w3-agile">
                <h4 class="tittle-w3-agileits mb-4">Forms</h4>
                <div style="padding-left:50px;">
                     <div class="form-group row">
                        <label for="example-text-input" class="col-lg-2 col-form-label">Text</label>
                        <div class="col-lg-8">
                        <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-search-input" class="col-lg-2 col-form-label">Search</label>
                        <div class="col-lg-8">
                        <input class="form-control" type="search" value="How do I shoot web" id="example-search-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-email-input" class="col-lg-2 col-form-label">Email</label>
                        <div class="col-lg-8">
                        <input class="form-control" type="email" value="bootstrap@example.com" id="example-email-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-url-input" class="col-lg-2 col-form-label">URL</label>
                        <div class="col-lg-8">
                        <input class="form-control" type="url" value="https://getbootstrap.com" id="example-url-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-tel-input" class="col-lg-2 col-form-label">Telephone</label>
                        <div class="col-lg-8">
                        <input class="form-control" type="tel" value="1-(555)-555-5555" id="example-tel-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-password-input" class="col-lg-2 col-form-label">Password</label>
                        <div class="col-lg-8">
                        <input class="form-control" type="password" value="hunter2" id="example-password-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-number-input" class="col-lg-2 col-form-label">Select</label>
                        <div class="col-lg-8">
                        <select class="form-control" id="example-select">
                            <option>Select 1</option>
                            <option>Select 2</option>
                            <option>Select 3</option>
                            <option>Select 4</option>
                            <option>Select 5</option>
                            <option>Select 6</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-number-input" class="col-lg-2 col-form-label">Number</label>
                        <div class="col-lg-8">
                        <input class="form-control" type="number" value="42" id="example-number-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-datetime-local-input" class="col-lg-2 col-form-label">Date and time</label>
                        <div class="col-lg-8">
                        <input class="form-control" type="datetime-local" value="2011-08-19T13:45:00" id="example-datetime-local-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-date-input" class="col-lg-2 col-form-label">Date</label>
                        <div class="col-lg-8">
                        <input class="form-control" type="date" value="2011-08-19" id="example-date-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-month-input" class="col-lg-2 col-form-label">Month</label>
                        <div class="col-lg-8">
                        <input class="form-control" type="month" value="2011-08" id="example-month-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-week-input" class="col-lg-2 col-form-label">Week</label>
                        <div class="col-lg-8">
                        <input class="form-control" type="week" value="2011-W33" id="example-week-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-time-input" class="col-lg-2 col-form-label">Time</label>
                        <div class="col-lg-8">
                        <input class="form-control" type="time" value="13:45:00" id="example-time-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-color-input" class="col-lg-2 col-form-label">Color</label>
                        <div class="col-lg-8">
                        <input class="form-control" type="color" value="#563d7c" id="example-color-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-color-input" class="col-lg-2 col-form-label">Textarea</label>
                        <div class="col-lg-8">
                        <textarea class="form-control"  id="example-textarea"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-color-input" class="col-lg-2 col-form-label">&nbsp;</label>
                        <div class="col-lg-8">
                        <button type="button" class="btn btn-primary btn-lg">Primary</button>
                        <button type="button" class="btn btn-secondary btn-lg">Secondary</button>
                        <button type="button" class="btn btn-success btn-lg">Success</button>
                        <button type="button" class="btn btn-danger btn-lg">Danger</button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-color-input" class="col-lg-2 col-form-label">&nbsp;</label>
                        <div class="col-lg-8">
                        
                        <button type="button" class="btn btn-warning btn-lg">Warning</button>
                        <button type="button" class="btn btn-info btn-lg">Info</button>
                        <button type="button" class="btn btn-light btn-lg">Light</button>
                        <button type="button" class="btn btn-dark btn-lg">Dark</button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-color-input" class="col-lg-2 col-form-label">&nbsp;</label>
                        <div class="col-lg-8">
                        <button type="button" class="btn btn-primary">Primary</button>
                        <button type="button" class="btn btn-secondary">Secondary</button>
                        <button type="button" class="btn btn-success">Success</button>
                        <button type="button" class="btn btn-danger">Danger</button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-color-input" class="col-lg-2 col-form-label">&nbsp;</label>
                        <div class="col-lg-8">
                        
                        <button type="button" class="btn btn-warning">Warning</button>
                        <button type="button" class="btn btn-info">Info</button>
                        <button type="button" class="btn btn-light">Light</button>
                        <button type="button" class="btn btn-dark">Dark</button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-color-input" class="col-lg-2 col-form-label">&nbsp;</label>
                        <div class="col-lg-8">
                        <button type="button" class="btn btn-primary btn-sm">Primary</button>
                        <button type="button" class="btn btn-secondary btn-sm">Secondary</button>
                        <button type="button" class="btn btn-success btn-sm">Success</button>
                        <button type="button" class="btn btn-danger btn-sm">Danger</button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-color-input" class="col-lg-2 col-form-label">&nbsp;</label>
                        <div class="col-lg-8">
                        
                        <button type="button" class="btn btn-warning btn-sm">Warning</button>
                        <button type="button" class="btn btn-info btn-sm">Info</button>
                        <button type="button" class="btn btn-light btn-sm">Light</button>
                        <button type="button" class="btn btn-dark btn-sm">Dark</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--// form -->

        </section>
        
    </div>


@endsection

@section('scripts')
    <script  type="text/javascript" src="{{ URL('js/jQuery.min.js') }}"></script>

    <script defer type="text/javascript" src="{{ URL('js/dropdown.js') }}"> </script>

    <script defer  type="text/javascript" >

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function()
        {
           

            $('#month,#year,#district,#subdivision,#municipality').on('change',function(){
                var monthDataExists=$('#month').val();
                var districtDataExists=$('#district').val();
                var subdivisionDataExists=$('#subdivision').val();
                var municipalityDataExists=$('#municipality').val();
                var yearDataExists=$('#year').val();

                if(monthDataExists&&districtDataExists&&subdivisionDataExists&&municipalityDataExists&&yearDataExists){
                    $('#dataAlreadyExists').removeClass('alert alert-danger');
                    $('#dataAlreadyExists').empty();
                    $.ajax({
                            url: '/users/checkkccData',
                            type: "POST",
                            data: {
                                district: districtDataExists,
                                subdivision:subdivisionDataExists,
                                municipality:municipalityDataExists,
                                month:monthDataExists,
                                year:yearDataExists,
                            },
                            success: function (result) {
                            
                            if(result){
                                $('#dataAlreadyExists').addClass('alert alert-danger');

                                $('#dataAlreadyExists').append('<span>Data for the entered district subdivision block already exists for this month</span>');
                                $('#dataAlreadyExists').show();

                                $('#dataAlreadyExists').slideUp(1800);


                            $('#target').val(result['KCC_target']);
                            $('#kcc_sanctioned').val(result['KCC_sanctioned']);
                            $('#kcc_sponsored').val(result['KCC_sponsored']);
                            $('#submit').html('Update');
                            }
                            else{
                                $('#target').val(null);
                                $('#kcc_sanctioned').val(null);
                                $('#kcc_sponsored').val(null);
                                $('#submit').html('Insert');
                            }

                            },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                alert("Status: " + textStatus);
                                alert("Error: " + errorThrown);
                            },
                        });

                }

        });    
        
        
        


        });



    </script>


@endsection
