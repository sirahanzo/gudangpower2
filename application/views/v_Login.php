<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Controller</title>
    <!--<link rel="icon" type="image/png" href="img/favicon.png">-->
    <link rel="apple-touch-icon-precomposed" href="img/apple-touch-favicon.png">
    <link href="<?php echo base_url() ?>assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!--<link href="http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic" rel="stylesheet" type="text/css">-->
    <link href="<?php echo base_url();?>assets/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/libs/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/right.dark.css" rel="stylesheet" class="demo__css">
    <link href="<?php echo base_url();?>assets/css/demo.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body class="framed">
<div class="wrapper">
    <div class="login">

        <form action="<?php echo site_url('auth')  ?>" class="login__form" method="post">

            <div class="login__logo"></div>
            <div class="alert alert-danger <?php if ($this->session->flashdata('error') == '') echo 'hide';; ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
            </div>
            <div class="form-group">
                <input type="text" placeholder="Login" class="form-control" name="username">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Password" class="form-control" name="password">
            </div>
            <div class="form-group login__action">
                <div class="login__submit">
                    <button type="submit" class="btn btn-default">Sign in</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/demo.js"></script>

</body>
</html>