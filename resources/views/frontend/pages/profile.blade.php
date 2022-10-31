@extends('frontend.master')

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Username <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li align="center" class="well">
                                    <div><img class="img-responsive" style="padding:2%;" src="https://bootdey.com/img/Content/avatar/avatar1.png" /><a class="change" href="">Change Picture</a></div>
                                    <a href="#" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-lock"></span> Security</a>
                                    <a href="#" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    
                </div>  
            </div>
        </div>
    </div>
</section>
  
@endsection