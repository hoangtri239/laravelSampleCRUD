@extends('layouts.master')

@section('content')
<!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date joined</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}} @if($user->id == \Auth::user()->id) (you) @endif</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{date_format(date_create($user->created_at), 'd/m/y')}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $users->links() }}
        </div>
    </div>
@endsection
