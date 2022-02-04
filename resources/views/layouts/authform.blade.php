<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <link rel="shortcut icon" href="{{ asset('backend') }}/assets/images/favicon.ico">
        @yield('title')
        <!-- App css -->
        <link href="{{ asset('backend') }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend') }}/assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend') }}/assets/css/style.css" rel="stylesheet" type="text/css" />
        <script src="{{ asset('backend') }}/assets/js/modernizr.min.js"></script>
    </head>
    <body>
        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class="text-center">
                <a href="index.html" class="logo"><span>Admin<span>to</span></span></a>
                <h5 class="text-muted m-t-0 font-600">Responsive Admin Dashboard</h5>
            </div>
            @yield('auth_form')
            <div class="row">
                <div class="col-sm-12 text-center">
                    @if (Request::url() == route('register'))
                        <p class="text-muted">Already have account? <a href="{{ route('login') }}" class="text-primary m-l-5"><b>Sign In</b></a></p>
                    @else
                        <p class="text-muted">Don't have an account? <a href="{{ route('register') }}" class="text-primary m-l-5"><b>Sign Up</b></a></p>
                    @endif
                </div>
            </div>
        </div>
        <!-- end wrapper page -->
        <!-- jQuery  -->
        <script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script>
        <script src="{{ asset('backend') }}/assets/js/popper.min.js"></script>
        <script src="{{ asset('backend') }}/assets/js/bootstrap.min.js"></script>
        <script src="{{ asset('backend') }}/assets/js/detect.js"></script>
        <script src="{{ asset('backend') }}/assets/js/fastclick.js"></script>
        <script src="{{ asset('backend') }}/assets/js/jquery.blockUI.js"></script>
        <script src="{{ asset('backend') }}/assets/js/waves.js"></script>
        <script src="{{ asset('backend') }}/assets/js/jquery.nicescroll.js"></script>
        <script src="{{ asset('backend') }}/assets/js/jquery.slimscroll.js"></script>
        <script src="{{ asset('backend') }}/assets/js/jquery.scrollTo.min.js"></script>
        <!-- App js -->
        <script src="{{ asset('backend') }}/assets/js/jquery.core.js"></script>
        <script src="{{ asset('backend') }}/assets/js/jquery.app.js"></script>
	</body>
</html>
