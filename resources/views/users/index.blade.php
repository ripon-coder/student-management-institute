@extends('layouts.app', ['title' => 'Staff Managament'])

@section('content')
    <div class="pb-2">
        <a href="{{ route('users.create') }}"><button type="button" class="btn app-btn-primary ">Add New Staff</button></a>
    </div>
    <div class="app-card app-card-orders-table shadow-sm mb-5">
        @if (\Session::has('success'))
            <div class="container">
                <li class="alert alert-success list-unstyled">{!! \Session::get('success') !!}</li>
            </div>
        @endif
        <div class="app-card-body">
            <div class="table-responsive">
                <table class="table app-table-hover mb-0 text-left">
                    <thead>
                        <tr>
                            <th class="cell">#ID</th>
                            <th class="cell">Name</th>
                            <th class="cell">Last Seen</th>
                            <th class="cell">Email</th>
                            <th class="cell">Role</th>
                            <th class="cell">Created Date</th>
                            <th class="cell">Status</th>
                            <th class="cell">Edit</th>
                            <th class="cell">View</th>
                            <th class="cell">Login</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($AllUser as $user)
                            <tr>
                                <td class="cell">#{{ $user->id }}</td>
                                <td class="cell"><span class="truncate">{{ $user->name }}
                                    @if(Cache::has('user-is-online-' . $user->id))
                                    <sup class="bg-success text-white">Online</sup>
                                    @endif
                                </span></td>
                                <td class="cell"> {{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</td>
                                <td class="cell">{{ $user->email }}</td>
                                <td class="cell">
                                    @foreach ($user->roles as $role)
                                        <a class="btn-sm btn-warning" href="#">{{ $role->name }}</a>
                                    @endforeach
                                </td>
                                <td class="cell">{{ $user->created_at }}</td>
                                <td class="cell">
                                    @if ($user->status == 1)
                                        <span class="badge bg-info">Active</span>
                                    @else
                                        <span class="badge bg-danger">Disabled</span>
                                    @endif
                                </td>
                                <td class="cell"><a class="btn-sm app-btn-primary"
                                        href="{{ route('users.edit', $user->id) }}">Edit</a></td>
                                <td class="cell">
                                    <a class="btn-sm app-btn-secondary"
                                        href="{{ route('users.show', $user->id) }}">View</a>
                                </td>
                                <td>
                                  {{ Form::open(array('url' =>URL::Route("loginbyadmin", $user->id), 'method' => 'POST', 'name' => 'login')) }}
                                        <button type="submit" class="btn-sm app-btn-primary">Login</button>
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!--//table-responsive-->
        </div>
        <!--//app-card-body-->
        <div class="d-flex justify-content-center pt-4">
            <nav class="app-pagination">
                {{$AllUser->links("pagination::bootstrap-4")}}
            </nav>
        </div>
    </div>
@endsection
