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
              <h2>View</h2>
          </div>
          <div class="pull-right">
              <a class="btn btn-success" href="<?php echo base_url('site')?>"> Back</a>
          </div>
      </div>
    </div>

    <table class="table table-bordered">
        <tbody>
            <tr>
                <td>Sapid</td>
                <td><?php echo $site->sapid; ?></td>
            </tr>
            <tr>
                <td>Hostname</td>
                <td><?php echo $site->hostname; ?></td>
            </tr>
            <tr>
                <td>Loopback</td>
                <td><?php echo $site->loopback; ?></td>
            </tr>
            <tr>
                <td>Macaddress</td>
                <td><?php echo $site->macaddress; ?></td>
            </tr>
        </tbody>
    </table>

  </div>
</body>
</html>
