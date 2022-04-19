@extends('layoutshome.master')
@section('content')
    <section class="ftco-section contact-section riponcolor ">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card" style="width: 50rem;">
                    <div class="card-body">
                        <form action="{{ route('scholarshipFormstore') }}" method="post">
                            <div class="row d-flex contact-info">
                                <div class="col-md-12 mb-4">
                                    <h2 class="h4 text-center"><b>SCHOLARSHIP ADMISSION FORM</b></h2>
                                </div>
                                <div class="w-100"></div>

                                @csrf
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name* </label>
                                        <input type="text" id="name" value="{{ old('name') }}" name="name"
                                            class="form-control" placeholder="Name" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="father">Father's Name* </label>
                                        <input type="text" id="father" name="fatherName" value="{{ old('fatherName') }}"
                                            class="form-control" placeholder="Father's Name" required>
                                        @error('fatherName')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mother">Mother's Name* </label>
                                        <input type="text" id="mother" name="motherName" value="{{ old('motherName') }}"
                                            class="form-control" placeholder="Mother's Name" required>
                                        @error('motherName')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

    

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile Number* </label>
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text">+88</span>
                                        <input type="text" id="mobile" name="mobileNumber" value="{{ old('mobileNumber') }}"
                                            class="form-control" placeholder="01xxxxxxxxx" required>
                                        </div>
                                        @error('mobileNumber')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="datepicker">Date Of Birth* </label>
                                        <input type="text" name="dateBirth" value="{{ old('dateBirth') }}"
                                            class="form-control" placeholder="31/12/1996" id="datepicker" title="Date of Birth" required>
                                        @error('dateBirth')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Gender* </label>
                                        <select id="gender" name="gender" class="form-control">
                                            <option checked value="0">---Select---</option>
                                            <option @if(old('gender') == "Male") selected @endif value="Male">Male</option>
                                            <option @if(old('gender') == "Female") selected @endif value="Female">Female</option>
                                        </select>
                                        @error('gender')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Present Address* </label>
                                        <input id="address" name="presentAddress" value="{{ old('presentAddress') }}"
                                            type="text" class="form-control" placeholder="Present Address">
                                        @error('presentAddress')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="facebook">Facebook Name </label>
                                        <input id="facebook" name="facebookName" value="{{ old('facebookName') }}"
                                            type="text" class="form-control" placeholder="Facebook Name" required>
                                        @error('facebookName')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="education">Educational Qualification* </label>
                                        <select id="education" name="educationalQualification" class="form-control">
                                            <option checked value="0">---Select---</option>
                                            <option value="jsc">JSC </option>
                                            <option value="ssc">SSC </option>
                                            <option value="hsc">HSC </option>
                                            <option value="honours">Honours </option>
                                            <option value="masters">Masters </option>
                                            <option value="degree">Degree </option>
                                            <option value="ba">B.A.</option>
                                            <option value="bba">BBA</option>
                                            <option value="diploma">Diploma</option>
                                            <option value="barch">BArch</option>
                                            <option value="bm">BM</option>
                                            <option value="bfa">BFA</option>
                                            <option value="bsc">B.Sc.</option>
                                            <option value="ma">M.A.</option>
                                            <option value="mba">M.B.A.</option>
                                            <option value="mfa">MFA</option>
                                            <option value="msc">M.Sc.</option>
                                            <option value="jd">J.D.</option>
                                            <option value="md">M.D.</option>
                                            <option value="phd">Ph.D</option>
                                            <option value="llb">LLB</option>
                                            <option value="llm">LLM</option>
                                            <option value="other">Other</option>
                                        </select>
                                        @error('educationalQualification')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="method">Payment Method* </label>
                                        <select name="method" id="method" class="form-control">
                                            <option checked value="0">----Select----</option>
                                            <option @if(old('method') == "Bkash") selected @endif value="Bkash">Bkash</option>
                                            <option @if(old('method') == "Rocket") selected @endif value="Rocket">Rocket</option>
                                            <option @if(old('method') == "Nagad") selected @endif value="Nagad">Nagad</option>
                                            <option @if(old('method') == "Nexus-Pay") selected @endif value="Nexus-Pay">Nexus-Pay</option>
                                        </select>
                                        @error('method')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="reference">Reference* </label>
                                        <select name="reference" id="reference" class="form-control">
                                            <option checked value="0">----Select----</option>
                                            @foreach ($references as $refer)
                                                <option @if(old('reference') == $refer->id) selected @endif checked value="{{ $refer->id }}">{{ $refer->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('reference') <span class="text-danger">{{$message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="batch">Batch No* </label>
                                        <input id="batch" name="batch" value="{{ old('batch') }}"
                                            type="text" class="form-control" required>
                                        @error('batch') <span class="text-danger">{{$message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="course">Select Course*</label>
                                        <select name="course" id="course" class="form-control">
                                            <option checked value="0">----Select----</option>
                                            @foreach ($course as $item)
                                                <option @if(old('course') == $item->id) selected @endif value="{{ $item->id }}">{{ $item->title }}
                                                    @<?php echo $item->discount_price; ?>TK
                                                    ({{ round($item->discount, 2) }}% OFF)
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('course')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="submit" value="Apply Now" class="btn btn-primary py-2 px-3">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
