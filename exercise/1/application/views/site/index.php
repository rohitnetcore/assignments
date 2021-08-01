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
              <h2>List</h2>
          </div>
          <div class="pull-right">
              <a class="btn btn-success" href="<?php echo base_url('site/create'); ?>"> Create New Site</a>
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12 margin-tb">
          <div class="col-lg-6">
              <input type="text" name="search_string" id="search" class="form-control" value="">
          </div>
          <div class="col-lg-6 pull-right">
              <a class="btn btn-success" class="search" id="search-btn" href="javascript:void(0)"> Search </a>
          </div>
      </div>
    </div>

    <br/>

    <table class="table table-bordered" id='postsList'>
        <thead>
            <tr>
                <th>Sapid</th>
                <th>Hostname</th>
                <th>Loopback</th>
                <th>Macaddress</th>
                <th width="220px">Action</th>
            </tr>
        </thead>
        <tbody>
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
        </tbody>
    </table>
  </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type='text/javascript'>

   $(document).ready(function(){

     $('#search-btn').on('click', function(e){
       e.preventDefault(); 
       var search_string = $('#search').val();
       loadData(search_string);
     });

     //loadData(0);

     function loadData(str){
       $.ajax({
         url: '<?php echo base_url('site/index/') ?>',
         type: 'get',
         data: {'search':str},
         dataType: 'json',
         success: function(response){
            $('#result').html(response);
            createTable(response.result,response.row);
         }
       });
     }

     function createTable(result,sno){
       
       $('#postsList tbody').empty();

       var base_url = "<?php echo base_url('site/') ?>";

       for(index in result){

          var sid = result[index].sid;
          var sapid = result[index].sapid;
          var hostname = result[index].hostname;
          var looopback = result[index].loopback;
          var macaddress = result[index].macaddress;

          var tr = "<tr>";
          tr += "<td>"+ sapid +"</td>";
          tr += "<td>"+ hostname +"</td>";
          tr += "<td>"+ looopback +"</td>";
          tr += "<td>"+ macaddress +"</td>";
          tr += "<td><form method='DELETE' action='"+ base_url+'/delete/'+sid +"'> <a class='btn btn-info' href='"+ base_url+'/show/'+sid +"'> show </a> <a class='btn btn-primary' href='"+ base_url+'/edit/'+sid +"'> Edit </a> <button type='submit' class='btn btn-danger'> Delete </button></form></td>";
          tr += "</tr>";

          $('#postsList tbody').append(tr);
        }
      }
    });
</script>
</body>
</html>
