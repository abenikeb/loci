 <?php include './core/init.php'; ?>
 <?php if (isset($_SESSION['email'])): ?>

  <?php
  $servername = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'loci';

  $conn = new mysqli($servername, $username, $password, $dbname);
  $query = 'SELECT * FROM city ORDER BY name ASC';
  $query2 = 'SELECT * FROM mnth';

  $result = mysqli_query($conn, $query);
  $result_mnth = mysqli_query($conn, $query2);

  $cache_file = 'data.json';
  if (file_exists($cache_file)) {
      $data = json_decode(file_get_contents($cache_file));
  } else {
      $api_url =
          'https://content.api.nytimes.com/svc/weather/v2/current-and-seven-day-forecast.json';
      $data = file_get_contents($api_url);
      file_put_contents($cache_file, $data);
      $data = json_decode($data);
  }
  $current = $data->results->current[0];
  //////////////////////////////////////////////////////////////////////////////
  $status = '0';
  if (isset($_POST['search'])) {
      try {
          $city = $_POST['city_list'];
          $mnth = $_POST['mnth_list'];
          $curl = curl_init();

          curl_setopt_array($curl, [
              //CURLOPT_URL => 'https://community-open-weather-map.p.rapidapi.com/weather?q=London%2Cuk&lat=0&lon=0&callback=test&id=2172797&lang=null&units=%22metric%22%20or%20%22imperial%22&mode=xml%2C%20html',
              CURLOPT_URL => 'http://api.worldweatheronline.com/premium/v1/weather.ashx?key=c61bccb2b89b462a8c780827211703&fx=no&cc=yes&mca=yes&format=json&q=addis%abeba',

              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_HTTPHEADER => [
                  'x-rapidapi-host: api.worldweatheronline.com',
                  'x-rapidapi-key: c61bccb2b89b462a8c780827211703',
              ],
          ]);

          $response = curl_exec($curl);
          $err = curl_error($curl);

          curl_close($curl);

          if ($err) {
              echo 'cURL Error #:' . $err;
          }

          $response = json_decode($response, true);
          $result = $response['data']['ClimateAverages']['0']['month'][$mnth];
          $result_current = $response['data']['current_condition']['0'];
      } catch (Exception $e) {
          $error = $e->getMessage();
          // echo $error;
      }
  }
  ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./assets/img/loci.png">

    <title>Loci</title>

    <link href="./dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="carousel.css" rel="stylesheet">
    <link href="form-validation.css" rel="stylesheet">
    
  </head>
  <body>

    <header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Loci</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about_as">About as</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#prediction">Prediction</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>
          </ul>
          <form class="form-inline mt-2 mt-md-0">
            <!-- <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search"> -->
            <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button> -->
              <a href="../login" class="btn btn-outline-secondary my-2 my-sm-0">
                 Logout
              </a>
          </form>
        </div>
      </nav>
    </header>
    <main role="main">

      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="first-slide" src="./assets/img/locust_1280p.jpg" alt="First slide">
            <div class="container">
              <div class="carousel-caption text-left">
                <h1>Loci</h1>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                <p><a class="btn btn-lg btn-info" href="#" role="button">Sign up today</a></p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img class="second-slide" src="./assets/img/lll.jpg" alt="Second slide">
            <div class="container">
              <div class="carousel-caption">
                <h1>Loci</h1>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                <p><a class="btn btn-lg btn-info" href="#" role="button">Learn more</a></p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img class="third-slide" src="./assets/img/pexels-erik-karits-5230651--.jpg" alt="Third slide">
            <div class="container">
              <div class="carousel-caption text-right">
                <h1>Loci</h1>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                <p><a class="btn btn-lg btn-info" href="#" role="button">Browse gallery</a></p>
              </div>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
        <div id="about_as"></div>
      </div>
     


      <div class="container marketing">

        <!-- Three columns of text below the carousel -->
        <div class="row" >
          <div class="col-lg-4">
            <img class="rounded-circle" src="./assets/img/pexels-terje-sollie-336948.jpg" alt="Generic placeholder image" width="140" height="140">
            <h2>Prediction</h2>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img class="rounded-circle" src="./assets/img/hitmap.jpg" alt="Generic placeholder image" width="140" height="140">
            <h2>Hit Map</h2>
            <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img class="rounded-circle" src="./assets/img/pexels-erik-karits-5230651.jpg" alt="Generic placeholder image" width="140" height="140">
            <h2>Alert</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->


        <!-- START THE FEATURETTES -->

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It'll blow your mind.</span></h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
          </div>
          <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto" src="../assets/img/hh.png" alt="Generic placeholder image">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">See for yourself.</span></h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
          </div>
          <div class="col-md-5 order-md-1">
            <img class="featurette-image img-fluid mx-auto" src="../assets/img/map.png" alt="Generic placeholder image">
          </div>
        </div>

        <hr class="featurette-divider" id="prediction">

         <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Result</span>
            <span class="badge badge-info badge-pill">1</span>
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Current Loc: <?php echo $current->city .
                    '(' .
                    $current->country .
                    ')'; ?></h6>
                <small class="text-muted">Occurance Option</small>
              </div>
              <span class="text-muted">89%</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Longitutde</h6>
                 <?php if ($status == 0): ?>
                <small class="text-muted"></small>
                <?php else: ?>
                <small class="text-muted"></small>
                <?php endif; ?>
              </div>
              <span class="text-muted">11%</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Latitude</h6>
                <small class="text-muted">Brief description</small>
              </div>
              <span class="text-muted">$5</span>
            </li>
            <li class="list-group-item d-flex justify-content-between bg-light">
              <div class="text-success">
                <h6 class="my-0">Promo code</h6>
                <small>EXAMPLECODE</small>
              </div>
              <span class="text-success">-$5</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (USD)</span>
              <strong>$20</strong>
            </li>
          </ul>

         

          <form class="card p-2">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Promo code">
              <div class="input-group-append">
                <button type="submit" class="btn btn-secondary">Redeem</button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Prediction</h4>
          <form class="needs-validation"  id="details" action="index.php" method="post">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="lastName">State</label>
                <select class="custom-select d-block w-100" name="city_list" required>
                  <option value="">Choose...</option>
                  <?php while ($row = mysqli_fetch_array($result)) {
                      echo '<option value="' .
                          $row['name'] .
                          '">' .
                          $row['name'] .
                          '</option>';
                  } ?>
                </select>
                <div class="invalid-feedback">
                  Please provide a valid state.
                </div>
              </div>
              <div class="col-md-6 mb-3">
               <label for="lastName">Month</label>
                <select class="custom-select d-block w-100" name="mnth_list" required>
                  <option value="">Choose...</option>
                    <?php while ($row = mysqli_fetch_array($result_mnth)) {
                        echo '<option value="' .
                            $row['id'] .
                            '">' .
                            $row['name'] .
                            '</option>';
                    } ?>
                </select>
                <div class="invalid-feedback">
                  Please provide a valid state.
                </div>
              </div>
            </div>
            <p><Button class="btn btn-info" name="search" role="button">Submit</Button></p>
            <!-- novalidate style="display:none" -->
          </form>


          <form class="needs-validation"  action='https://prediction-locust.herokuapp.com/' method="POST" >
            <div class="mb-3">
              <label for="username">Nearby Country Occ</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div>
               
                <select class="custom-select d-block w-80" id="state" required>
                  <option value="">Choose...</option>
                  <option value="1">Kenya</option>
                  <option value="2">Ertirea</option>
                  <option value="3">Sudan</option>
                  <option value="4">Somalia</option>
                </select>
                 <div class="invalid-feedback" style="width: 100%;">
                  required.
                </div>

              </div>
            </div>
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="firstName">Temperature Max</label>
                <input type="text" class="form-control" name="temp_max" value="<?php echo $result[
                    'absMaxTemp'
                ]; ?>" required />
                <div class="invalid-feedback">
                  Valid value is required.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="lastName">Temperature Min</label>              
                <input type="text" class="form-control" name="temp_min" value="<?php echo $result[
                    'avgMinTemp'
                ]; ?>" required />
               
                <div class="invalid-feedback">
                  Valid value required.
                </div>
              </div>
               <div class="col-md-4 mb-3">
                <label for="lastName">Temperature Avg</label>

                <?php $avg =
                    ($result['absMaxTemp'] + $result['avgMinTemp']) / 2; ?>
                <input type="text" class="form-control"  placeholder="" value="<?php echo $avg; ?>" required>
   
                <div class="invalid-feedback">
                  Valid value  is required.
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="firstName">Presure</label>
                <input type="text" class="form-control" name="presure" placeholder="" value="<?php echo $current->pressure; ?>" required>
                <div class="invalid-feedback">
                  Valid  name is required.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="lastName">Solar radiation</label>
                <input type="text" class="form-control" name="solar_radiation" placeholder="" value="<?php echo $result_current[
                    'visibility'
                ]; ?>" required>
                <div class="invalid-feedback">
                  Valid radiation value is required.
                </div>
              </div>
               <div class="col-md-4 mb-3">
                <label for="lastName">Preciption</label>

                <?php $preception = $result['avgDailyRainfall'] * 30; ?>
                <input type="text" class="form-control" name="Preciption" placeholder="" value="<?php echo $preception; ?>" required>
 
                <div class="invalid-feedback">
                  Valid preception value is required.
                </div>
              </div>
            </div>


            <div class="mb-3">
              <label for="address2">Wind Speed <span class="text-muted">(KPH)</span></label>
              <input type="text" class="form-control" name="address2" placeholder="Wind Speed" value="<?php echo $result_current[
                  'windspeedKmph'
              ]; ?>" required>
            </div>
            
              <input type="hidden" class="form-control" name="month" placeholder="Wind Speed" value="<?php echo $result[
                  'index'
              ]; ?>" required>
              <input type="hidden" name="longitude" value="38.7578" required>
              <input type="hidden"  name="latitude" value="8.9806" required>
           
            <!-- <hr class="mb-4"> -->
            <button class="btn btn-info btn-lg btn-block" type="submit">Continue to Prediction</button>
          </form>

            <br>
            <h4 class="mb-3">Generate Hitmap</h4>

            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="same-address">
              <label class="custom-control-label" for="same-address">Addis Abeba</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="save-info">
              <label class="custom-control-label" for="save-info">Jiamma</label>
            </div>
            <hr class="mb-4">

 
            <button class="btn btn-danger" type="submit">Generate Hit</button>
          
        </div>
      </div>

        <hr class="featurette-divider">

        <!-- /END THE FEATURETTES -->

      </div><!-- /.container -->


      <!-- FOOTER -->
      <footer class="container">
        <p class="float-right"><a href="#">Back to top</a></p>
        <p>&copy; 2017-2018 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>
    </main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../assets/js/vendor/popper.min.js"></script>
    <script src="../dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../assets/js/vendor/holder.min.js"></script>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
  </body>
</html>


<?php else: ?>	
<?php
header('Location:../login');
exit();
?>

	
<?php endif; ?>
