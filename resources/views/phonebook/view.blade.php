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
                    <h3 class="text-themecolor">View Phonebook</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">View Phonebook</li>
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Phonebooks</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Name</th>
                                                <th>No of contacts</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                           <?php $sn=1;?>
                                            @foreach($phonebooks as $phonebook)

                                                <?php
                                                    if(!isset($phonebook->id)){continue;}
                                                    ?>

                                            <tr>
                                                <td>{{$sn}}</td>
                                                <td>{{$phonebook->name}}</td>
                                                <td>{{number_format($phonebook->contact->count())}}</td>
                                                <td>

                                                    <a href="{{URL::to('/sendsms/fasttrack/'.$phonebook->id)}}" class="btn btn-xs btn-success">Send SMS</a>

                                                    <a href="{{URL::to('/contact/view/'.$phonebook->id)}}" class="btn btn-xs btn-primary">View</a>

                                                    <a href="{{URL::to('/phonebook/delete/'.$phonebook->id)}}" class="btn btn-xs btn-danger">Delete</a>

                                                </td>
                                            </tr>

                                            <?php $sn++; ?>
                                            @endforeach




                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                            <center>
                                {{ $phonebooks->links() }}
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
