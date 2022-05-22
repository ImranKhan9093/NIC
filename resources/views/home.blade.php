@extends('layout')
@section('title', 'Home')
@section('style')
    <style>
        .carouselSize {
            height: 65%;
         
        }

        .footer_item_size {
            height: 60px;
        }
      
       
   
       .carousel-image-size{
        width: 100%;
        height: 750px;
       }
     
       #sign_in{
         margin-top: 8px;
       }

    </style>

@endsection
@section('content')

  @include('common_carousel')
 
  
  <div class="footer">
    <div class="container">
    
      <div class="row">
        <div class="col">
          <img class="footer_item_size" alt="" src="{{ URL('assets/logos/kcc.png') }}" />
        </div>
        <div class="col">
          <img class="footer_item_size" alt="" src="{{ URL('assets/logos/kisan_mandi.png') }}" />
        </div>
        <div class="col">
          <a id="sign_in"  href="{{ route('index') }}" class="btn btn-primary">Sign in</a>
        </div>
        <div class="col">
          <img class="footer_item_size" alt="" src="{{ URL('assets/logos/anandadhara.jpg') }}" />
        </div>
        <div class="col">
          <img class="footer_item_size" alt="" src="{{ URL('assets/logos/mgnrega.png') }}" />
        </div>
      </div>
    
  </div>
  </div>
    


@endsection
@section('scripts')
    <script src="{{ URL('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL('js/jQuery.min.js') }}"></script>

@endsection
