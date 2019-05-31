     
@extends('users.layouts.master')

@section('content')

     <div class="container">
    <div class="row">
        <div class="col-sm-12">
                    </div>
    </div>
</div>                <div class="container">
        <div class="row">

            <div class="col-sm-12">

                <h4 class="page-title">Dashboard</h4>
                <p class="text-muted page-title-alt">Welcome, {{Auth::user()->name}}</p>

                
                                                    <div class="alert alert-danger">
                        <strong>Pending Review</strong><br>Your account is still pending review.
                                                    This shouldn't take much time!
                        
                    </div>
                            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="widget-bg-color-icon card-box fadeInDown animated">
                    <div class="bg-icon bg-icon-info pull-left">
                        <i class="md md-attach-money text-info"></i>
                    </div>
                    <div class="text-right">
                        <h3 class="text-dark"><b class="counter">$0 / $0</b></h3>
                        <p class="text-muted">Total Earnings / Paid Earnings</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="col-md-6 col-lg-6">
                <div class="widget-bg-color-icon card-box">
                    <div class="bg-icon bg-icon-purple pull-left">
                        <i class="md md-equalizer text-purple"></i>
                    </div>
                    <div class="text-right">
                        <h3 class="text-dark"><b class="counter">0</b></h3>
                        <p class="text-muted">Referrals</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

                <div class="row" style="display: none">
            <div class="col-sm-12">
                <div class="card-box">
                    <h4 class="m-t-0 m-b-20 header-title"><b>Referral Link</b></h4>

                    <form role="form">
                        <div class="form-group">

                                <input type="text" id="example-input1-group2" name="example-input1-group2" class="form-control" value="http://thebucks.club/?r=6270" readonly="readonly" style="width: 100%;">


                        </div> <!-- form-group -->
                    </form>
                    <div class="alert alert-warning">
                        <strong>Refer Your Friends and Family and Earn $25 Per Referral!</strong>
                        Send Them This Referral Link and You'll Be Paid $25 Upon Activation of Their Account.
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>

        @endsection