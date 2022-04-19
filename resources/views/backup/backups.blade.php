@extends('layouts.app', ['title' => 'SQL Download'])
@section('content')
    <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body">
            <div class="table-responsive">
                <table class="table table-bordered app-table-hover mb-0 text-left">
                    <thead>
                        <tr>
                            <th class="cell">File Name</th>
                            <th class="cell">File Size</th>
                            <th class="cell">Created Date</th>
                            <th class="cell">Created Age</th>
                            <th class="cell">Download</th>
                            <th class="cell">Delete</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($backups as $backup)
                            <tr>
                                <td class="cell">{{ $backup['file_name'] }}</td>
                                <td class="cell">
                                    {{ \App\Http\Controllers\BackupController::humanFilesize($backup['file_size']) }}</td>
                                <td class="cell">{{ date('F jS, Y, g:ia (T)', $backup['last_modified']) }}</td>
                                <td class="cell">
                                    {{ \Carbon\Carbon::parse($backup['last_modified'])->diffForHumans() }}</td>
                                <td class="cell">
                                    <a class="btn-sm app-btn-primary" href="{{route('backupdownload',$backup['file_name'])}}">Download</a>
                                </td>
                                <td>
                                    {{ Form::open(['url' => URL::Route('backupdelete', $backup['file_name']), 'method' => 'DELETE', 'name' => 'delete']) }}
                                        <button onclick="return confirm('Do you really want to delete this file')" type="submit" class="bg-danger text-white btn-sm">Delete</button>
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
    </div>
@endsection
