  <?php
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
  ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../assets/img/loci.png">

    <title>prediction</title>

    <link href="../static/css/bootstrap.min.css" rel="stylesheet">
    <link href="../static/css/carousel.css" rel="stylesheet">
    <link href="form-validation.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <script src="https://kit.fontawesome.com/f611d4bc46.js" crossorigin="anonymous"></script>
    
  </head>  
  <body>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #map {
            height: 100%;
        }
    </style>
    

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
              <a class="nav-link" href="#about_as"><i class="fa fa-user"></i> ABOUT </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#prediction"><i class="fa fa-share"></i> Prediction</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>
          </ul>
         
        </div>
      </nav>
    </header>
    <main role="main">
<br ><br ><br >

      <div class="container marketing" id="prediction">

       
        <br >

         <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted"><i class="fa fa-user"></i> Info Desk</span>
            <span class="badge badge-info badge-pill"></span>
          </h4>
          <ul class="list-group mb-3">
             <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Model Accurcy</h6>
                <small class="text-muted"></small>
              </div>
              <span class="text-muted">87%</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Current Loc:</h6>
                <small class="text-muted"><?php echo $current->city; ?>, <?php echo $current->country; ?></small>
              </div>
              <span class="text-muted"><?php echo $current->state; ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Location</h6>
                  <small class="text-muted"><?php echo $current->location; ?></small>
             
              </div>
              <span class="text-muted"></span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Latitude & Longitude</h6>
                <small class="text-muted">Brief description</small>
              </div>
              <span class="text-muted"></span>
            </li>
            <li class="list-group-item d-flex justify-content-between bg-light">
              <div class="text-success">
                <h6 class="my-0">Promo code</h6>
                <small>Total Data</small>
              </div>
              <span class="text-success">-</span>
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
          
          <a href="https://mintinc.000webhostapp.com/hitMap.php?id={{pred}}" class="btn btn-info" class="mb-3"><i class="fa fa-arrow-circle-o-left"></i> Back </a>
        
          <hr class="mb-4">
            <br>
            <h4 class="mb-3"><b>Prediction Result</b></h4>
            
             <!-- <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="same-address">
              <label class="custom-control-label" for="same-address">Current Month</label>
            </div> -->
            <div class="custom-control custom-checkbox">            
            
 
            <a href="hitmap.php" class="btn btn-danger" class="btn btn-info btn-lg">{{pred}}</a>
            <hr class="mb-4">
             
              <?php if(pred[1]>0.5):?>
             <p><em>The result shows the area may be at risk..!<em></p>
                  <?php else :?>
             <p><em>The result shows the area may not be at risk..!<em></p>
               <?Php endif; ?>
             <p>The development of automated tools will help the organization and the 
               <em>government to early detect and predict locust swarm suitable locations based on<em> 
                 the<b> metrological </b>and other seasonal factors such as wind direction and month of the year. If the invasion of the locust is early predicted it will help for taking corrective measures and to plan early the resources needed to combat the locust spread</p>

      

        <hr class="featurette-divider">
      </div><!-- /.container -->
    
      <div class="panel-group">
 <br><br><br><br><br><br><br>

      <!-- FOOTER -->
      <footer class="container">
        <p class="float-right"><a href="#">Back to top</a></p>
        <p>&copy; 2021 Loci Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>
    </main>

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
