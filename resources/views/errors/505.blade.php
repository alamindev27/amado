<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <title>505 Internal Server Error</title>
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
            <div class="ex-page-content text-center">
                <div class="text-error">500</div>
                <h3 class="text-uppercase font-600">Internal Server Error</h3>
                <p class="text-muted">
                    Why not try refreshing your page? or you can contact <a href="" class="text-primary">support</a>
                </p>
                <br>
                <a class="btn btn-success waves-effect waves-light" href="{{ rul('/') }}"> Return Home</a>
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
