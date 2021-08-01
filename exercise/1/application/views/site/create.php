<!DOCTYPE html>
<html>
<head>
    <title>Title</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>

  <?php $this->load->view('menu'); ?>

  <div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="<?php echo base_url('site')?>"> Back</a>
            </div>
        </div>
    </div>
    <form method="post" action="<?php echo base_url('site/store')?>">
      <?php
        // if ($this->session->flashdata('errors')){
        //     echo '<div class="alert alert-danger">';
        //     echo $this->session->flashdata('errors');
        //     echo "</div>";
        // }
      ?>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Sapid:</strong>
                    <input type="text" name="sapid" class="form-control">
                    <?php
                      if (isset($this->session->flashdata('errors')['sapid'])){
                          echo '<div class="alert alert-danger mt-2">';
                          echo $this->session->flashdata('errors')['sapid'];
                          echo "</div>";
                      }
                    ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Hostname:</strong>
                    <textarea name="hostname" class="form-control"></textarea>
                    <?php
                      if (isset($this->session->flashdata('errors')['hostname'])){
                          echo '<div class="alert alert-danger mt-2">';
                          echo $this->session->flashdata('errors')['hostname'];
                          echo "</div>";
                      }
                    ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Loopback:</strong>
                    <textarea name="loopback" class="form-control"></textarea>
                    <?php
                      if (isset($this->session->flashdata('errors')['loopback'])){
                          echo '<div class="alert alert-danger mt-2">';
                          echo $this->session->flashdata('errors')['loopback'];
                          echo "</div>";
                      }
                    ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Macaddress:</strong>
                    <textarea name="macaddress" class="form-control"></textarea>
                    <?php
                      if (isset($this->session->flashdata('errors')['macaddress'])){
                          echo '<div class="alert alert-danger mt-2">';
                          echo $this->session->flashdata('errors')['macaddress'];
                          echo "</div>";
                      }
                    ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

  </div>
</body>
</html>
