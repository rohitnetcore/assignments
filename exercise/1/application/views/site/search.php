
<?php foreach ($sites as $site) { ?>
  <tr>
      <td><?php echo $site->sapid; ?></td>
      <td><?php echo $site->hostname; ?></td>
      <td><?php echo $site->loopback; ?></td>
      <td><?php echo $site->macaddress; ?></td>
  <td>
    <form method="DELETE" action="<?php echo base_url('site/delete/'.$site->sid);?>">
      <a class="btn btn-info" href="<?php echo base_url('site/show/'.$site->sid) ?>"> show</a>
     <a class="btn btn-primary" href="<?php echo base_url('site/edit/'.$site->sid) ?>"> Edit</a>
      <button type="submit" class="btn btn-danger"> Delete</button>
    </form>
  </td>
  </tr>
<?php } ?>
        