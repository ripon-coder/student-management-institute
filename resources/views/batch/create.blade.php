
@extends('layouts.app', ['title' => 'Add New Batch'])
@section('content')
    <div class="app-card app-card-settings shadow-sm p-4">
        <h1 class="app-page-title text-center">Create Batch</h1>
        <div class="app-card-body">
            <v-app>
                <v-main>
                    <batch-create></batch-create>
                </v-main>
            </v-app>
        </div>
    </div>

@endsection