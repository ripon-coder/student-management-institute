@extends('layouts.app', ['title' => 'Student Edit'])
@section('content')
    <div class="d-flex justify-content-center">
        <div class="card" style="width: 60rem">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li class="list-unstyled">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (\Session::has('msg'))
                <div>
                    <li class="alert alert-danger list-unstyled">{!! \Session::get('msg') !!}</li>
                </div>
            @endif
            @if (\Session::has('success'))
                <div>
                    <li class="alert alert-success list-unstyled">{!! \Session::get('success') !!}</li>
                </div>
            @endif
            <form action="{{ route('studenteditupdate',$student->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted text-center">
                        Student Edit
                    </h6>
                    @role('Admin')
                    <div class="mb-3">
                        <label class="form-label">Reference*</label>
                        <select name="reference" class="form-select">
                            @foreach ($reference as $ref)
                                <option @if($student->reference_id == $ref->id) selected @endif value="{{$ref->id}}">{{$ref->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endrole
                    <div class="mb-3">
                        <label class="form-label">Course*</label>
                        <select name="course_id" class="form-select">
                            @foreach ($courses as $course)
                                <option @if($course->id == $student->course_id) selected @endif  value="{{$course->id}}">{{$course->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Batch*</label>
                        <input type="text" name="batchid" value="{{ $student->batch->batchno }}" class="form-control" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Name*</label>
                        <input type="text" name="name" value="{{ $student->name }}" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Father*</label>
                        <input type="text" name="fathername" value="{{ $student->fathername }}" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mother*</label>
                        <input type="text" name="mothername" value="{{ $student->mothername }}" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mobile*</label>
                        <input type="text" name="mobile" value="{{ $student->mobile }}" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date Of Birth*</label>
                        <input type="text" name="dateofbirth" value="{{ $student->dateofbirth }}" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gender*</label>
                        <select name="gender" class="form-select">
                            <option @if($student->gender == "Male") selected @endif  value="Male">Male</option>
                            <option  @if($student->gender == "Female") selected @endif value="Female">Female</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Facebook Name</label>
                        <input type="text" name="fbname" value="{{ $student->fbname }}" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" value="{{ $student->address }}" class="form-control" />
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm text-white">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
