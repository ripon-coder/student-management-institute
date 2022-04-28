@extends('layouts.app')
@section('content')
    <div class="page-min-height addQuestion bg-white p-4">
        @if ($questionAdded)
            <div class="col-sm-12 col-md-12 alert alert-info">
                <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                Question successfully added to {{ $test->title }}.
            </div>
        @endif
        <div class="container">
            <div class="row" style="margin: 30px 0px">
                <div class="col-md-8 offset-md-2">
                    @if ($message = Session::get('failure'))
                        <div class="alert alert-danger" id="message_id">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 30px;">
            <div class="col-md-6 offset-md-3">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success" id="message_id">
                        <p>{{ $message }}</p>
                    </div>
                @endif
            </div>
        </div>


        <div class="container-fluid">
            <div id="responsiveTabsDemo" class="row">
                <ul class="register_tab_title col-md-3 content_left">
                    <li><a href="#tab-info">
                            <h4>{{ $test->title }} Quiz</h4>
                        </a></li>
                    @if (count($questions) > 0)
                        @foreach ($questions as $index => $question)
                            <li><a href="#tab-{{ $index + 1 }}">{{ $index + 1 }}. {{ $question->question }}</a></li>
                        @endforeach
                    @endif
                </ul>
                <div class="col-md-9 content_right">
                    <div class="register_tab_content">
                        <div id="tab-info" class="quesion_display">
                            <div class="inner-container">
                                <div class="card cardHome">
                                    <div class="content active" style="color: black; padding: 20px">
                                        <h4>{{ $test->title }} Quiz</h4>
                                        <h4>Min. No. of questions: {{ $test->no_of_questions }}</h4>
                                        <h4>Total Questions: {{ $questionsCount }}</h4>
                                        @if (!$test->permitted)
                                            {{ Form::open(['url' => 'activateQuiz/' . $test->quizid, 'role' => 'form', 'class' => 'form-horizontal']) }}
                                            <button type="submit" id="activate-test-{{ $test->quizid }}"
                                                class="btn btn-sm btn-success">Activate Test</button>
                                            {{ Form::close() }}
                                        @else
                                            {{ Form::open(['url' => 'deactivateQuiz/' . $test->quizid, 'role' => 'form', 'class' => 'form-horizontal']) }}
                                            <button type="submit" id="deactivate-test-{{ $test->quizid }}"
                                                class="btn btn-sm btn-danger">Deactivate Test</button>
                                            {{ Form::close() }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (count($questions) > 0)
                        @foreach ($questions as $index => $question)
                            <div class="register_tab_content">
                                <div id="tab-{{ $index + 1 }}" class="quesion_display">
                                    <h4>{{ $index + 1 }}. {{ $question->question }}</h4>
                                    <!-- <p>Description (Optional)</p> -->
                                    @if ($question->question_type == 'mcq')
                                        <hr>
                                        <div class="row numbers">
                                            <div class="col-6">
                                                a) {{ $question->option_1 }}
                                            </div>
                                            <div class="col-6">
                                                b) {{ $question->option_2 }}
                                            </div>
                                            <div class="col-6">
                                                c) {{ $question->option_3 }}
                                            </div>
                                            <div class="col-6">
                                                d) {{ $question->option_4 }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-12" style="padding-left: 0px">
                                            <h4>Answer: {{ $question->answer }}</h4>
                                        </div>
                                    @endif
                                    @if ($question->question_type == 'tf')
                                        <hr>
                                        <div class="row">
                                            @if ($question->answer == 1)
                                                <div class="col-12">
                                                    <h3>Answer: <span>True </span></h3>
                                                </div>
                                            @else
                                                <div class="col-12">
                                                    <h3>Answer: <span>False</span></h3>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    @if ($question->question_type == 'fib')
                                        <hr>
                                        <div class="col-12" style="padding-left: 0px">
                                            <h3>Answer: {{ $question->answer }}</h3>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="add_que_class">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddQueModal"><i
                        class="fa fa-plus" style="color: rgb(0, 0, 0);"></i>
                </button>
            </div>
        </div>
        <!-- modal -->
        <div class="modal fade" id="AddQueModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                {!! Form::open(['url' => URL::Route('addQuestion',$test->quizid), 'name' => 'add-question', 'id' => 'add-question', 'role' => 'form']) !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Question</h4>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="margin: 10px 0px">
                            <div class="col-md-12">
                                <div class="filter-content">
                                    <div class="form-group">
                                        <p><b>Question Type:</b></p>
                                        <div class="form-check">
                                            <input type="radio" value="mcq" id="mcq" name="question-type"
                                                class="pull-left form-check-input" required="" />
                                            <label class="form-check-label" for="mcq">&nbsp;&nbsp;MCQ</label>
                                        </div>


                                        <br>
                                        <div class="form-check">
                                            <input type="radio" value="tf" id="tf" name="question-type"
                                                class="pull-left form-check-input" required="" />
                                            <label class="form-check-label" for="tf">&nbsp;&nbsp;True Or False</label>
                                        </div>
                                        <br>
                                        <div class="form-check">
                                            <input type="radio" value="fib" id="fib" name="question-type"
                                                class="pull-left form-check-input" required="" />
                                            <label class="form-check-label" for="fib">&nbsp;&nbsp;Fill the Blank</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <br>
                                    <div class="mb-3">
                                        <textarea rows="3" cols="20" class="form-control" id="question-text" name="question-text" form="add-question"
                                            placeholder="Enter Question..."></textarea>
                                    </div>
                                </div>
                                <div class="box mcq">

                                    <div class="input-group">
                                        <span class="input-group-text">Option 1</span>
                                        <input type="text" name="option1" id="option1" class="form-control">
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-text">Option 2</span>
                                        <input type="text" name="option2" id="option2" class="form-control">
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-text">Option 3</span>
                                        <input type="text" name="option3" id="option3" class="form-control">
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-text">Option 4</span>
                                        <input type="text" name="option4" id="option4" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group box tf">
								<br>
                                <div class="input-group">
                                    <span class="input-group-text">Select Answer:</span>
                                    <select class="form-select" id="sel1" name="tfanswer">
                                        <option value="1">True</option>
                                        <option value="0">False</option>
                                    </select>
                                </div>

                            </div>
                            <div class="form-group box mcq fib">
                                <br>
                                <div class="input-group">
                                    <span class="input-group-text">Answer</span>
                                    <input type="text" name="answer" id="answer" class="form-control">
                                </div>

                            </div>
                            <div class="form-group">
                                <br>
                                <div class="input-group">
                                    <span class="input-group-text">Time</span>
                                    <input id="time" type="text" name="question-duration" id="answer"
                                        placeholder="in MM:SS format" class="form-control">
                                </div>

                            </div>
							<div class="form-group">
								<br>
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary float-end">Save</button>
							</div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    </div>
    <script type="text/javascript">
        $("document").ready(function() {
            setTimeout(function() {
                $("#message_id").remove();
            }, 2000);
        });
    </script>
@endsection
