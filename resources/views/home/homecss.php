<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="initial-scale=1, maximum-scale=1">

<title>A World</title>

<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">

<!-- bootstrap css -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

<!-- style css -->
<link rel="stylesheet" type="text/css" href="css/style.css">

<!-- Responsive-->
<link rel="stylesheet" href="css/responsive.css">

<!-- fevicon -->
<link rel="icon" href="images/fevicon.png" type="image/gif" />

<!-- Scrollbar Custom CSS -->
<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">

<!-- font-awesome -->
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">

<!-- fonts -->
<link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Righteous&display=swap" rel="stylesheet">

<!-- owl stylesheets -->
<link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/owl.theme.default.min.css">

<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
    media="screen">

<!-- ✅ Global background -->
<style>
    body {
        background-color: #dfdfdfff;
    }

    .about-img-wrapper {
        width: 100%;
        text-align: center;
    }

    .about_img {
        max-width: 70%;
        height: auto;
        border-radius: 12px;
        /* smooth corners */
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        /* soft shadow */
        transition: transform 0.3s ease;
    }

    .about_img:hover {
        transform: scale(1.03);
        /* subtle hover zoom */
    }

    .home-blog-section {
        background: #f7f7f9;
        /* same as post details bg */
        padding: 80px 0;
    }

    .home-blog-title {
        font-size: 38px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .home-blog-subtitle {
        font-size: 24px;
        font-weight: 600;
        color: #666;
        margin-bottom: 15px;
    }

    .home-blog-text {
        font-size: 15px;
        color: #555;
        line-height: 1.8;
        max-width: 700px;
        margin-bottom: 30px;
    }

    .home-video-btn img {
        width: 80px;
        border-radius: 50%;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease;
    }

    .home-video-btn:hover img {
        transform: scale(1.1);
    }

    @media (max-width: 768px) {
        .home-blog-section {
            padding: 50px 0;
        }

        .home-blog-title {
            font-size: 28px;
        }
    }
    /* Blog page background fix */
.blog_section.home-blog-section {
    background-color: #dfdfdf !important;
}

/* Container ka white bg hatao (important) */
.blog_section.home-blog-section .container {
    background: transparent !important;
}
 .post-title {
            font-size: 36px;
            font-weight: 700;
        }
        /* Form wrapper */
        .post-form-wrapper {
            max-width: 650px;
            margin: 0 auto;
        }

        .post-form {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.08);
        }

        /* Labels */
        .post-form .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
        }

        /* Inputs & textarea */
        .post-form .form-control,
        .post-form .form-control-file {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px 14px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .post-form .form-control:focus {
            border-color: #f0ad4e;
            box-shadow: 0 0 0 0.15rem rgba(240, 173, 78, 0.25);
        }

        /* Spacing between fields */
        .post-form .form-group {
            margin-bottom: 20px;
        }

        /* Submit button */
        .post-form .btn-warning {
            background: linear-gradient(135deg, #f0ad4e, #ec971f);
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        .post-form .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(240, 173, 78, 0.4);
        }

</style>