<?php

$Id = Session::get('id');

$user = new Users();

$userInfo = $user->getUsers($Id);


?>


<div class="container">
    <div class="row">
        <div class="loginPage col-md-5 col-md-offset-4">

            <div class="panel panel-primary">
                <div class="panel-heading">User Profile</div>
                <div class="panel-body">
                    <div class="col-md-4">
                        <img src="<?= HTTP . 'Public/userImage/' . $userInfo->upload ?>" class="img-responsive" alt="">

                    </div>
                    <div class="col-md-6">
                        <table class="table">
                            <tr>
                                <td>Name</td>
                                <td><?= $userInfo->uname ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><?= $userInfo->email ?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    <?php
                                    if ($userInfo->status == 0): ?>
                                        <button class="btn btn-default btn-sm"> Disable</button>
                                        <?php else:?>

                                        <button class="btn btn-primary btn-sm" >Enable</button>
                                    <?php endif; ?>

                                </td>
                            </tr>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>