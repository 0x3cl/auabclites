<div class="sidebar">
    <div class="sidebar-header my-3">
        <div class="logo">
            <img src="/assets/admin/images/logo-dark.png" alt="logo">
            <h4>Admin Panel</h4>
        </div>
    </div>
    <hr class="mx-3">
    <div class="mx-3">
        <small class="fw-bold">Menu</small>
    </div>
    <div class="menu-content">
        <div class="menu-content-inner mb-5">
            <ul class="list-unstyled mt-4">
                <li class="list-unstyled-item <?= $active === 'dashboard' ? 'active' : '' ?>">
                    <a href="/admin/dashboard" class="text-link">
                        <div class="icon">
                            <i class='bx bxs-dashboard'></i>
                            <span>Dashboard</span>
                        </div>
                    </a>
                </li>
                <li class="list-unstyled-item  <?= $active === 'widgets' ? 'active' : '' ?>">
                    <a href="/admin/widgets" class="text-link">
                        <div class="icon">
                            <i class='bx bxs-widget'></i>
                            <span>Widgets</span>
                        </div>
                    </a>
                </li>
                <li class="list-unstyled-item  <?= $active === 'messages' ? 'active' : '' ?>">
                    <a href="/admin/messages" class="text-link">
                        <div class="icon">
                            <i class='bx bxs-message-detail'></i>
                            <span>Messages</span>
                        </div>
                    </a>
                </li>
                <li class="list-unstyled-item  <?= $active === 'accounts' ? 'active' : '' ?>">
                    <a href="javascript:void(0)" class="text-link">
                        <div class="icon" data-bs-toggle="collapse" data-bs-target="#accounts-collapse">
                            <i class='bx bxs-group'></i>
                            <span>Accounts <i class='bx bxs-down-arrow'></i></span>
                        </div>
                    </a>
                    <div class="collapse multi-collapse sub-menu" id="accounts-collapse">
                        <ul class="list-unstyled">
                            <li class="list-unstyled-item">
                                <a href="/admin/manage/users" class="text-link"><i class='bx bx-user-check'></i> Admins</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="list-unstyled-item  <?= $active === 'pages' ? 'active' : '' ?>">
                    <a href="javascript:void(0)" class="text-link">
                        <div class="icon" data-bs-toggle="collapse" data-bs-target="#pages-collapse">
                            <i class='bx bxs-file-blank' ></i>
                            <span>Pages <i class='bx bxs-down-arrow'></i></span>
                        </div>
                    </a>
                    <div class="collapse multi-collapse sub-menu" id="pages-collapse">
                        <ul class="list-unstyled">
                            <li class="list-unstyled-item">
                                <a href="/admin/manage/page/home" class="text-link"><i class='bx bx-home-alt' ></i> Manage Home</a>
                            </li>
                            <li class="list-unstyled-item">
                                <a href="/admin/manage/page/admission" class="text-link"><i class='bx bx-notepad' ></i> Manage Admission</a>
                            </li>
                            <li class="list-unstyled-item">
                                <a href="/admin/manage/page/bulletin" class="text-link"><i class='bx bx-news'></i> Manage Bulletin</a>
                            </li>
                            <li class="list-unstyled-item">
                                <a href="/admin/manage/page/faculty" class="text-link"><i class='bx bx-group'></i> Manage Faculty</a>
                            </li>
                            <li class="list-unstyled-item">
                                <a href="/admin/manage/page/officers" class="text-link"><i class='bx bx-user-pin'></i> Manage Officers</a>
                            </li>
                            <li class="list-unstyled-item">
                                <a href="/admin/manage/page/research" class="text-link"><i class='bx bx-briefcase'></i> Manage Research</a>
                            </li>
                            <li class="list-unstyled-item">
                                <a href="/admin/manage/page/testimonials" class="text-link"><i class='bx bx-user-voice'></i> Manage Testimonials</a>
                            </li>
                            <li class="list-unstyled-item">
                                <a href="/admin/manage/page/contacts" class="text-link"><i class='bx bx-map-pin' ></i> Manage Contacts</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="list-unstyled-item  <?= $active === 'reports' ? 'active' : '' ?>">
                    <a href="javascript:void(0)" class="text-link">
                        <div class="icon" data-bs-toggle="collapse" data-bs-target="#report-collapse">
                            <i class='bx bxs-report'></i>
                            <span>Reports <i class='bx bxs-down-arrow'></i></span>
                        </div>
                    </a>
                    <div class="collapse multi-collapse sub-menu" id="report-collapse">
                        <ul class="list-unstyled">
                            <li class="list-unstyled-item">
                                <a href="#" class="text-link"><i class='bx bxs-group'></i> Users Report</a>
                            </li>
                            <li class="list-unstyled-item">
                                <a href="#" class="text-link"><i class='bx bx-show'></i> Visitor Report</a>
                            </li>
                            <li class="list-unstyled-item">
                                <a href="#" class="text-link"><i class='bx bx-briefcase'></i> Project Report</a>
                            </li>
                            <li class="list-unstyled-item">
                                <a href="#" class="text-link"><i class='bx bx-user-voice' ></i>Testimonial Report</a>
                            </li>
                            <li class="list-unstyled-item">
                                <a href="#" class="text-link"><i class='bx bxs-traffic'></i> Site Traffic Report</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="list-unstyled-item  <?= $active === 'logs' ? 'active' : '' ?>">
                    <a href="/admin/logs" class="text-link">
                        <div class="icon">
                            <i class='bx bxs-file'></i>
                            <span>Logs</span>
                        </div>
                    </a>
                </li>
                <li class="list-unstyled-item  <?= $active === 'settings' ? 'active' : '' ?>">
                    <a href="javascript:void(0)" class="text-link">
                        <div class="icon" data-bs-toggle="collapse" data-bs-target="#settings-collapse">
                            <i class='bx bxs-cog' ></i>
                            <span>Settings <i class='bx bxs-down-arrow'></i></span>
                        </div>
                    </a>
                    <div class="collapse multi-collapse sub-menu" id="settings-collapse">
                        <ul class="list-unstyled">
                            <li class="list-unstyled-item">
                                <a href="#" class="text-link"><i class='bx bxs-user-badge'></i> Profile</a>
                            </li>
                            <li class="list-unstyled-item">
                                <a href="#" class="text-link"><i class='bx bxs-key' ></i> Change Password</a>
                            </li>
                            <li class="list-unstyled-item">
                                <a href="#" class="text-link"><i class='bx bxs-exit bx-rotate-180' ></i> Sign out</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>