@extends('layouts.page')

@section('content')


<!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Send SMS</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Send SMS</li>
                    </ol>
                </div>
                
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">

                @if(Session::has('notification'))
          <p class="alert alert-success alert-sm alert-dismissable">{{Session::get('notification')}}</p>
        @endif
                
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">


                    <div class="col-md-12">
                        <div class="card card-body">
                            <h3 class="box-title m-b-0"></h3>
                            <p class="text-muted m-b-30 font-13"> </p>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">










                                    <form role="form" action="{{URL::to('/sms/send')}}" method="POST">

                                        {{ csrf_field() }}



                                        
                                        <div class="form-group{{ $errors->has('phonebook_id') ? ' has-error' : '' }}">
                                            <label for="exampleInputEmail1">Select phonebook</label>
                                            <select class="custom-select col-12" id="inlineFormCustomSelect" name="phonebook_id">


                                                <option disabled="disabled" >Choose phonebook</option>

                                                @foreach($phonebooks as $phonebook)


                                                <option 

                                                 @if (isset($fphonebook_id) && $fphonebook_id == $phonebook->id) 
                                                 {{"selected" }} 
                                                 @endif
                                                value="{{$phonebook->id}}" >{{$phonebook->name}}
                                            </option>

                                                @endforeach


                                            </select>

                                            @if ($errors->has('phonebook_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phonebook_id') }}</strong>
                                    </span>
                                @endif

                                        </div>



                                        <div class="form-group{{ $errors->has('sender') ? ' has-error' : '' }}">
                                            <label for="exampleInputEmail1">Sender's name</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter sender's name (must not be more that 11 characters)" name="sender">

                                             @if ($errors->has('sender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sender') }}</strong>
                                    </span>
                                @endif
                                        </div>


                                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                            <label for="exampleInputEmail1">Title</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter title of SMS" name="title">

                                             @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                                        </div>




                                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                            <label for="exampleInputEmail1">Body</label>
                                            <textarea  name="body" class="form-control" rows="5" placeholder="Body of the SMS (must not be more that 160 characters)"></textarea>


                                             @if ($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif

                                        </div>

                                        
                                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Send</button>
                                    </form>





                                </div>
                            </div>
                        </div>
                    </div>
                   







                </div>
                
                
                <!-- Row -->
                
                <!-- Row -->
                <!-- Row -->
                
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                © 2017 GreatGrantAid.com
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->


@endsection
