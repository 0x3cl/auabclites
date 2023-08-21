<div class="dashboard-wrapper my-md-0">
    <?= $this->include('admin/templates/sidebar') ?>
    <div class="content">
        <?= $this->include('admin/templates/navbar') ?>
        <div class="inner-content mx-3 pb-5">
            <div class="container">
                <section class="mt-5">
                    <div class="mt-5">
                        <?php 
                            $flashdata = session()->getFlashData('flashdata');
                            readFlashData($flashdata);
                        ?>
                        <div class="actions mb-4 d-flex justify-content-end">
                            <a href="/admin/manage/users" class="btn btn-primary"><i class='bx bx-arrow-back' ></i> Go Back</a>
                        </div>
                        <div class="card mb-5">
                            <div class="card-header border-0 py-4">
                                <small>UPDATE USER'S IMAGE</small>
                            </div>
                            <div class="card-body">
                                <form action="/admin/manage/users/update/profile/image" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <input type="hidden" name="id" value="<?= $data["get_all_users"][0]->id ?>">
                                        <div class="col-12 col-md-12 mb-4">
                                            <div class="d-flex gap-3">
                                                <div class="user-content">
                                                    <div class="avatar-image">
                                                        <img src="/assets/admin/uploads/avatar/<?php echo $data["get_all_users"][0]->image_url?>" alt="" srcset="">
                                                    </div>
                                                </div>
                                                <div class="dropbox d-flex justify-content-center align-items-center">
                                                    <input type="file" name="avatar" id="avatar" class="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="action d-flex justify-content-end mt-3 w-100">
                                        <button class="btn btn-primary p-3"><i class='bx bxs-save' ></i> Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card mb-5">
                            <div class="card-header border-0 py-4">
                                <small>UPDATE USER'S INFORMATION</small>
                            </div>
                            <div class="card-body">
                                <form action="/admin/manage/users/update/profile" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <input type="hidden" name="id" value="<?= $data["get_all_users"][0]->id ?>">
                                        <div class="col-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <input type="text" name="username" id="username" class="form-control" autocomplete="disabled" value="<?= strtoupper($data["get_all_users"][0]->username) ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="form-group">
                                                <input type="text" name="firstname" id="firstname" class="form-control" autocomplete="disabled" value="<?= $data["get_all_users"][0]->fname ?>" required>
                                                <label for="firstname">First Name</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="form-group">
                                                <input type="text" name="lastname" id="lastname" class="form-control" autocomplete="disabled" value="<?= $data["get_all_users"][0]->lname ?>" required>
                                                <label for="lastname">Last Name</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <select name="position" id="position" class="form-control">
                                                    <option value="">Select Position</option>
                                                    <?php
                                                        foreach($data['get_positions'] as $value) {
                                                            echo '<option value="'.$value->id.'" '.($value->id === $data["get_all_users"][0]->position_id ? 'selected' : '') .'>'.ucwords($value->name).'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="action d-flex justify-content-end mt-3 w-100">
                                        <button class="btn btn-primary p-3"><i class='bx bxs-save' ></i> Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>