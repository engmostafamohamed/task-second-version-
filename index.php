<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700,900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="contact/fonts/icomoon/style.css">

  <link rel="stylesheet" href="contact/css/owl.carousel.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="contact/css/bootstrap.min.css">

  <!-- Style -->
  <link rel="stylesheet" href="contact/css/style.css">

  <title>Contact Form #3</title>
</head>

<body>


  <div class="content">

    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 mr-auto">
          <!-- <div class="mb-5">
          </div> -->
          <div class="row">
            <div class="col-md-12">
              <div class=" col-12 form-group">
                <form>
                  <select class="form-control" name="users" onchange="showUser(this.value)">
                    <option value="">Select a person:</option>
                    <option value="all">Select All</option>
                    <?php
                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                    ?>

                        <option value="<?= $row["warehouse"] ?>"><?= $row["warehouse"] ?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </form>

              </div>
              <div class="  col-6  ">
                <div id="txtHint" class="form-group"><b> selet years will</b></div>

              </div>
              <div id="data"><b>Person info will be listed here...</b></div>
            </div>
        
          </div>
        </div>

        <div class="col-lg-6">
          <div class="box">
            <h3 class="heading">Send us a message</h3>
            <form class="mb-5" method="post" id="contactForm" name="contactForm">
              <div class="row">


              </div>
              <div class="row mb-3">
                <label for="year" class="col-form-label"> year</label>
                <input type="number" class="form-control" id="year" placeholder="input year">
              </div>
              <div class="row mb-3">
                <label for="month" class="col-form-label"> Month</label>
                <input type="number" class="form-control" id="month" placeholder="input Month">
              </div>
              <div class="row mb-3">
                <label for="warehouse" class="col-form-label"> warehouse</label>
                <input type="text" class="form-control" id="warehouse" placeholder="input warehouse">
              </div>
              <div class="row mb-3">
                <label for="items" class="col-form-label"> Number of items</label>
                <input type="number" class="form-control" id="items" placeholder="input Number of items">
              </div>
              <div class="row mb-3">
                <label for="actual" class="col-form-label"> Number of actual</label>
                <input type="number" class="form-control" id="actual" placeholder="input Number of actual">
              </div>
              <div class="row">
                <div class="col-md-12">
                  <input type="submit" id="submit" value="Enter data" class="btn btn-block btn-primary rounded-0 py-2 px-4">
                </div>
              </div>
            </form>

            <div id="form-message-warning mt-4"></div>
            <div id="form-message-success">
              Your message was sent, thank you!
            </div>
          </div>
        </div>
      </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="contact/js/jquery-3.3.1.min.js"></script>
    <script src="contact/js/popper.min.js"></script>
    <script src="contact/js/bootstrap.min.js"></script>
    <script src="contact/js/jquery.validate.min.js"></script>
    <script src="contact/js/main.js"></script>
    <script>
      $(document).ready(function() {
        $('#submit').on('click', function() {
          $("#submit").attr("disabled", "disabled");
          var year = $('#year').val();
          var month = $('#month').val();
          var warehouse = $('#warehouse').val();
          var items = $('#items').val();
          var actual = $('#actual').val();
          if (month != '' && items != '' && actual != '') {
            console.log('light');
            $.ajax({
              url: "save.php",
              type: "POST",
              data: {
                year: parseInt(year),
                month: month,
                warehouse: warehouse,
                items: parseInt(items),
                actual: parseInt(actual),
                dif: (parseInt(items) - parseInt(actual)),
                // rate: math.round(((parseInt(actual) / parseInt(items)) * 100))

              },
              cache: false,
              success: function(response) {
                var response = JSON.parse(response);
                if (response.statusCode == 200) {
                  $("#submit").removeAttr("disabled");
                  $('#myForm').find('input:text').val('');
                  $("#close").show();
                  $('#close').html('Data added successfully !');
                } else if (dataResult.statusCode == 201) {
                  alert("Error occured !");
                }
              }
            })
            console.log(typeof(parseInt(actual)));
          } else {
            alert('Please fill all the field !');
          }
        });
      });

      function showUser(str) {
        if (str == "") {
          document.getElementById("txtHint").innerHTML = "";
          return;
        } else {
          r = str;
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("txtHint").innerHTML = this.responseText;
            }
          };
          xmlhttp.open("GET", "getyears.php?q=" + str, true);
          xmlhttp.send();
        }
      }

      function showresult(year) {
        if (year == "") {
          document.getElementById("data").innerHTML = "";
          return;
        } else {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("data").innerHTML = this.responseText;
            }
          };
          xmlhttp.open("GET", "getuser.php?y=" + year + "&d=" + r, true);
          xmlhttp.send();
        }

      }
    </script>
</body>

</html>