<!--  POPUP MODAL  -->
<div id="logout" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Confirmation.</h4>
            </div>
            <div class="modal-body">
                <p>Logout Now ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">NO</button>
                <a href="<?php echo site_url('auth/logout'); ?>" type="button" class="btn btn-danger">YES</a>
            </div>
        </div>
    </div>
</div>
<!--  POPUP MODAL  -->


<script src="<?php echo base_url() ?>assets/libs/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/libs/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/libs/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="<?php echo base_url() ?>assets/libs/bootstrap-tabdrop/bootstrap-tabdrop.min.js"></script>
<script src="<?php echo base_url() ?>assets/libs/sparkline/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url() ?>assets/libs/ionrangeslider/js/ion.rangeSlider.min.js"></script>
<script src="<?php echo base_url() ?>assets/libs/inputNumber/js/inputNumber.js"></script>
<script src="<?php echo base_url() ?>assets/libs/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
<script src="<?php echo base_url() ?>assets/libs/selectize/dist/js/standalone/selectize.min.js"></script>
<script src="<?php echo base_url() ?>assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url() ?>assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url() ?>assets/libs/bootstrap-tabdrop/bootstrap-tabdrop.min.js"></script>
<script src="<?php echo base_url() ?>assets/libs/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/template/controls.js"></script>
<script src="<?php echo base_url() ?>assets/js/main.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo.js"></script>

<script>
    /*setTimeout(function refreshTable() {
        $.ajax({
            url:'<?php echo site_url('dashboard/ajax_time') ?>',

            dataType:'html',
            data:{
                someparam:'someval'
            },
            success:function(data) {
                $('#dtime').find('span').empty().append(data);
                setTimeout(refreshTable, 1000);
            }
        });
    }, 1000);
    setTimeout(function refreshTable() {
        $.ajax({
            url:'<?php echo site_url('dashboard/alarm_active') ?>',

            dataType:'html',
            data:{
                someparam:'someval'
            },
            success:function(data) {
                $('#alarm_active').find('ul').empty().append(data);
                setTimeout(refreshTable, 1000);
            }
        });
    }, 1000);*/
</script>

</body>
</html>w
