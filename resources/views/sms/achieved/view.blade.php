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
                    <h3 class="text-themecolor">Achieved</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Achieved</li>
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
                
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Achieved list</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Phonebook name</th>
                                                <th>Sender</th>
                                                <th>SMS title</th>
                                                <th>SMS body</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>



                                            <?php $sn=1;?>

                                            @foreach($smses as $sms)
                                            <?php //if(!isset($sms->phonebook->name)){
                                                //continue;}?>

                                            <tr>
                                                <td>{{$sn}}</td>
                                                <td>{{$sms->phonebook->name}}</td>
                                                <td>{{$sms->sender}}</td>
                                                <td>{{$sms->title}}</td>
                                                <td style="font-size:80%;">
                                                    {{$sms->body}}
                                                </td>
                                                <td><label class="label label-xs label-info">Sent</label></td>
                                                
                                                <td>

                                                    <a href="{{URL::to('/achieved/resend/'.$sms->id)}}" class="btn btn-xs btn-success">Resend</a>

                                                    <!--<a href="" class="btn btn-xs btn-primary">View</a>-->

                                                    <a href="{{URL::to('/achieved/delete/'.$sms->id)}}" class="btn btn-xs btn-danger">Delete</a>

                                                </td>
                                            </tr>

                                            <?php $sn++;?>
                                            @endforeach

                                           





                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                            <center>
                                {{ $smses->links() }}
                            </center>

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
