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
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="styles.css">

    <title>Job Description</title>
  </head>
  <body>
<div id='navbar'>
<script>
    var el = document.getElementById('navbar');
    var loginStatus = sessionStorage.getItem("login_status");
    console.log(loginStatus);
    var content;

    if  (loginStatus=="true") {
        content = "<div id='cssmenu'><ul><li class='active'><a href='index.html'>Home</span></a></li><li><a href='jobsList.html'><span>Browse Jobs</span></a></li><li><a href='searchJobs.html'><span>Search Jobs</span></a></li><li class='last'><a href='logout.php'><span>Logout</span></a></li></ul></div>";
    }
    else {
        content = "<div id='cssmenu'><ul><li><a href='index.html'>Home</span></a></li><li class='active'><a href='login.html'><span>Login</span></a></li></ul></div>";
    }

    el.insertAdjacentHTML('afterbegin', content);

</script>
</div>
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">Welcome to [insert app name here]</h1>
        <p class="lead">
          This is a platform for people to search for on-grounds jobs and leave
          reviews!
        </p>
      </div>
    </div>
<?php
        require "dbutil.php";
        $db = DbUtil::logInUserB();

        $rid=$_GET['rid'];
        if ($db->query("DELETE FROM proj_culture WHERE rid=$rid")){
            if ($db->query("DELETE FROM proj_review WHERE rid=$rid")){
                echo "<center><h3>Your review has been deleted!</h3></center>";
            } else {
                echo "error ";
                echo mysqli_error($db);
            }
        } else {
            echo "error ";
            echo mysqli_error($db);
        }
        $db->close();
?>
  </body>
</html>
