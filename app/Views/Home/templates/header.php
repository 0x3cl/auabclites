<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Kimuel Mariano, Carl Llemos, John Paul Asis, Jehmielle Lacdao">
    <meta name="description" content="">
    <meta name="keywords" content="SITES, School of Information Technology Education, AULITES, AUABCLITES AUABCSITES">
    <meta name="theme-color" content="#801313">
    <meta property="og:image" content="/">
    <meta property="og:title" content="SITES | ARELLANO UNIVERSITY ANDRES BONIFACIO CAMPUS">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/assets/images/favicon/site.webmanifest">
    <title><?= $title;?></title>
    <!-- BS5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- BOXICONS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="/assets/libraries/css/app.css">
</head>
<body>
<div class="cookie-policy">
    <div class="container p-4">
        <div class="d-md-flex justify-content-between">
            <div class="cookie-description">
                <small>
                    This website uses cookies to ensure you get the best experience on our website.
                    By using our website you agree on the following <a href="#">Cookie Policy</a>,
                    <a href="#">Privacy Policy</a> and <a href="#">Term Of Use</a>
                </small>
            </div>
            <div class="mt-4 m-md-0">
                <button class="btn-custom btn-custom-light" id="cookie-accept">Accept</button>
                <button class="btn-custom btn-custom-outline-light" id="cookie-decline">Decline</button>
            </div>
        </div>
    </div>
</div>
<!-- <div class="loader">
    <div class="loader-primary"></div>
    <div class="loader-secondary"></div>
    <div class="loader-tertiary"></div>
    <div class="loader-content">
        <div>
            <div class="logo-content">
                <img src="/assets/images/logo/it_logo.png" alt="" srcset="">
                <img src="/assets/images/logo/cs_logo.png" alt="" srcset="">
                <img src="/assets/images/logo/au_logo.png" alt="" srcset="">
                <img src="/assets/images/logo/site_logo.png" alt="" srcset="">
                <img src="/assets/images/logo/lites_logo.png" alt="" srcset="">
            </div>
        </div>
    </div>
</div> -->
<div class="scroll-top">
    <i class='bx bxs-up-arrow' ></i>
</div>
<?= $this->include('home/templates/navigation') ?>
