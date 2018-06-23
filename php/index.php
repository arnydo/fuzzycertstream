<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>FuzzyCertStream</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <?php include "nav.php"; ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
      </ol>
            <!-- Icon Cards-->
    <div class="row">
    <div class="col-xl-6 col-sm-6 mb-3">
          <div class="card text-white o-hidden h-100">
          <button class="btn btn-success refresh" type="submit">RELOAD</button>
        </div>
    </div>
    <div class="col-xl-6 col-sm-6 mb-3">
          <div class="card text-white o-hidden h-100">
            <button id="delete_all" class="btn btn-danger" type="submit">DELETE ALL!</button>
          </div>
    </div>
</div>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> FuzzyCertStream Matches</div>
        <div class="card-body">
          <div class="table-responsive">
          <form method="POST" id="test-form"> 
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Ratio</th>
                  <th>Domain</th>
                  <th>Matched</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  <?php include 'get_table.php'; ?>
              </tbody>
            </table>
            <button class="btn btn-success" type="submit" value="save"><span class="fa fa-arrow-right">Save Selected</span></button>
            <button class="btn btn-danger" type="submit" value="delete"><span class="fa fa-times">Delete Selected</span></button>
            <button class="btn btn-warning" type="reset" value="reset"><span class="fa fa-times">Clear Selected</span></button>


</form>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated on <span id="updated_date" />
          <script>
            document.getElementById("updated_date").innerHTML = Date();
          </script>
            <script>
            document.addEventListener("DOMContentLoaded", function(event) { 
            var rowCount = document.getElementById("dataTable").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
            document.getElementById("updated_date").innerHTML = rowCount;
});  
          </script>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © MyCoolDomain 2017</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>

    <script type="text/javascript">
    $('.del_domain').click(function(){
        var domain = $(this).attr("domain");
        var varData = 'domain=' + domain;
        console.log(varData);

        $.ajax({
            type: "POST",
            url: "delete_domain.php",
            data: varData,
            success: function(){
                window.location.reload(true);
            }


        });

    });
</script>
    <script type="text/javascript">
    $('.update_domain').click(function(){
        var domain = $(this).attr("domain");
        var matchedto = $(this).attr("matchedto");
        var varData = 'domain=' + domain + '&matchedto=' + matchedto;
        console.log(varData);

        $.ajax({
            type: "POST",
            url: "update_domain.php",
            data: varData,
            success: function(){
                window.location.reload(true);
            }


        });

    });
</script>

<script type="text/javascript">
    $('#delete_all').click(function(){
      if (confirm('Are you sure you want to do that?')){
        $.ajax({
            type: "POST",
            url: "delete_all.php",
            success: function(){
                window.location.reload(true);
                console.log("Deleted all entries.");
            }


        });
      }
    });
</script>

<script type="text/javascript">
    $('.refresh').click(function(){
      window.location.reload(true);
    });
</script>

<script type="text/javascript">
$('#test-form').submit(function(event){
    event.preventDefault();
    var buttonAction = event.originalEvent.explicitOriginalTarget.value;
    var formData = $(this).serialize();
    var varData = formData + "&action=" + buttonAction;

    $.ajax({
      type: 'POST',
      url: 'test_submit.php',
      data: varData,
      success: function(){
                window.location.reload(true);
                console.log("Form posted successfully.",varData);
            }
    })
  });
</script>

  </div>
</body>

</html>
