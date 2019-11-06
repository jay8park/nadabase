<html>
  <head>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>
    <script
      src="js/jquery-ui-1.8.16.custom.min.js"
      type="text/javascript"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
    <title>Job Description</title>
    <!-- <script>
      $(document).ready(function() {
        $.ajax({
          url: "GetJob.php",
          data: { job_id: $("hi").val() },
          success: function(data) {
            $("#jobresult").html(data);
          }
        });
      });
    </script> -->
  </head>
  <body>
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">Welcome to [insert app name here]</h1>
        <p class="lead">
          This is a platform for people to search for on-grounds jobs and leave
          reviews!
        </p>
      </div>
    </div>
    <a class="btn btn-primary btn-sm" href="searchJobs.html" role="button">
      Search Jobs
    </a>
    <?php
        require "dbutil.php";
        $db = DbUtil::logInUserB();

        $stmt = $db->stmt_init();
        $job_id = $_GET['jid'];

        if($stmt->prepare("select * from proj_job where job_id=$job_id") or die(mysqli_error($db))) {
                $searchString = '%';
                $stmt->bind_param(s, $searchString);
                $stmt->execute();
                $stmt->bind_result($job_id, $title, $description, $hrs, $wages, $location, $work_study, $name);
                
                while($stmt->fetch()) {
                        echo "<div class='card w-90'><div class='card-header'>$title</div><div class='card-body'><h5 class='card-title'>$name</h5><p class='card-text'>$description</br>Hourly Pay: $wages</p></div></div></br></br>" ;
                }
                $stmt->close();
        }

        $db->close();
?>
    <center>
      <div id="jobresult"></div>
    </center>
  </body>
</html>