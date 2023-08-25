<div class="dashboard-wrapper my-md-0">
    <?= $this->include('admin/templates/sidebar') ?>
    <div class="content">
        <?= $this->include('admin/templates/navbar') ?>
        <div class=" mx-3 pb-5">
            <div class="container">
                <section class="mt-5 overview">
                    <?php 
                        $flashdata = session()->getFlashData('flashdata');
                        readFlashData($flashdata);
                    ?>
                    <div class="mb-4">
                        <div class="card">
                            <div class="card-header border-0 pt-4 bg-transparent">
                                <small class="tle">MANAGE BANNERS</small>
                            </div>
                            <div class="card-body">
                            <form action="/admin/manage/page/home/banner/update" method="post" enctype="multipart/form-data">
                                <div class="user-content mt-4 mb-3">
                                    <div class="avatar-image w-100">
                                        <img src="/assets/home/images/banner/<?= $data['get_home_images'][0]->image ?>" alt="" srcset="" class="w-100">
                                    </div>
                                </div>
                                <div class="dropbox d-flex justify-content-center align-items-center">
                                    <input type="hidden" name="id" value="<?= $data['get_home_images'][0]->id ?>">
                                    <input type="hidden" name="target" value="banner">
                                    <input type="file" name="image" id="banner" class="">
                                </div>
                                <div class="action d-flex justify-content-end mt-5 w-100">
                                    <button class="btn btn-primary p-3"><i class='bx bxs-save' ></i> Save Changes</button>
                                </div>
                            </form>
                            <form action="/admin/manage/page/home/banner/update" method="post" enctype="multipart/form-data">
                                <div class="user-content mt-4 mb-3">
                                    <div class="avatar-image w-100">
                                        <img src="/assets/home/images/banner/<?= $data['get_home_images'][1]->image ?>" alt="" srcset="" class="w-100">
                                    </div>
                                </div>
                                <div class="dropbox d-flex justify-content-center align-items-center">
                                    <input type="hidden" name="id" value="<?= $data['get_home_images'][1]->id ?>">
                                    <input type="hidden" name="target" value="banner">
                                    <input type="file" name="image" id="banner" class="">
                                </div>
                                <div class="action d-flex justify-content-end mt-5 w-100">
                                    <button class="btn btn-primary p-3"><i class='bx bxs-save' ></i> Save Changes</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    <hr class="my-5">
                        <div class="card mt-4">
                            <div class="card-header border-0 pt-4 bg-transparent">
                                <small class="tle">MANAGE LOGOS</small>
                            </div>
                            <div class="card-body">
                                <form action="/admin/manage/page/bulletin/update/banner/" method="post" enctype="multipart/form-data" id="form-banner">
                                    <table class="table nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Logo</th>
                                                <th>Title</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $logo_data = array_splice($data['get_home_images'], 2);
                                                if(!empty($logo_data)) {
                                                    foreach($logo_data as $value) {
                                                        echo '
                                                        <tr>
                                                            <td>#'.$value->id.'</td>
                                                            <td>
                                                                <img src="/assets/home/images/logo/'.$value->image.'">
                                                            </td>
                                                            <td>'.$value->field.'</td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <a href="/admin/manage/page/home/logo/update/'.$value->id.'" class="btn btn-success mx-1"><i class="bx bxs-edit" ></i> Update</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        ';
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    <hr class="my-5">
                    <div class="card">
                        <div class="card-header border-0 py-3">
                            <small class="tle">MANAGE CAROUSEL IMAGE</small>
                        </div>
                        <div class="card-body">
                            <form action="/admin/manage/page/home/carousel" method="post" enctype="multipart/form-data">
                                <div class="d-flex gap-3 mt-3">
                                    <div class="dropbox d-flex justify-content-center align-items-center">
                                        <input type="file" name="images[]" id="content-image" class="" multiple>
                                    </div>
                                </div>
                                <div class="action d-flex justify-content-end mt-5 mb-5 w-100">
                                    <button class="btn btn-primary p-3"><i class='bx bxs-save' ></i> Save Changes</button>
                                </div>
                            </form>
                            <form action="/admin/manage/page/home/carousel/delete" method="post">
                                <table class="table w-100">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if(!empty($data)) {
                                                foreach($data['get_carousel_images'] as $value) {
                                                    echo ' 
                                                    <tr>
                                                        <td>#'.$value->id.'</td>
                                                        <td>
                                                            <img src="/assets/home/images/carousel/'.$value->image.'">
                                                        </td>
                                                        <td>
                                                           <div class="d-flex">
                                                                <button class="btn btn-danger mx-1" name="id" value="'.$value->id.'"><i class="bx bxs-trash bx-tada" ></i> Delete</button>
                                                           </div>
                                                        </td>
                                                    </tr>
                                                    ';
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>