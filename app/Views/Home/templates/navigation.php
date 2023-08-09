<div class="navigation">
    <div class="header-top">
        <div class="container d-sm-flex align-items-center">
            <ul class="list-inline mb-0 d-flex justify-content-center">
                <li class="list-inline-item">
                    <a href="#" class="nav-link">
                        <i class='bx bxl-facebook'></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="#" class="nav-link">
                        <i class='bx bxl-instagram'></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="#" class="nav-link">
                        <i class='bx bxl-twitter'></i>
                    </a>
                </li>
                <li class="list-inline-item d-none d-md-inline-block">
                    <a href="#" class="nav-link">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <i class='bx bxs-envelope'></i>
                            <span>contact@auabclites.com</span>
                        </div>
                    </a>
                </li>
            </ul>
            <ul class="list-inline mb-0 d-flex justify-content-center d-md-inline-block ms-auto mt-2 mt-md-0">
                <li class="list-inline-item">
                    <a href="#" class="text-link">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <i class='bx bxs-left-arrow-square bx-rotate-180' ></i>
                            <span>Learning Management System</span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <nav class="navbar header navbar-expand-lg">
        <div class="container">
            <div class="logo solo">
                <img src="/assets//images/logo/site_logo.png" alt="" srcset="">
            </div>
            <a href="#" class="navbar-brand d-none d-lg-block">
                <div>School of Information</div> 
                <div>Technology Education</div>
            </a>
            <div class="hamburger-wrapper">
                <div class="hamburger"></div>
            </div>
            <div class="logo group">
                <img src="/assets//images/logo/it_logo.png" alt="" srcset="">
                <img src="/assets//images/logo/cs_logo.png" alt="" srcset="">
                <img src="/assets//images/logo/lites_logo.png" alt="" srcset="">
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <ul class="navbar-nav d-flex justify-content-center gap-3 w-100 my-3 d-none d-md-flex sidebar">
                <li class="nav-item">
                    <a href="/home" class="nav-link <?= $active === 'home' ? 'active' : ''?>">Home</a>
                </li>
                <li class="nav-item">
                    <a href="/admission" class="nav-link <?= $active === 'admission' ? 'active' : ''?>">Admission</a>
                </li>
                <li class="nav-item">
                    <a href="/news" class="nav-link <?= $active === 'news' ? 'active' : ''?>">News</a>
                </li>
                <li class="nav-item">
                    <a href="/faculty" class="nav-link <?= $active === 'faculty' ? 'active' : ''?>">Faculty</a>
                </li>
                <li class="nav-item">
                    <a href="/officers" class="nav-link <?= $active === 'officers' ? 'active' : ''?>">Officers</a>
                </li>
                <li class="nav-item">
                    <a href="/research" class="nav-link <?= $active === 'research' ? 'active' : ''?>">Research</a>
                </li>
            </ul>
        </div>
    </nav>
</div>