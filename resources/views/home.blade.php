@extends('layouts.app')
@section('title')
<title>Dashboard</title>
@endsection
@section('content')
    <div class="row">
        @foreach ($admins as $admin)
            <div class="col-xl-3 col-md-6 m-auto">
                <div class="card-box widget-user">
                    <div>
                        <img src="{{ asset('image/profile') }}/{{ $admin->profile }}" class="img-responsive rounded-circle" alt="admin">
                        <div class="wid-u-info">
                            <h5 class="mt-0 m-b-5">{{ $admin->name }} <span>{{ auth()->user()->email == $admin->email ? '(YOU)' : '' }}</span> </h5>
                            <a href="mailto:{{ $admin->email }}">
                                <p class="text-muted m-b-5 font-13">{{ $admin->email }}</p>
                            </a>
                            <small class="text-warning"><b>Admin</b></small>
                            <small class="pull-right mt-1">{{ getCountProdut($admin->id) }} Products</small>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
        @endforeach
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-xl-4">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-dots-vertical"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                    </div>
                </div>

                <h4 class="header-title mt-0 m-b-30">Inbox</h4>

                <div class="inbox-widget nicescroll" style="height: 315px; overflow: hidden; outline: none;" tabindex="5000">
                    <a href="#">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="http://127.0.0.1:8000/backend/assets/images/users/avatar-1.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author">Chadengle</p>
                            <p class="inbox-item-text">Hey! there I'm available...</p>
                            <p class="inbox-item-date">13:40 PM</p>
                        </div>
                    </a>
                    <a href="#">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="http://127.0.0.1:8000/backend/assets/images/users/avatar-2.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author">Tomaslau</p>
                            <p class="inbox-item-text">I've finished it! See you so...</p>
                            <p class="inbox-item-date">13:34 PM</p>
                        </div>
                    </a>
                    <a href="#">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="http://127.0.0.1:8000/backend/assets/images/users/avatar-3.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author">Stillnotdavid</p>
                            <p class="inbox-item-text">This theme is awesome!</p>
                            <p class="inbox-item-date">13:17 PM</p>
                        </div>
                    </a>
                    <a href="#">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="http://127.0.0.1:8000/backend/assets/images/users/avatar-4.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author">Kurafire</p>
                            <p class="inbox-item-text">Nice to meet you</p>
                            <p class="inbox-item-date">12:20 PM</p>
                        </div>
                    </a>
                    <a href="#">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="http://127.0.0.1:8000/backend/assets/images/users/avatar-5.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author">Shahedk</p>
                            <p class="inbox-item-text">Hey! there I'm available...</p>
                            <p class="inbox-item-date">10:15 AM</p>
                        </div>
                    </a>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-xl-8">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-dots-vertical"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                    </div>
                </div>

                <h4 class="header-title mt-0 m-b-30">Latest Projects</h4>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Project Name</th>
                            <th>Start Date</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Assign</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Adminto Admin v1</td>
                                <td>01/01/2017</td>
                                <td>26/04/2017</td>
                                <td><span class="badge badge-danger">Released</span></td>
                                <td>Coderthemes</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Adminto Frontend v1</td>
                                <td>01/01/2017</td>
                                <td>26/04/2017</td>
                                <td><span class="badge badge-success">Released</span></td>
                                <td>Adminto admin</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Adminto Admin v1.1</td>
                                <td>01/05/2017</td>
                                <td>10/05/2017</td>
                                <td><span class="badge badge-pink">Pending</span></td>
                                <td>Coderthemes</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Adminto Frontend v1.1</td>
                                <td>01/01/2017</td>
                                <td>31/05/2017</td>
                                <td><span class="badge badge-purple">Work in Progress</span>
                                </td>
                                <td>Adminto admin</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Adminto Admin v1.3</td>
                                <td>01/01/2017</td>
                                <td>31/05/2017</td>
                                <td><span class="badge badge-warning">Coming soon</span></td>
                                <td>Coderthemes</td>
                            </tr>

                            <tr>
                                <td>6</td>
                                <td>Adminto Admin v1.3</td>
                                <td>01/01/2017</td>
                                <td>31/05/2017</td>
                                <td><span class="badge badge-primary">Coming soon</span></td>
                                <td>Adminto admin</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- end col -->

    </div>
    <!-- end row -->
@endsection
