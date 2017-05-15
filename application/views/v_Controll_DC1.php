<?php $this->load->view('template/v_Head') ?>
    <style>
        #table > tbody > tr > td, #table > tbody > tr > th, #table > tfoot > tr > td, #table > tfoot > tr > th, #table > thead > tr > td, #table > thead > tr > th {
            padding: 3px;
            font-size: 13px;
        }
    </style>

    <body class="framed main-scrollable">

<div class="wrapper">

    <!--Navbar-->
    <?php $this->load->view('template/v_NavBar'); ?>
    <!--Navbar-->

    <div class="dashboard">

        <!--ASIDE-->
        <div class="sidebar">
            <!--Sidebar Menu-->
            <?php $this->load->view('template/v_SidebarMenu') ?>
            <!--Sidebar Menu-->
        </div>
        <!--ASIDE-->

        <!--Page-->
        <div class="main">
            <div class="main__scroll scrollbar-macosx">
                <div class="main__cont">
                    <div class="container-fluid half-padding">
                        <div class="template template__controls">
                            <div class="row">

                                <!--Content Page-->
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <?php $this->load->view('template/v_Menu_Controll'); ?>
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-sm-6">
                                                <table id="table" class="table table_sortable {sortlist: [[0,0]]} " cellspacing="0" width="100%">

                                                    <tbody>

                                                    <!--temp compensation enable-->
                                                    <?php foreach ($parameter2 as $p1): ?>
                                                        <form action="<?php echo site_url('controll/save_controll'); ?>" method="post" id="myform">
                                                            <input type="text" class="hide" value="<?php echo $this->uri->segment(2); ?>" name="uri">

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
                                                                        <a href="<?php echo site_url('controll/read').'/'.$this->uri->segment(2).'/'.$p1->id ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>


                                                    <?php endforeach; ?>
                                                    <!--temp compensation enable-->

                                                    <!--temp compensation coefisien-->
                                                    <?php foreach ($parameter3 as $p1): ?>
                                                        <form action="<?php echo site_url('controll/save_controll'); ?>" method="post" id="myform">
                                                            <input type="text" class="hide" value="<?php echo $this->uri->segment(2); ?>" name="uri">

                                                            <tr>
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3"><input type="text" class="form-control" id="value"
                                                                                            name="<?php echo 'id[' . $p1->id . '][value]'; ?>" value="<?php echo $p1->value; ?>">
                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('controll/read').'/'.$this->uri->segment(2).'/'.$p1->id ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                        </form>

                                                    <?php endforeach; ?>
                                                    <!--temp compensation coefisien-->

                                                    <!--periodic equal charge-->
                                                    <?php foreach ($parameter4 as $p1): ?>
                                                        <form action="<?php echo site_url('controll/save_controll'); ?>" method="post" id="myform">
                                                            <input type="text" class="hide" value="<?php echo $this->uri->segment(2); ?>" name="uri">

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
                                                                        <a href="<?php echo site_url('controll/read').'/'.$this->uri->segment(2).'/'.$p1->id ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>


                                                    <?php endforeach; ?>
                                                    <!--periodic equal charge-->

                                                    <!--periodical equal charge interval-->
                                                    <?php foreach ($parameter5 as $p1): ?>
                                                        <form action="<?php echo site_url('controll/save_controll'); ?>" method="post" id="myform">
                                                            <input type="text" class="hide" value="<?php echo $this->uri->segment(2); ?>" name="uri">

                                                            <tr>
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3"><input type="text" class="form-control" id="value"
                                                                                            name="<?php echo 'id[' . $p1->id . '][value]'; ?>" value="<?php echo $p1->value; ?>">
                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('controll/read').'/'.$this->uri->segment(2).'/'.$p1->id ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>

                                                    <?php endforeach; ?>
                                                    <!--periodical equal charge interval-->

                                                    <!--lvd1-->
                                                    <?php foreach ($parameter10 as $p1): ?>
                                                        <form action="<?php echo site_url('controll/save_controll_100'); ?>" method="post" id="myform">
                                                            <input type="text" class="hide" value="<?php echo $this->uri->segment(2); ?>" name="uri">

                                                            <tr>
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3"><input type="text" class="form-control" id="value"
                                                                                            name="<?php echo 'id[' . $p1->id . '][value]'; ?>" value="<?php echo $p1->value; ?>">
                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('controll/read').'/'.$this->uri->segment(2).'/'.$p1->id ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>

                                                    <?php endforeach; ?>
                                                    <!--lvd1-->

                                                    <!--hibernation-->
                                                    <?php foreach ($parameter11 as $p1): ?>
                                                        <form action="<?php echo site_url('controll/save_controll_hibernation'); ?>" method="post" id="myform">
                                                            <input type="text" class="hide" value="<?php echo $this->uri->segment(2); ?>" name="uri">

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
                                                                        <a href="<?php echo site_url('controll/read').'/'.$this->uri->segment(2).'/'.$p1->id ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>


                                                    <?php endforeach; ?>
                                                    <!--hibernation-->

                                                    <!--hibernation interval-->
                                                    <?php foreach ($parameter12 as $p1): ?>
                                                        <form action="<?php echo site_url('controll/save_controll_interval_hibernation'); ?>" method="post" id="myform">
                                                            <input type="text" class="hide" value="<?php echo $this->uri->segment(2); ?>" name="uri">

                                                            <tr>
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3"><input type="text" class="form-control" id="value"
                                                                                            name="<?php echo 'id[' . $p1->id . '][value]'; ?>" value="<?php echo $p1->value; ?>">
                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('controll/read').'/'.$this->uri->segment(2).'/'.$p1->id ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>

                                                    <?php endforeach; ?>
                                                    <!--hibernation interval-->
                                                    <?php foreach ($parameter12a as $p1): ?>
                                                        <form action="<?php echo site_url('controll/save_controll'); ?>" method="post" id="myform">
                                                            <input type="text" class="hide" value="<?php echo $this->uri->segment(2); ?>" name="uri">

                                                            <tr>
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3"><input type="text" class="form-control" id="value"
                                                                                            name="<?php echo 'id[' . $p1->id . '][value]'; ?>" value="<?php echo $p1->value; ?>">
                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('controll/read').'/'.$this->uri->segment(2).'/'.$p1->id ?>" class="btn btn-success btn-xs ">READ</a>

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

                                                    <!--batttery test enable-->
                                                    <?php foreach ($parameter6 as $p1): ?>
                                                        <form action="<?php echo site_url('controll/save_controll'); ?>" method="post" id="myform">
                                                            <input type="text" class="hide" value="<?php echo $this->uri->segment(2); ?>" name="uri">

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
                                                                        <a href="<?php echo site_url('controll/read').'/'.$this->uri->segment(2).'/'.$p1->id ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>


                                                    <?php endforeach; ?>
                                                    <!--batttery test enable-->

                                                    <!--auto battery test-->
                                                    <?php foreach ($parameter8 as $p1): ?>
                                                        <form action="<?php echo site_url('controll/save_controll_battery_test'); ?>" method="post" id="myform">
                                                            <input type="text" class="hide" value="<?php echo $this->uri->segment(2); ?>" name="uri">

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
                                                                        <a href="<?php echo site_url('controll/read').'/'.$this->uri->segment(2).'/'.$p1->id ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>


                                                    <?php endforeach; ?>
                                                    <!--auto battery test-->

                                                    <!--start battery test-->
                                                    <?php foreach ($parameter14 as $p1): ?>
                                                        <form action="<?php echo site_url('controll/save_controll'); ?>" method="post" id="myform">
                                                            <input type="text" class="hide" value="<?php echo $this->uri->segment(2); ?>" name="uri">

                                                            <tr>
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3">
                                                                    <?php echo $p1->updated_at; ?>
                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('controll/read').'/'.$this->uri->segment(2).'/'.$p1->id ?>" class="btn btn-success btn-xs ">READ</a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>

                                                    <?php endforeach; ?>
                                                    <!--start battery test-->

                                                    <!--battery test start voltage-->
                                                    <?php foreach ($parameter7 as $p1): ?>
                                                        <form action="<?php echo site_url('controll/save_controll_100'); ?>" method="post" id="myform">
                                                            <input type="text" class="hide" value="<?php echo $this->uri->segment(2); ?>" name="uri">

                                                            <tr>
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3"><input type="text" class="form-control" id="value"
                                                                                            name="<?php echo 'id[' . $p1->id . '][value]'; ?>" value="<?php echo $p1->value; ?>">
                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('controll/read').'/'.$this->uri->segment(2).'/'.$p1->id ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                        </form>

                                                    <?php endforeach; ?>
                                                    <!--battery test start voltage-->

                                                    <!--battery test Terminal voltage-->
                                                    <?php foreach ($parameter15 as $p1): ?>
                                                        <form action="<?php echo site_url('controll/save_controll'); ?>" method="post" id="myform">
                                                            <input type="text" class="hide" value="<?php echo $this->uri->segment(2); ?>" name="uri">

                                                            <tr>
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3"><input type="text" class="form-control" id="value"
                                                                                            name="<?php echo 'id[' . $p1->id . '][value]'; ?>" value="<?php echo $p1->value; ?>">
                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('controll/read').'/'.$this->uri->segment(2).'/'.$p1->id ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>

                                                    <?php endforeach; ?>
                                                    <?php foreach ($parameter15a as $p1): ?>
                                                        <form action="<?php echo site_url('controll/save_controll_100'); ?>" method="post" id="myform">
                                                            <input type="text" class="hide" value="<?php echo $this->uri->segment(2); ?>" name="uri">

                                                            <tr>
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3"><input type="text" class="form-control" id="value"
                                                                                            name="<?php echo 'id[' . $p1->id . '][value]'; ?>" value="<?php echo $p1->value; ?>">
                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('controll/read').'/'.$this->uri->segment(2).'/'.$p1->id ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>

                                                    <?php endforeach; ?>
                                                    <!--battery test Terminal voltage-->


                                                    <!--battery test interval-->
                                                    <?php foreach ($parameter9c as $p1): ?>
                                                        <form action="<?php echo site_url('controll/save_controll_battery_test_interval'); ?>" method="post" id="myform">
                                                            <input type="text" class="hide" value="<?php echo $this->uri->segment(2); ?>" name="uri">

                                                            <tr>
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3"><input type="text" class="form-control" id="value"
                                                                                            name="<?php echo 'id[' . $p1->id . '][value]'; ?>" value="<?php echo $p1->value; ?>">
                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('controll/read').'/'.$this->uri->segment(2).'/'.$p1->id ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>

                                                    <?php endforeach; ?>
                                                    <?php foreach ($parameter9 as $p1): ?>
                                                        <form action="<?php echo site_url('controll/save_controll'); ?>" method="post" id="myform">
                                                            <input type="text" class="hide" value="<?php echo $this->uri->segment(2); ?>" name="uri">

                                                            <tr>
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3"><input type="text" class="form-control" id="value"
                                                                                            name="<?php echo 'id[' . $p1->id . '][value]'; ?>" value="<?php echo $p1->value; ?>">
                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('controll/read').'/'.$this->uri->segment(2).'/'.$p1->id ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>

                                                    <?php endforeach; ?>
                                                    <?php foreach ($parameter9a as $p1): ?>
                                                        <form action="<?php echo site_url('controll/save_controll_10'); ?>" method="post" id="myform">
                                                            <input type="text" class="hide" value="<?php echo $this->uri->segment(2); ?>" name="uri">

                                                            <tr>
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3"><input type="text" class="form-control" id="value"
                                                                                            name="<?php echo 'id[' . $p1->id . '][value]'; ?>" value="<?php echo $p1->value; ?>">
                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('controll/read').'/'.$this->uri->segment(2).'/'.$p1->id ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>

                                                    <?php endforeach; ?>
                                                    <?php foreach ($parameter9b as $p1): ?>
                                                        <form action="<?php echo site_url('controll/save_controll_100'); ?>" method="post" id="myform">
                                                            <input type="text" class="hide" value="<?php echo $this->uri->segment(2); ?>" name="uri">

                                                            <tr>
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3"><input type="text" class="form-control" id="value"
                                                                                            name="<?php echo 'id[' . $p1->id . '][value]'; ?>" value="<?php echo $p1->value; ?>">
                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('controll/read').'/'.$this->uri->segment(2).'/'.$p1->id ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>

                                                    <?php endforeach; ?>
                                                    <!--battery test interval-->

                                                    <!--float charge voltage-->
                                                    <?php foreach ($parameter1 as $p1): ?>
                                                        <form action="<?php echo site_url('controll/save_controll_100'); ?>" method="post" id="myform">
                                                            <input type="text" class="hide" value="<?php echo $this->uri->segment(2); ?>" name="uri">

                                                            <tr>
                                                                <td class=""><?php echo $p1->name; ?> </td>
                                                                <td class="col-sm-3"><input type="text" class="form-control" id="value"
                                                                                            name="<?php echo 'id[' . $p1->id . '][value]'; ?>" value="<?php echo $p1->value; ?>">
                                                                </td>
                                                                <td class="col-sm-1"><?php echo $p1->unit ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo site_url('controll/read').'/'.$this->uri->segment(2).'/'.$p1->id ?>" class="btn btn-success btn-xs ">READ</a>

                                                                        <button type="submit" class="btn btn-info btn-xs ">WRITE</button>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                        </form>

                                                    <?php endforeach; ?>
                                                    <!--float charge voltage-->


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
        <!--Page-->

    </div>
</div>

<?php $this->load->view('template/v_Foot') ?>