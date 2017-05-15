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

                                                    <!--relay-->
                                                    <?php foreach ($parameter21 as $p1): ?>
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
                                                    <!--relay-->





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