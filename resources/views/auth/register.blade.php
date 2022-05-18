@extends('layout')
@section('title','Login')
@section('style')
<style>
    .error{
        color: red ;
    }
    .form{
        background-color: rgb(23, 183, 170);
        
    }
</style>
    
@endsection
@section('content')
<div class="agileits">
    <div class="w3-agileits-info">
        <p class="w3agileits">Register Here</p>
        <form class='form animate-form' id='form1' action="{{ route('register') }}" method="post">
            @csrf
            <div class='form-group has-feedback w3ls'>
                <label class='control-label' for='name'>Username</label> 
                <input class='form-control' id='name' name='name' placeholder='Username' type='text' value="{{ old('name') }}">
                <span class='glyphicon glyphicon-ok form-control-feedback'></span>
                @error('name')
                <span class="error">{{ $message }}</span>
                 @enderror
            </div>
            <div class='form-group has-feedback w3ls'>
                <label class='control-label' for='name'>Email</label> 
                <input class='form-control' id='email' name='email' placeholder='Email' type='email' value="{{ old('email') }}">
                <span class='glyphicon glyphicon-ok form-control-feedback'></span>
                @error('email')
                <span class="error">{{ $message }}</span>
                 @enderror
            </div>
           
            
            <div class='form-group has-feedback agile'>
                <label class='control-label' for='password'>Password</label> 
                <input class='form-control w3l' id='password' name='password' placeholder='Password' type='password'><span class='glyphicon glyphicon-ok form-control-feedback'></span>
                @error('password')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class='form-group has-feedback w3ls'>
                <label class='control-label' for='cpassword'>Confirm Password</label> 
                <input class='form-control' id='cpassword' name='cpassword' placeholder='Confirm password' type='password' value="{{ old('cpassword') }}">
                <span class='glyphicon glyphicon-ok form-control-feedback'></span>
                @error('cpassword')
                <span class="error">{{ $message }}</span>
                 @enderror
            </div>
            <div class='submit w3-agile'>
                <input class='btn btn-lg' type='submit' value='SUBMIT'>
            </div>
            <a href="{{ route('index') }}" style="color:white;">I hava an account</a>
        </form>
    </div>	
</div>	
@endsection
@section('scripts')

    
@endsection