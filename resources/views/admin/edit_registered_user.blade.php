@extends('admin.layouts.master')


@section('title')
    Edit registered person
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit role for approved user</h3>
                        <hr>
                        <h4>Edit role for {{ $usermanagement->name }}:</h4>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ route('admin.updateRole', $usermanagement->id) }}" method="POST">
                                    
                                    @csrf
                                    {{-- <div class="form-group">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="name" class="form-control" id="name"
                                                value="{{ $user->name }}">

                                        </div>
                                    </div> --}}
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Give role</label>
                                            <select name="role" class="form-select form-control">

                                                <option selected>Select user role</option>
                                                {{-- <option value="manager">Manager</option>
                                                <option value="vendor">Vendor</option>
                                                <option value="">None</option> --}}
                                                @foreach ($menus as $key=>$value )
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach

                                            </select>

                                        </div>
                                    </div>
                                    <button class="btn btn-success" type="submit">Update</button>
                                    <a href="{{ route('admin.usermanagement.index') }}" class="btn btn-danger">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
