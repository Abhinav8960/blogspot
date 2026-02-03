 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <title>Dark Bootstrap Admin </title>
 <meta name="description" content="">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="robots" content="all,follow">

 <!-- Bootstrap CSS-->
 <link rel="stylesheet" href="{{ asset('adminassets/vendor/bootstrap/css/bootstrap.min.css') }}">
 <!-- Font Awesome CSS-->
<link rel="stylesheet" href="{{ asset('adminassets/vendor/font-awesome/css/font-awesome.min.css') }}">
 <!-- Custom Font Icons CSS-->
<link rel="stylesheet" href="{{ asset('adminassets/css/font.css') }}">
 <!-- Google fonts - Muli-->
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
 <!-- theme stylesheet-->
<link rel="stylesheet" href="{{ asset('adminassets/css/style.default.css') }}" id="theme-stylesheet">
 <!-- Custom stylesheet - for your changes-->
<link rel="stylesheet" href="{{ asset('adminassets/css/custom.css') }}">
 <!-- Favicon-->
<link rel="shortcut icon" href="{{ asset('adminassets/img/favicon.ico') }}">
 <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

 <style type="text/css">
     .post_title {
         font-size: 30px;
         font-weight: bold;
         text-align: left;
         padding: 30px;
         color: #ffffff;
     }

     /* Page background (grey) */
 

/* Center wrapper */
.post-form-wrapper {
    max-width: 600px;
    margin: 60px auto;              /* center horizontally + spacing from top */
    background: #fafafa;            /* light grey (white se soft) */
    padding: 25px 30px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

/* Form labels */
.post-form .form-label {
    font-weight: 600;
    margin-bottom: 6px;
    color: #444;
}

/* Spacing between fields */
.post-form .form-group {
    margin-bottom: 18px;
}

/* Textarea behavior */
.post-form textarea {
    resize: vertical;
}

/* Inputs subtle background to match theme */
.post-form .form-control,
.post-form .form-control-file {
    background-color: #fff;
    border: 1px solid #ced4da;
}

/* Focus state */
.post-form .form-control:focus {
    border-color: #ffc107;          /* matches btn-warning */
    box-shadow: none;
}

 </style>