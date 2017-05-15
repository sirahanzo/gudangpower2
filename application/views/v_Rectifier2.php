<?php $this->load->view('template/v_Head') ?>
<style>
    #table > tbody > tr > td, #table > tbody > tr > th, #table > tfoot > tr > td, #table > tfoot > tr > th, #table > thead > tr > td, #table > thead > tr > th {
        padding: 3px;
        font-size: 13px;
        padding-bottom: 5px;

    }

    tr > th {
        height: 40px;
        vertical-align: top;
        font-size: 18px;
        padding: 3px;
        padding-bottom: 10px;

    }

    td {
        height: 10px;
        /*padding: 3px;*/
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
                            <div class="row " id="monitoring">

                                <!--Content Page-->
                                <section>
                                    <div class="col-md-12">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">All Rectifier</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="scroll-wrapper scrollable scrollbar-macosx" style="position: relative;">
                                                    <div class="scrollable scrollbar-macosx scroll-content"
                                                         style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 450px;">
                                                        <table id="table" class="table table_sortable {sortlist: [[0,0]]}" cellspacing="0" width="100%">
                                                            <thead class="">
                                                            <tr class="text-center">
                                                                <th class="">Name</th>
                                                                <th class="text-center">Voltage</th>
                                                                <th class="text-center">Current A</th>
                                                                <th class="text-center">Current B</th>
                                                                <th class="text-center">Current C</th>
                                                                <th class="text-center">Temp</th>
                                                                <th class="text-center">Comm.Lost</th>
                                                                <th class="text-center">Protect</th>
                                                                <th class="text-center">AC Fail</th>
                                                                <th class="text-center">Module Fail</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php for ($y = 0, $x = 1; $x <= 16; [$x++, $y++]) { ?>
                                                                <tr>
                                                                    <td> Rectifer <?php echo $x ?></td>
                                                                    <td class="text-center"><?php echo round($rect_voltage[$y], 2); ?> V</td>
                                                                    <td class="text-center"><?php echo round($rect_current[$y][0], 2); ?> A</td>
                                                                    <td class="text-center"><?php echo round($rect_current[$y][1], 2); ?> A</td>
                                                                    <td class="text-center"><?php echo round($rect_current[$y][2], 2); ?> A</td>
                                                                    <td class="text-center"><?php echo round($rect_temp[$y], 2); ?> &deg;C</td>

                                                                    <td class="text-center">
                                                                        <?php echo ($rectCommLost[$y] == 1) ? '<b class="text-danger "> Alrm</b>' : '<b class="text-success"></i> Nrml</b>'; ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php echo ($rectProtection[$y] == 1) ? '<b class="text-danger "> Alrm</b>' : '<b class="text-success"></i> Nrml</b>'; ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php echo ($rectACFail[$y] == 1) ? '<b class="text-danger "> Alrm</b>' : '<b class="text-success"></i> Nrml</b>'; ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php echo ($rectFail[$y] == 1) ? '<b class="text-danger "> Alrm</b>' : '<b class="text-success"></i> Nrml</b>'; ?>
                                                                    </td>

                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </section>

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
<script>
    setTimeout(function refreshTable() {
        $.ajax({
            url: '<?php echo site_url('rectifier/ajax_rectifier')  ?>',

            dataType: 'html',
            data: {
                someparam: 'someval'
            },
            success: function (data) {
                $('#monitoring').find('section').empty().append(data);
                setTimeout(refreshTable, 3000);
            }
        });
    }, 1000);
</script>
<?php $this->load->view('template/v_Foot') ?>

