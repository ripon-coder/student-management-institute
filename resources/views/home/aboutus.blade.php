@extends('layoutshome.master')
@section('content')
<section class="accordion_two_section ptb-100">
    <div class="container bg-white">
        <div class="col-sm-12 p-3">
            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
            </p>
        </div>
        <div class="row p-3">
            <div class="col-sm-6 accordionTwo">
                <div class="panel-group" id="accordionTwoLeft">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordionTwoLeft" href="#collapseTwoLeftone" aria-expanded="false" class="collapsed"> আমরা কি ধরনের সেবা প্রধান করি? </a> </h4>
                        </div>
                        <div id="collapseTwoLeftone" class="panel-collapse collapse" aria-expanded="false" role="tablist" style="height: 0px;">
                            <div class="panel-body"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus hendrerit risus nisl, nec facilisis ante iaculis fringilla. Integer mattis risus vel dapibus rhoncus. Duis ut nulla et metus vehicula facilisis non eu quam. </div>
                        </div>
                    </div> <!-- /.panel-default -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordionTwoLeft" href="#collapseTwoLeftTwo" aria-expanded="false"> Candle IT Institute কে পছন্দের শীর্ষে রাখবেন কেন?</a> </h4>
                        </div>
                        <div id="collapseTwoLeftTwo" class="panel-collapse collapse" aria-expanded="false" role="tablist">
                            <div class="panel-body"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus hendrerit risus nisl, nec facilisis ante iaculis fringilla. Integer mattis risus vel dapibus rhoncus. Duis ut nulla et metus vehicula facilisis non eu quam. </div>
                        </div>
                    </div> <!-- /.panel-default -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordionTwoLeft" href="#collapseTwoLeftThree" aria-expanded="false"> কোর্স শেষে কি আপনি ইনকাম করতে পারবেন? </a> </h4>
                        </div>
                        <div id="collapseTwoLeftThree" class="panel-collapse collapse" aria-expanded="false" role="tablist">
                            <div class="panel-body"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus hendrerit risus nisl, nec facilisis ante iaculis fringilla. Integer mattis risus vel dapibus rhoncus. Duis ut nulla et metus vehicula facilisis non eu quam. </div>
                        </div>
                    </div> <!-- /.panel-default -->
                </div>
                <!--end of /.panel-group-->
            </div>
            <!--end of /.col-sm-6-->
            <div class="col-sm-6 accordionTwo">
                <div class="panel-group" id="accordionTwoRight">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordionTwoRight" href="#collapseTwoRightone" aria-expanded="false">কোর্স শেষে আমরা ভিডিও প্রধান করি কিনা?</a> </h4>
                        </div>
                        <div id="collapseTwoRightone" class="panel-collapse collapse" aria-expanded="false" role="tablist">
                            <div class="panel-body"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus hendrerit risus nisl, nec facilisis ante iaculis fringilla. Integer mattis risus vel dapibus rhoncus. Duis ut nulla et metus vehicula facilisis non eu quam. </div>
                        </div>
                    </div> <!-- /.panel-default -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordionTwoRight" href="#collapseTwoRightTwo" aria-expanded="false">অফলাইনে ক্লাস করার সুবিধা আছে কি?</a> </h4>
                        </div>
                        <div id="collapseTwoRightTwo" class="panel-collapse collapse" aria-expanded="false" role="tablist">
                            <div class="panel-body"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus hendrerit risus nisl, nec facilisis ante iaculis fringilla. Integer mattis risus vel dapibus rhoncus. Duis ut nulla et metus vehicula facilisis non eu quam. </div>
                        </div>
                    </div> <!-- /.panel-default -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordionTwoRight" href="#collapseTwoRightThree" aria-expanded="false">আপনি কি কোর্স শেষে সার্টিফিকেট পাবেন? </a> </h4>
                        </div>
                        <div id="collapseTwoRightThree" class="panel-collapse collapse in" aria-expanded="false" role="tablist">
                            <div class="panel-body"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus hendrerit risus nisl, nec facilisis ante iaculis fringilla. Integer mattis risus vel dapibus rhoncus. Duis ut nulla et metus vehicula facilisis non eu quam. </div>
                        </div>
                    </div> <!-- /.panel-default -->
                </div>
                <!--end of /.panel-group-->
            </div>
            <!--end of /.col-sm-6-->
        </div>
    </div>
    <!--end of /.container-->
</section>
@endsection