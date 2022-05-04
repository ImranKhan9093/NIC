@extends('users.master')
@section('title', 'user dashboard')
@section('style')
    <link rel="stylesheet" href="{{ URL('css/user_dashboard/dropdown.css') }}">
@endsection
<style>
  .dropdown:hover .dropdown-menu{
    display: block !important;
  }
</style>


@section('content')
    <div class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="navbar-header">
                        <button class="navbar-toggle" data-target="#mobile_menu" data-toggle="collapse"><span
                                class="icon-bar"></span><span class="icon-bar"></span><span
                                class="icon-bar"></span></button>
                        
                    </div>
                    <div class="navbar-collapse collapse" id="mobile_menu">
                      
                      @foreach ($userMenus as $menu)
                      <ul class="nav navbar-nav dropdown">
                           
                            <li><a href="#" class="dropdown-toggle " data-toggle="dropdown">{{ $menu->menu }} <span
                                        class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    @foreach ($submenus[$menu->menu_cd] as $submenu)
                                    <li><a href="{{ route("users.$submenu->link") }}"> {{ $submenu->submenu }}</a></li>
                               
                                    @endforeach
                                </ul>
                            </li>
                       
                        </ul>
                        @endforeach
                        <ul class="nav navbar-nav">
                            <li>
                                <form action="" class="navbar-form">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="search" name="search" id="" placeholder="Search Anything Here..."
                                                class="form-control">
                                            <span class="input-group-addon"><span
                                                    class="glyphicon glyphicon-search"></span></span>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            
                            {{-- <li><a href="{{ route('users.downloadCMReport') }}" >CM Report</a></li> --}}
                            <li><a href="{{ route('users.showExcelReportCritera') }}">Show Excel Report</a></li>
                            <li><a href="{{ route('users.logout') }}" >Logout</a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <script  src="{{ URL('js/jquery-3.5.1.slim.min.js') }}"></script>
    
    <script  src="{{ URL('js/bootstrap.bundle.min.js') }}"></script>
@endsection
