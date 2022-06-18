@extends('layout')
@section('title','Link to reset password')
@section('style')
<style>
    .error{
        color: red ;
    }
    .form{
        background-color: rgb(23, 183, 170);
    }
    .footer_margin{
        margin-top: 120px !important;
    }
    .agileits
    {
        margin-top: 5%;
    }
    .hrefUnderline{
        text-decoration: underline;
    }

</style>

@endsection
@section('content')
<div class="agileits">
    <div class="w3-agileits-info">
        <h5 class="w3agileits">Forget Password Email</h5>
        <p>You can reset password from bellow link:</p>
        <a href="{{ route('showResetPasswordForm',$token) }}">Reset password</a>
        
        
    </div>
</div>


@endsection


