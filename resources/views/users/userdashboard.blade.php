@extends('layout')
@section('title', 'user dashboard')
@section('style')
    <link rel="stylesheet" href="{{ URL('css/user_dashboard/dropdown.css') }}">
@endsection



@section('content')
    <div class="container-fluid clearfix">
        <div class="row">
            <nav class="navbar navbar-default" style="width:100%; background:#3f96c9;">
                <div id="cssmenu">
                    <div id="head-mobile"></div>
                    <div class="button"></div>
                    <ul class="nav navbar-nav navbar-right">
                        @foreach ($userMenus as $menu)
                            <li class=""><a href="#">{{ $menu->menu }}</a>
                                <ul class="firstch">
                                    @foreach ($submenus[$menu->menu_cd] as $submenu)
                                        <li>
                                            <a href="{{ route("users.$submenu->link") }}">{{ $submenu->submenu }}</a>
                                        </li>
                                    @endforeach

                                </ul>
                            </li>
                        @endforeach

                        <li><a href="{{ route('users.showExcelReportCritera') }}">Show Excel Report</a></li>
                        <li><a href="{{ route('users.logout') }}" >Logout</a></li>

                    </ul>
                </div>
            </nav>
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{ URL('js/jquery-3.5.1.slim.min.js') }}"></script>

<script src="{{ URL('js/bootstrap.bundle.min.js') }}"></script>
@endsection
