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
                <h2>Respondents</h2>
            </div>

            <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="card">
                          <div class="header">
                              <h2>
                                  RESPONDENT'S TABLE
                              </h2>
                              <ul class="header-dropdown m-r--5">
                                  <li class="dropdown">
                                      <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                          <i class="material-icons">more_vert</i>
                                      </a>
                                      <ul class="dropdown-menu pull-right">
                                          <li><a href="javascript:void(0);" class=" waves-effect waves-block">Refresh</a></li>
                                          <li><a href="javascript:void(0);" class=" waves-effect waves-block">Delete All</a></li>
                                      </ul>
                                  </li>
                              </ul>
                          </div>
                          <div class="body">
                              <div class="table-responsive">
                                  <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                      <thead>
                                          <tr>
                                              <th>Full Name</th>
                                              <th>Contact Number</th>
                                              <th>Email Address</th>
                                              <th>Score</th>
                                              <th>Date Taken</th>
                                              <th>Action</th>
                                          </tr>
                                      </thead>
                                      <tfoot>
                                          <tr>
                                              <th>Full Name</th>
                                              <th>Contact Number</th>
                                              <th>Email Address</th>
                                              <th>Score</th>
                                              <th>Date Taken</th>
                                              <th>Action</th>
                                          </tr>
                                      </tfoot>
                                      <tbody>
                                        <?php foreach ($respondent as $r):?>
                                          <tr role="row" class="odd">
                                            <td class="sorting_1"><?=$r->first_name?> <?=$r->middle_name?> <?=$r->last_name?></td>
                                            <td><?=$r->contact_no?></td>
                                            <td><?=$r->email?></td>
                                            <td><?=$r->score?></td>
                                            <td><?=$r->date_taken?></td>
                                            <td>
                                              <button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float">
                                                  <a ><i class="material-icons">delete_forever</i></a>
                                              </button>
                                            </td>
                                          </tr>
                                        <?php endforeach?>
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
