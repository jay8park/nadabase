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
<?php
        require "dbutil.php";
        session_start();
        $db = DbUtil::logInUserB();

        // $stmt = $db->stmt_init();
        $rid=0;
        $post_date=date('Y-m-d');
        $post_time=date('H:i:s');
        $job_id=$_GET['job_id'];

        $cid=$_SESSION['user'];
        // echo $cid;
        //$cid='cha4yw';
 
        if ($result = $db->query("SELECT cult_word from proj_culture_words")) {
          while($out = $result->fetch_row()) {
            $words[]=$out[0];
          }
          $result->close();
        }$word_count=count($words);

        if ($result = $db->query("SELECT MAX(rid) from proj_review limit 1")) {
            $out=$result->fetch_array(MYSQLI_NUM);
            $rid=$out[0]+1;
            $result->close();
        }
        if ($db->query("INSERT INTO proj_review VALUES ($rid, '$post_date', '$post_time', '".$_POST["diff"]."', '".$_POST["boss"]."', '".$_POST["satisf"]."', '".$_POST["flex"]."', '".$_POST["review"]."', '$cid', $job_id)")){
            echo "<center><h3>Your review has been added!</h3><a class='btn btn-primary btn-sm' href='GetJob.php?jid=$job_id' role='button'>Return to Job Page</a></center>";
        } else {
            echo "error";
            echo mysqli_error($db);
        }
        for ($j=0; $j<$word_count;$j++){
          if(isset($_POST[$words[$j]])) 
          {
            if ($db->query("INSERT INTO proj_culture VALUES ($rid, '".$_POST[$words[$j]]."')")){
             console.log("good");
          } else {
            echo "nope...";
            echo mysqli_error($db);
          } 
          }
        }
        $db->close();


?>
  </body>
</html>