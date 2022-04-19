@extends('layouts.app', ['title' => 'Batch Edit'])

@section('content')
    <div class="app-card app-card-settings shadow-sm p-4">
        <h1 class="app-page-title text-center">Batch Edit</h1>
        <div class="app-card-body">
            <v-app>
                <v-main>
                    <batch-edit batchid={{$batch->id}}></batch-edit>
                </v-main>
            </v-app>
        </div>
    </div>

@endsection