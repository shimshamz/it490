<?php
session_start();
$username = $_SESSION['username'];

$symbol = 'USD ($)';

date_default_timezone_set('America/New_York');
$sevenDaysAgo = date('Ymd', strtotime('-7 days'));
$yesterday = date('Ymd', strtotime('yesterday'));

$search_input = $_GET['search'];

if (isset($_GET['search']) && !empty($_GET['search'])) {
  $searchname = preg_replace('/\s+/', '+', $search_input);
  //search
  $json_string = file_get_contents("https://marketdata.websol.barchart.com/getQuote.json?apikey=aedef88fae1654cbca88ef03ee28b57e&symbols=".$search_input."");
  $history_string = file_get_contents("https://marketdata.websol.barchart.com/getHistory.json?apikey=5077e2ecc61ff495ec2387ec9e58cf95&symbol=".$search_input."&type=daily&startDate=".$sevenDaysAgo."&endDate=".$yesterday."&order=desc");
}

$jsonarray = json_decode($json_string, true); //convert json into multidimensional associative array
$historyarray = json_decode($history_string, true);

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Search Results</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <div class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Educational Tool</div>
      </div>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-graduation-cap"></i>
          <span>Stocks 101</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Learn More</h6>
            <a class="collapse-item" href="gettingstarted.php">Getting Started</a>
            <a class="collapse-item" href="basedonportfolio.php">Based on your Portfolio</a>
          </div>
        </div>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form method="get" action="searchresults.php" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="Search symbol..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <!-- <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i> -->
                <!-- Counter - Alerts -->
                <!-- <span class="badge badge-danger badge-counter">3+</span>
              </a> -->
              <!-- Dropdown - Alerts -->
              <!-- <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li> -->

            <!-- Nav Item - Messages -->
            <!-- <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i> -->
                <!-- Counter - Messages -->
                <!-- <span class="badge badge-danger badge-counter">7</span>
              </a> -->
              <!-- Dropdown - Messages -->
              <!-- <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                    <div class="status-indicator"></div>
                  </div>
                  <div>
                    <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                    <div class="small text-gray-500">Jae Chun · 1d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                    <div class="status-indicator bg-warning"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div>
            </li>
 -->
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
              </a>

              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Search Results</h1>
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Currency: <span class="currCurrency"><?php echo $symbol; ?></span>
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <button class="dropdown-item" onclick="currencyconverter('usd', '<?php echo $search_input;?>')">USD ($)</button>
                <button class="dropdown-item" onclick="currencyconverter('gbp', '<?php echo $search_input;?>')">GBP (&pound;)</button>
                <button class="dropdown-item" onclick="currencyconverter('eur', '<?php echo $search_input;?>')">EUR (&euro;)</button>
              </div>
            </div>
          </div>

          
              <?php
              //Iterate through the array 'results' and assign a variable to each type that we want
              foreach($jsonarray['results'] as $test){
                
                $symbol = $test["symbol"];
                $name = $test["name"];
                $mode = $test["mode"];
                if ($mode == 'i') {
                  $mode = 'Delayed';
                } elseif ($mode == 'd') {
                  $mode = 'End of Day';
                } elseif ($mode == 'r') {
                  $mode = 'Real-time';
                }

                $lastPrice = $test["lastPrice"];
                $percentChange = $test["percentChange"];
                $open = $test["open"];
                $high = $test["high"];
                $low = $test["low"];
                $close = $test["close"];
                $volume = $test["volume"];
                $exchange = $test["exchange"];
              ?>
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                  <span class="m-0 font-weight-bold text-primary"><?php echo "<strong>$name ($symbol)</strong>"; ?></span>
                  <span>
                    <a href="#" data-toggle="modal" data-target="#buyModal" class="btn btn-primary btn-lg mx-1 px-4">
                      <span class="text">Buy</span>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#sellModal" class="btn btn-danger btn-lg mx-1 px-4">
                      <span class="text">Sell</span>
                    </a>
                  </span>
                </div>
                <div class="card-body">
                    <div class="row">
                      <div class="col-lg-8">
                          <div class="row">
                            <div class="col-lg-6">
                              <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                  <h6 class="m-0 font-weight-bold text-primary">Open</h6>
                                </div>
                                <div class="card-body">
                                  <p><span class="symbol">$</span><span class="money"><?php echo "$open"; ?></span></p>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                  <h6 class="m-0 font-weight-bold text-primary">High</h6>
                                </div>
                                <div class="card-body">
                                  <p><span class="symbol">$</span><span class="money"><?php echo "$high"; ?></span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                      
                          <div class="row">
                            <div class="col-lg-12">

                              <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                  <h6 class="m-0 font-weight-bold text-primary">Closing Prices for the Week</h6>
                                </div>
                                <div class="card-body">
                                  <div class="chart-area">
                                    <canvas id="myLineChart"></canvas>
                                  </div>
                                </div>
                              </div>

                              <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                  <thead>
                                    <tr>
                                      <th>Day of Week</th>
                                      <th>Date</th>
                                      <th>Close Price</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  <!-- The BELOW can be removed once connected to backend (it's just some fake data) -->
                                    <?php

                                    foreach ($historyarray['results'] as $day) { 
                                      $dayName = date('l', strtotime($day['tradingDay']));
                                      $date = date('m-d-Y', strtotime($day['tradingDay']));
                                      ?>
                                      <tr>
                                        <td><?php echo $dayName; ?></td>
                                        <td><?php echo $date; ?></td>
                                        <td><?php echo "$".$day['close']; ?></td>
                                      </tr>
                                    <?php

                                    }

                                    ?>
                                  <!-- The ABOVE can be removed once connected to backend -->
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="card shadow mb-4">
                              <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Low</h6>
                              </div>
                              <div class="card-body">
                                <p><span class="symbol">$</span><span class="money"><?php echo "$low"; ?></span></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="card shadow mb-4">
                              <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Price <?php echo "($mode)"; ?> </h6>
                              </div>
                              <div class="card-body">
                                <p><span class="symbol">$</span><span class="money"><?php echo "$lastPrice"; ?></span></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="card shadow mb-4">
                              <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Percentage Change</h6>
                              </div>
                              <div class="card-body">
                                <p><?php echo "$percentChange%"; ?> </p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="card shadow mb-4">
                              <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Volume</h6>
                              </div>
                              <div class="card-body">
                                <p><?php echo "$volume"; ?> </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                      
                <?php

                $_SESSION['symbol'] = $symbol;
                $_SESSION['name'] = $name;
                $_SESSION['currPrice'] = $lastPrice;
                $_SESSION['exchange'] = $exchange;

                ?>

                  </div>
                </div>
              <?php
              }
              ?>

              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                  <span class="m-0 font-weight-bold text-primary"><?php echo "<strong>Latest News on $name ($symbol)</strong>"; ?></span>
                </div>
                <div class="card-body">

                <?php 

                  $feed = simplexml_load_file("https://news.google.com/rss/search?cf=all&pz=1&q=".$symbol." ".$name."&hl=en-US&gl=US&ceid=US:en");
                  $items = $feed->channel;

                  for ($i = 0; $i < 7; $i++) {
                    $title = $items->item[$i]->title;
                    $link = $items->item[$i]->link;
                    $timeStamp = $items->item[$i]->pubDate;
                    $localTime = date('M d, Y', strtotime($timeStamp));
                    $source = $items->item[$i]->source;
                ?>

                    <div class="card shadow my-1">
                      <div class="card-body">
                        <a class="btn btn-link font-weight-bold" href="<?php echo $link; ?>"><?php echo $title; ?></a>
                        <p class="text-muted mb-1 ml-3"><?php echo $source; ?></p>
                        <small class="text-muted mb-1 ml-3"><?php echo "Published: $localTime"; ?></small>
                      </div>
                    </div>

                <?php
                  }
                ?>

                  <div class="row">
                    <div class="col-12">
                    </div>
                  </div>
                </div>
              </div>

        </div>

        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Buy Modal-->
  <div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Buy</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p>How many shares would you like to buy?</p>
          <div class="my-2"></div>
          <form method="POST" action="buyClient.php">
            <input type="number" name="buy" required>
            <input type="submit" class="btn btn-primary" value="Buy">
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Sell Modal-->
  <div class="modal fade" id="sellModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Sell</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p>How many shares would you like to sell?</p>
          <div class="my-2"></div>
          <form method="POST" action="sellClient.php">
            <input type="number" name="sell" required>
            <input type="submit" class="btn btn-danger" value="Sell">
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

  <script src="currencyconverter.js"></script>

<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';
Chart.defaults.global.animation.duration = 0;


var values = getChartData('<?php echo $search_input ?>');

function getSevenDaysAgo() {
  var now = new Date();
  var newDate = new Date(now.getTime() - (7*24*60*60*1000));
  var day = newDate.getDate();
  var month = newDate.getMonth()+1;
  var year = newDate.getFullYear();
  if (month < 10) {
    month = '0' + month;
  }
  else {
    month = '' + month;
  }
  if (day < 10) {
    day = '0' + day;
  }
  else {
    day = '' + day;
  }
  year = '' + year;

  return year + month + day;
}

function getYesterday() {
  var now = new Date();
  var newDate = new Date(now.getTime() - (1*24*60*60*1000));
  var day = newDate.getDate();
  var month = newDate.getMonth()+1;
  var year = newDate.getFullYear();
  if (month < 10) {
    month = '0' + month;
  }
  else {
    month = '' + month;
  }
  if (day < 10) {
    day = '0' + day;
  }
  else {
    day = '' + day;
  }
  year = '' + year;

  return year + month + day;
}

function getChartData(search_input) {
  sevenDaysAgo = getSevenDaysAgo();
  yesterday = getYesterday();

  let response;
  let prices = [];
  let dates = [];
  let url = 'https://marketdata.websol.barchart.com/getHistory.json?apikey=5077e2ecc61ff495ec2387ec9e58cf95&symbol=' + search_input + '&type=daily&startDate=' + sevenDaysAgo + '&endDate=' + yesterday + '&order=asc';
  $.getJSON(url, function(result){
    response = result.results;
    for (let i = 0; i < response.length; i++) {
      prices.push(response[i].close);
      dates.push(response[i].tradingDay);
    }
  });
  return {"prices":prices, "dates": dates};
}

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

// Area Chart Example

var ctx = document.getElementById("myLineChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: values.dates,
    datasets: [{
      label: "Price",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: values.prices,
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return '$' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});

setTimeout(function() { myLineChart.update(); },500);


  </script>

</body>

</html>
