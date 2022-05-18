@extends('layout')
@section('title', 'Home')
@section('style')
    <style>
        .carouselSize {
            height: 65%;
            /* opacity: .7; */
        }

        .footer_item_size {
            height: 50px;
        }
        .page-footer{
            height: 50px;
        }
       
       .sign-in{
            margin-bottom: 30px !important;
       }
       .carousel-image-size{
        width: 100%;
        height: 750px;
       }

    </style>

@endsection
@section('content')

  @include('common_carousel')
 


    
<footer class="page-footer font-small mdb-color lighten-3 pt-4  " >

    <!-- Footer Elements -->
    <div class="container" >
  
      <!--Grid row-->
      <div class="row" >
  
        <!--Grid column-->
        <div class="col-lg-2 col-md-12 mb-4"  >
  
          <!--Image-->
          <div class="view overlay z-depth-1-half" >
            <img  src="{{ URL('assets/logos/kcc.png') }}" class="img-fluid footer_item_size" />
              <div class="mask rgba-white-light"></div>
            
          </div>
  
        </div>
        <!--Grid column-->
  
        <!--Grid column-->
        <div class="col-lg-2 col-md-6 mb-4">
  
          <!--Image-->
          <div class="view overlay z-depth-1-half ">
            <img  src="{{ URL('assets/logos/kisan_mandi.png') }}" class="img-fluid footer_item_size" />
              <div class="mask rgba-white-light"></div>
          
          </div>
  
        </div>
        <!--Grid column-->
        <div class="col-lg-2 col-md-12 mb-4" style="padding-top: 26px" >
  
       
            <div   class="view overlay z-depth-1-hal " >
             <a  class=" btn btn-primary sign_in" href="{{ route('index') }}">Sign in</a>
                <div class="mask rgba-white-light"></div>
              
            </div>
    
          </div>
        <!--Grid column-->
        <div class="col-lg-2 col-md-6 mb-4">
  
          <!--Image-->
          <div class="view overlay z-depth-1-half ">
            <img  src="{{ URL('assets/logos/anandadhara.jpg') }}" class="img-fluid footer_item_size" />
              <div class="mask rgba-white-light"></div>
           
          </div>
  
        </div>
        <!--Grid column-->
  
        <!--Grid column-->
        <div class="col-lg-2 col-md-12 mb-4">
  
          <!--Image-->
          <div class="view overlay z-depth-1-half ">
            <img  src="{{ URL('assets/logos/mgnrega.png') }}" class="img-fluid footer_item_size " />
              <div class="mask rgba-white-light"></div>
           
          </div>
  
        </div>
        <!--Grid column-->
  
        <!--Grid column-->
        {{-- <div class="col-lg-2 col-md-6 mb-4">
  
          <!--Image-->
          <div class="view overlay z-depth-1-half">
            <img  src="{{ URL('assets/logos/kcc.png') }}" class="img-fluid footer_image_size" />
              <div class="mask rgba-white-light"></div>
           
          </div>
  
        </div> --}}
        <!--Grid column-->
  
        <!--Grid column-->
        {{-- <div class="col-lg-2 col-md-6 mb-4">
  
          <!--Image-->
          <div class="view overlay z-depth-1-half">
            <img  src="{{ URL('assets/logos/kcc.png') }}" class="img-fluid footer_image_size" />
              <div class="mask rgba-white-light"></div>
            
          </div>
  
        </div> --}}
        <!--Grid column-->
  
      </div>
      <!--Grid row-->
  
    </div>
    <!-- Footer Elements -->
  
  
  </footer>


@endsection
@section('scripts')
    <script src="{{ URL('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL('js/jQuery.min.js') }}"></script>

@endsection
