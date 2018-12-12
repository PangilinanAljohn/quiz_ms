<?php $this->load->view('quiz/header_admin');?>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->

    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.html">Quiz Management System</a>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->

    <?php $this->load->view('quiz/nav_bar');?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Quizzes</h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div id="add_edit"></div>

                    <div class="card">
                        <div class="header">
                            <h2>MANAGE QUIZZES</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                      <li><a href="javascript:void(0);" id="add_quiz" class=" waves-effect waves-block">Add Quiz</a></li>
                                      <li><a href="javascript:void(0);" class=" waves-effect waves-block">Refresh</a></li>
                                      <li><a href="javascript:void(0);" class=" waves-effect waves-block">Delete All</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="quiz_table" class="table table-bordered table-striped table-hover dataTable">
                                    <thead>
                                        <tr>
                                          <th>ID</th>
                                          <th>Quiz Title.</th>
                                          <th>Info</th>
                                          <th>No. of Question</th>
                                          <th>Date Created</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                          <th>ID</th>
                                          <th>Quiz Title.</th>
                                          <th>Info</th>
                                          <th>No. of Question</th>
                                          <th>Date Created</th>
                                          <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    </tbody>
                                </table>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
        </div>
    </section>

  <?php $this->load->view('quiz/footer');?>
  <script type="text/javascript">
    $('#quiz_table').DataTable({
      ajax: {
        "url": '<?=site_url()?>quiz/get_all_quiz',
        "type": "POST"
      },
      dom: 'Bfrtip',
      responsive: true,
      buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    });

    $('#quiz_table tbody').on( 'click', '#edit', function () {
      var data = $('#quiz_table').DataTable().row( $(this).parents('tr') ).data();
      //alert(data[0]);
      $.ajax({
        url: "view_edit_quiz",
        type: "POST",
        data: { id:data[0] },
        success: function(data) {
          $('#add_edit').html(data);

          $('#close_add').on('click', function(e){
            e.preventDefault();
            $('.edit_quiz').remove();
          });
        }
      });
    });

    $('#quiz_table tbody').on( 'click', '#delete', function () {
      var data = $('#quiz_table').DataTable().row( $(this).parents('tr') ).data();
      //alert(data[0]);
      swal("Quiz Successfully Deleted!", "", "success");
    });

    $('#quiz_table tbody').on( 'click', '#activate', function () {
      var data = $('#quiz_table').DataTable().row( $(this).parents('tr') ).data();
      $.ajax({
        url: '<?=site_url()?>quiz/activate_quiz',
        type: "POST",
        data: { id:data[0] },
        success: function(){
          swal("Quiz Successfully Activated!", "", "success");
          $('#quiz_table').DataTable().ajax.reload();
        }
      });
    });

    $('#quiz_table tbody').on( 'click', '#deactivate', function () {
      var data = $('#quiz_table').DataTable().row( $(this).parents('tr') ).data();
      $.ajax({
        url: '<?=site_url()?>quiz/deactivate_quiz',
        type: "POST",
        data: { id:data[0] },
        success: function(){
          swal("Quiz Successfully Dectivated!", "", "error");
          $('#quiz_table').DataTable().ajax.reload();
        }
      });
    });
  </script>
