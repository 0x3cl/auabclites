<div class="dashboard-wrapper my-md-0">
    <?= $this->include('admin/templates/sidebar') ?>
    <div class="content">
        <?= $this->include('admin/templates/navbar') ?>
        <div class="inner-content mx-3 pb-5">
            <div class="container">
                <div class="d-block d-md-flex justify-content-between align-items-center mt-5">
                    <div class="greetings mb-3 mb-lg-0">
                        <h5>Welcome Back!</h5>
                        <h1 class="text-single"><?= strtoupper(session()->get('session_token')["fname"] . ' ' . session()->get('session_token')["lname"]) ?></h1>
                    </div>
                    <div class="shortcuts d-block d-lg-flex gap-2 ">
                        <button type="button" class="btn btn-primary btn-standard btn-icon" id="btn-toggle-theme"><i class='bx bx-moon'></i> Switch Dark </button>
                        <div class="my-2 my-md-2 my-lg-0"></div>
                        <button type="button" class="btn btn-outline-primary btn-standard btn-icon dropdown-toggle"><i class='bx bx-grid'></i> Shortcuts</button>
                    </div>
                </div>
                <hr>
                <section class="mt-5 overview">
                    <small>Overview</small>
                    <div class="row mt-4">
                        <div class="col-12 col-md-4 mb-3">
                            <div class="card orange">
                                <div class="card-header border-0 bg-transparent">
                                    Total Admins
                                </div>
                                <div class="card-body">
                                    <h1 class="m-0">0</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <div class="card green">
                                <div class="card-header border-0 bg-transparent">
                                    Total Visitors
                                </div>
                                <div class="card-body">
                                    <h1 class="m-0">0</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <div class="card blue">
                                <div class="card-header border-0 bg-transparent">
                                    Total News
                                </div>
                                <div class="card-body">
                                    <h1 class="m-0">0</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <div class="card violet">
                                <div class="card-header border-0 bg-transparent">
                                    Total Faculty
                                </div>
                                <div class="card-body">
                                    <h1 class="m-0">0</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <div class="card red">
                                <div class="card-header border-0 bg-transparent">
                                    Total Officers
                                </div>
                                <div class="card-body">
                                    <h1 class="m-0">0</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <div class="card dark-blue">
                                <div class="card-header border-0 bg-transparent">
                                    Total Research
                                </div>
                                <div class="card-body">
                                    <h1 class="m-0">0</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="other">
                    <section class="mt-4">
                        <small>Statistics</small>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header border-0">
                                        Site Visitors
                                    </div>
                                    <div class="card-body">
                                        <canvas id="site-visitor"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header border-0">
                                        Site Referrers 
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <canvas id="site-referrer-socmed"></canvas>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <canvas id="site-referrer-others"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="mt-4">
                        <small>Current Users</small>
                        <div class="row mt-4">
                            <div class="col-12 col-md-6">
                                <div class="card w-100">
                                    <div class="card-header border-0">
                                        Active Users
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="user-profile">
                                            <div class="user-profile-content">
                                                <div>
                                                    <img src="/assets/admin/uploads/avatar/female-default.jpg" alt="profile">
                                                </div>
                                                <div>
                                                    <h6 class="text-single">Lanz Rayos</h6>
                                                    <p>Administrator <i class='bx bxs-badge-check'></i></p>
                                                </div>
                                            </div>
                                            <div class="user-profile-content">
                                                <div>
                                                    <img src="/assets/admin/uploads/avatar/female-default.jpg" alt="profile">
                                                </div>
                                                <div>
                                                    <h6 class="text-single">Jaelle Culiat</h6>
                                                    <p>Administrator <i class='bx bxs-badge-check'></i></p>
                                                </div>
                                            </div>
                                            <div class="user-profile-content">
                                                <div>
                                                    <img src="/assets/admin/uploads/avatar/female-default.jpg" alt="profile">
                                                </div>
                                                <div>
                                                    <h6 class="text-single">Paulene Reposo</h6>
                                                    <p>Administrator <i class='bx bxs-badge-check'></i></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>