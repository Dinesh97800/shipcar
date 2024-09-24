<?php
include('./partials/headers.php');
include('/../Api/admin/index.php');

?>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-sm-12">
        <div class="home-tab">
          <div class="tab-content tab-content-basic">
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
              <div class="row">
                <div class="col-sm-12">
                  <div class="statistics-details d-flex align-items-center justify-content-between">
                    <div>
                      <p class="statistics-title"></p>
                      <h3 class="rate-percentage">7,682</h3>
                      <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+0.1%</span></p>
                    </div>
                    <div>
                      <p class="statistics-title">New Sessions</p>
                      <h3 class="rate-percentage">68.8</h3>
                      <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p>
                    </div>
                    <div class="d-none d-md-block">
                      <p class="statistics-title">Avg. Time on Site</p>
                      <h3 class="rate-percentage">2m:35s</h3>
                      <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p>
                    </div>
                    <div class="d-none d-md-block">
                      <p class="statistics-title">New Sessions</p>
                      <h3 class="rate-percentage">68.8</h3>
                      <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p>
                    </div>
                    <div class="d-none d-md-block">
                      <p class="statistics-title">Avg. Time on Site</p>
                      <h3 class="rate-percentage">2m:35s</h3>
                      <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-8 d-flex flex-column">
                  <div class="row flex-grow">
                    <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                      <div class="card card-rounded">
                        <div class="card-body">
                          <div class="d-sm-flex justify-content-between align-items-start">
                            <div>
                              <h4 class="card-title card-title-dash">Performance Line Chart</h4>
                              <h5 class="card-subtitle card-subtitle-dash">Lorem Ipsum is simply dummy text of the
                                printing</h5>
                            </div>
                            <div id="performanceLine-legend"></div>
                          </div>
                          <div class="chartjs-wrapper mt-4">
                            <canvas id="performanceLine" width=""></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 d-flex flex-column">
                  <div class="row flex-grow">
                    <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                      <div class="card card-rounded">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-6">
                              <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="circle-progress-width">
                                  <div id="visitDistributor" class="progressbar-js-circle pr-2"></div>
                                </div>
                                <div>
                                  <p class="text-small mb-2" >Total Enquiries </p>
                                  <h4 class="mb-0 fw-bold">500</h4>
                                </div>
                              </div>
                            </div>

                            <div class="col-lg-6">
                              <div class="d-flex justify-content-between align-items-center">
                                <div class="circle-progress-width">
                                  <div id="visitRetailer" class="progressbar-js-circle pr-2"></div>
                                </div>
                                <div>
                                  <p class="text-small mb-2" >Email Enquiries</p>
                                  <h4 class="mb-0 fw-bold">400</h4>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row mt-3 d-none">
                            <div class="col-lg-6">
                              <div class="d-flex align-items-center mb-2">
                                <div class="circle-progress-width">
                                  <div id="totalVisitors" class="progressbar-js-circle pr-2"></div>
                                </div>
                                <div style="margin-left:19px">
                                  <p class="text-small mb-2" >Total Users</p>
                                  <h4 class="mb-0 fw-bold"><?php echo $pieChart['user']; ?></h4>
                                </div>
                              </div>
                            </div>
                           
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-8 d-flex flex-column">
                  <div class="row flex-grow">
                    <div class="col-12 grid-margin stretch-card">
                      <div class="card card-rounded">
                        <div class="card-body">
                          <div class="d-sm-flex justify-content-between align-items-start">
                            <div>
                              <h4 class="card-title card-title-dash">Market Overview</h4>
                              <p class="card-subtitle card-subtitle-dash">Lorem ipsum dolor sit amet consectetur
                                adipisicing elit</p>
                            </div>
                            <div>
                              <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle toggle-dark btn-lg mb-0 me-0" type="button"
                                  id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true"
                                  aria-expanded="false"> This month </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                  <h6 class="dropdown-header">Settings</h6>
                                  <a class="dropdown-item" href="#">Action</a>
                                  <a class="dropdown-item" href="#">Another action</a>
                                  <a class="dropdown-item" href="#">Something else here</a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#">Separated link</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="d-sm-flex align-items-center mt-1 justify-content-between">
                            <div class="d-sm-flex align-items-center mt-4 justify-content-between">
                              <h2 class="me-2 fw-bold">$36,2531.00</h2>
                              <h4 class="me-2">USD</h4>
                              <h4 class="text-success">(+1.37%)</h4>
                            </div>
                            <div class="me-3">
                              <div id="marketingOverview-legend"></div>
                            </div>
                          </div>
                          <div class="chartjs-bar-wrapper mt-3">
                            <canvas id="marketingOverview"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- <div class="row flex-grow">
                    <div class="col-12 grid-margin stretch-card">
                      <div class="card card-rounded">
                        <div class="card-body">
                          <div class="d-sm-flex justify-content-between align-items-start">
                            <div>
                              <h4 class="card-title card-title-dash">Pending Requests</h4>
                              <p class="card-subtitle card-subtitle-dash">You have 50+ new requests</p>
                            </div>
                            <div>
                              <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i
                                  class="mdi mdi-account-plus"></i>Add new member</button>
                            </div>
                          </div>
                          <div class="table-responsive  mt-1">
                            <table class="table select-table">
                              <thead>
                                <tr>
                                  <th>Customer</th>
                                  <th>Company</th>
                                  <th>Progress</th>
                                  <th>Status</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>
                                    <div class="d-flex ">
                                      <img src="assets/images/faces/face1.jpg" alt="">
                                      <div>
                                        <h6>Brandon Washington</h6>
                                        <p>Head admin</p>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <h6>Company name 1</h6>
                                    <p>company type</p>
                                  </td>
                                  <td>
                                    <div>
                                      <div
                                        class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                        <p class="text-success">79%</p>
                                        <p>85/162</p>
                                      </div>
                                      <div class="progress progress-md">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 85%"
                                          aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="badge badge-opacity-warning">In progress</div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <div class="d-flex">
                                      <img src="assets/images/faces/face2.jpg" alt="">
                                      <div>
                                        <h6>Laura Brooks</h6>
                                        <p>Head admin</p>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <h6>Company name 1</h6>
                                    <p>company type</p>
                                  </td>
                                  <td>
                                    <div>
                                      <div
                                        class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                        <p class="text-success">65%</p>
                                        <p>85/162</p>
                                      </div>
                                      <div class="progress progress-md">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 65%"
                                          aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="badge badge-opacity-warning">In progress</div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <div class="d-flex">
                                      <img src="assets/images/faces/face3.jpg" alt="">
                                      <div>
                                        <h6>Wayne Murphy</h6>
                                        <p>Head admin</p>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <h6>Company name 1</h6>
                                    <p>company type</p>
                                  </td>
                                  <td>
                                    <div>
                                      <div
                                        class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                        <p class="text-success">65%</p>
                                        <p>85/162</p>
                                      </div>
                                      <div class="progress progress-md">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 38%"
                                          aria-valuenow="38" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="badge badge-opacity-warning">In progress</div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <div class="d-flex">
                                      <img src="assets/images/faces/face4.jpg" alt="">
                                      <div>
                                        <h6>Matthew Bailey</h6>
                                        <p>Head admin</p>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <h6>Company name 1</h6>
                                    <p>company type</p>
                                  </td>
                                  <td>
                                    <div>
                                      <div
                                        class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                        <p class="text-success">65%</p>
                                        <p>85/162</p>
                                      </div>
                                      <div class="progress progress-md">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 15%"
                                          aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="badge badge-opacity-danger">Pending</div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <div class="d-flex">
                                      <img src="assets/images/faces/face5.jpg" alt="">
                                      <div>
                                        <h6>Katherine Butler</h6>
                                        <p>Head admin</p>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <h6>Company name 1</h6>
                                    <p>company type</p>
                                  </td>
                                  <td>
                                    <div>
                                      <div
                                        class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                        <p class="text-success">65%</p>
                                        <p>85/162</p>
                                      </div>
                                      <div class="progress progress-md">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 65%"
                                          aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="badge badge-opacity-success">Completed</div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
    include('./partials/footer.php');
    ?>
  </div>

</div>
</div>

</body>
<script>
  let userCount = <?php echo $pieChart['user'];?> ;
  let retailerCount = <?php echo $pieChart['retailer'];?> ;
  let distributorCount = <?php echo $pieChart['distributor'];?> ;
</script>
<script src="<?php echo $APP_URL; ?>dashboard/assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="<?php echo $APP_URL; ?>dashboard/assets/vendors/chart.js/chart.umd.js"></script>
<script src="<?php echo $APP_URL; ?>dashboard/assets/vendors/progressbar.js/progressbar.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="<?php echo $APP_URL; ?>dashboard/assets/js/off-canvas.js"></script>
<script src="<?php echo $APP_URL; ?>dashboard/assets/js/template.js"></script>
<script src="<?php echo $APP_URL; ?>dashboard/assets/js/settings.js"></script>
<script src="<?php echo $APP_URL; ?>dashboard/assets/js/hoverable-collapse.js"></script>
<script src="<?php echo $APP_URL; ?>dashboard/assets/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="<?php echo $APP_URL; ?>dashboard/assets/js/jquery.cookie.js" type="text/javascript"></script>
<script src="<?php echo $APP_URL; ?>dashboard/assets/js/dashboard.js"></script>

</html>