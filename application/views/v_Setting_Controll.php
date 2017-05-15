<?php $this->load->view('template/v_Head') ?>
<style>
    #table > tbody > tr > td, #table > tbody > tr > th, #table > tfoot > tr > td, #table > tfoot > tr > th, #table > thead > tr > td, #table > thead > tr > th {
        padding: 3px;
        font-size: 13px;
    }
</style>

<body class="framed main-scrollable">

<div class="wrapper">

    <?php $this->load->view('template/v_NavBar'); ?>

    <div class="dashboard">

        <!--ASIDE-->
        <div class="sidebar">
            <!--Sidebar Menu-->
            <?php $this->load->view('template/v_SidebarMenu') ?>
            <!--Sidebar Menu-->
        </div>
        <!--ASIDE-->

        <!--MAIN CONTENT-->
        <div class="main">
            <div class="main__scroll scrollbar-macosx">
                <div class="main__cont">

                    <div class="container-fluid half-padding">
                        <div class="pages pages_dashboard">
                            <div class="row">

                                <!--Content Page-->
                                <div class="col-md-12">
                                    <div class="panel panel-danger">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">controlls</h3></div>
                                        <div class="panel-body">
                                            <div class="col-sm-6">
                                                <table id="table" class="table table_sortable {sortlist: [[0,0]]} " cellspacing="0" width="100%">

                                                    <tbody>


                                                    <?php foreach ($parameter1 as $p1): ?>
                                                        <form action="<?php echo site_url('settings/save_controll'); ?>" method="post" id="myform">

                                                            <tr>
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3"><input type="text" class="form-control" id="value"
                                                                                            name="<?php echo 'id[' . $p1->id . '][value]'; ?>" value="<?php echo $p1->value; ?>">
                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('settings/read_controll'); ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                        </form>

                                                    <?php endforeach; ?>

                                                    <?php foreach ($parameter2 as $p1): ?>
                                                        <form action="<?php echo site_url('settings/save_controll'); ?>" method="post" id="myform">

                                                            <tr class="h6">
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3">
                                                                    <select name="<?php echo 'id[' . $p1->id . '][value]'; ?>" id="inputID" class="form-control">
                                                                        <?php if ($p1->value == 0) {
                                                                            echo '<option value="0">Disable</option><option value="1">Enable</option>';
                                                                        } else {
                                                                            echo '<option value="1">Enable</option><option value="0">Disable</option>';

                                                                        } ?>
                                                                    </select>

                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('settings/read_controll'); ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>


                                                    <?php endforeach; ?>
                                                    <?php foreach ($parameter3 as $p1): ?>
                                                        <form action="<?php echo site_url('settings/save_controll'); ?>" method="post" id="myform">

                                                            <tr>
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3"><input type="text" class="form-control" id="value"
                                                                                            name="<?php echo 'id[' . $p1->id . '][value]'; ?>" value="<?php echo $p1->value; ?>">
                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('settings/read_controll'); ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                        </form>

                                                    <?php endforeach; ?>
                                                    <?php foreach ($parameter4 as $p1): ?>
                                                        <form action="<?php echo site_url('settings/save_controll'); ?>" method="post" id="myform">

                                                            <tr class="h6">
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3">
                                                                    <select name="<?php echo 'id[' . $p1->id . '][value]'; ?>" id="inputID" class="form-control">
                                                                        <?php if ($p1->value == 0) {
                                                                            echo '<option value="0">Disable</option><option value="1">Enable</option>';
                                                                        } else {
                                                                            echo '<option value="1">Enable</option><option value="0">Disable</option>';

                                                                        } ?>
                                                                    </select>

                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('settings/read_controll'); ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>


                                                    <?php endforeach; ?>
                                                    <?php foreach ($parameter5 as $p1): ?>
                                                        <form action="<?php echo site_url('settings/save_controll'); ?>" method="post" id="myform">

                                                            <tr>
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3"><input type="text" class="form-control" id="value"
                                                                                            name="<?php echo 'id[' . $p1->id . '][value]'; ?>" value="<?php echo $p1->value; ?>">
                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('settings/read_controll'); ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>

                                                    <?php endforeach; ?>
                                                    <?php foreach ($parameter14 as $p1): ?>
                                                        <form action="<?php echo site_url('settings/save_controll'); ?>" method="post" id="myform">

                                                            <tr>
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3">
                                                                    <?php echo $p1->updated_at; ?>
                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('settings/read_controll'); ?>" class="btn btn-success btn-xs ">READ</a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>

                                                    <?php endforeach; ?>
                                                    <?php foreach ($parameter15 as $p1): ?>
                                                        <form action="<?php echo site_url('settings/save_controll'); ?>" method="post" id="myform">

                                                            <tr>
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3"><input type="text" class="form-control" id="value"
                                                                                            name="<?php echo 'id[' . $p1->id . '][value]'; ?>" value="<?php echo $p1->value; ?>">
                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('settings/read_controll'); ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>

                                                    <?php endforeach; ?>
                                                    <?php foreach ($parameter6 as $p1): ?>
                                                        <form action="<?php echo site_url('settings/save_controll'); ?>" method="post" id="myform">

                                                            <tr class="h6">
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3">
                                                                    <select name="<?php echo 'id[' . $p1->id . '][value]'; ?>" id="inputID" class="form-control">
                                                                        <?php if ($p1->value == 0) {
                                                                            echo '<option value="0">Disable</option><option value="1">Enable</option>';
                                                                        } else {
                                                                            echo '<option value="1">Enable</option><option value="0">Disable</option>';

                                                                        } ?>
                                                                    </select>

                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('settings/read_controll'); ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>


                                                    <?php endforeach; ?>

                                                    <?php foreach ($parameter7 as $p1): ?>
                                                        <form action="<?php echo site_url('settings/save_controll'); ?>" method="post" id="myform">

                                                            <tr>
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3"><input type="text" class="form-control" id="value"
                                                                                            name="<?php echo 'id[' . $p1->id . '][value]'; ?>" value="<?php echo $p1->value; ?>">
                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('settings/read_controll'); ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                        </form>

                                                    <?php endforeach; ?>

                                                    <?php foreach ($parameter8 as $p1): ?>
                                                        <form action="<?php echo site_url('settings/save_controll'); ?>" method="post" id="myform">

                                                            <tr class="h6">
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3">
                                                                    <select name="<?php echo 'id[' . $p1->id . '][value]'; ?>" id="inputID" class="form-control">
                                                                        <?php if ($p1->value == 0) {
                                                                            echo '<option value="0">Disable</option><option value="1">Enable</option>';
                                                                        } else {
                                                                            echo '<option value="1">Enable</option><option value="0">Disable</option>';

                                                                        } ?>
                                                                    </select>

                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('settings/read_controll'); ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>


                                                    <?php endforeach; ?>

                                                    <?php foreach ($parameter9 as $p1): ?>
                                                        <form action="<?php echo site_url('settings/save_controll'); ?>" method="post" id="myform">

                                                            <tr>
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3"><input type="text" class="form-control" id="value"
                                                                                            name="<?php echo 'id[' . $p1->id . '][value]'; ?>" value="<?php echo $p1->value; ?>">
                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('settings/read_controll'); ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>

                                                    <?php endforeach; ?>


                                                    </tbody>
                                                </table>


                                            </div>
                                            <div class="col-sm-6">

                                                <table id="table" class="table table_sortable {sortlist: [[0,0]]} " cellspacing="0" width="100%">

                                                    <tbody>


                                                    <?php foreach ($parameter10 as $p1): ?>
                                                        <form action="<?php echo site_url('settings/save_controll'); ?>" method="post" id="myform">

                                                            <tr>
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3"><input type="text" class="form-control" id="value"
                                                                                            name="<?php echo 'id[' . $p1->id . '][value]'; ?>" value="<?php echo $p1->value; ?>">
                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('settings/read_controll'); ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>

                                                    <?php endforeach; ?>
                                                    <?php foreach ($parameter11 as $p1): ?>
                                                        <form action="<?php echo site_url('settings/save_controll'); ?>" method="post" id="myform">

                                                            <tr class="h6">
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3">
                                                                    <select name="<?php echo 'id[' . $p1->id . '][value]'; ?>" id="inputID" class="form-control">
                                                                        <?php if ($p1->value == 0) {
                                                                            echo '<option value="0">Disable</option><option value="1">Enable</option>';
                                                                        } else {
                                                                            echo '<option value="1">Enable</option><option value="0">Disable</option>';

                                                                        } ?>
                                                                    </select>

                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('settings/read_controll'); ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>


                                                    <?php endforeach; ?>
                                                    <?php foreach ($parameter12 as $p1): ?>
                                                        <form action="<?php echo site_url('settings/save_controll'); ?>" method="post" id="myform">

                                                            <tr>
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3"><input type="text" class="form-control" id="value"
                                                                                            name="<?php echo 'id[' . $p1->id . '][value]'; ?>" value="<?php echo $p1->value; ?>">
                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('settings/read_controll'); ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>

                                                    <?php endforeach; ?>

                                                    <?php foreach ($parameter13 as $p1): ?>
                                                        <form action="<?php echo site_url('settings/save_controll'); ?>" method="post" id="myform">

                                                            <tr class="h6">
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3"><?php echo $p1->relay; ?>
                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?>
                                                                </td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('settings/read_controll'); ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs btn-disable hide">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>

                                                    <?php endforeach; ?>


                                                    </tbody>
                                                </table>


                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--Content Page-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--MAIN CONTENT-->

    </div>
</div>


<?php $this->load->view('template/v_Foot') ?>
