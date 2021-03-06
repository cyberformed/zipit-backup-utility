<?php 
###############################################################
# Zipit Backup Utility
###############################################################
# Developed by Jereme Hancock for Cloud Sites
# Visit http://zipitbackup.com for updates
###############################################################

// include password protection
require_once("zipit-login.php");  

// require zipit configuration
require('zipit-config.php');

// define backup path
$path = getcwd();

// remove the zipit directory from path since we are running in the zipit directory
$path = str_replace("/zipit", "", $path);

// get value of usage feedback
if ($usage_feedback == "allow") {
   $checked = "checked";
}
else {
   $checked = "";
}

if (isset($_POST["Submit"])) {
   if ($zipituser == $_POST["zipituser"] || $password == $_POST["password"]) {
      echo '<script>';
      echo 'alert("Zipit Successfully Updated!\n\nIf you updated your Zipit Login credentials you will be redirected to the login page.")';
      echo '</script>';
      echo "<script>parent.location.href='./index.php'</script>";
   }

$string = '<?php 
###############################################################
# Zipit Backup Utility
###############################################################
# Developed by Jereme Hancock for Cloud Sites
# Visit http://zipitbackup.com for updates
############################################################### 

// Zipit Backup Utility -- Be sure to change the password!!
$zipituser = "'. $_POST["zipituser"]. '";
$password = "'. $_POST["password"]. '";

// Cloud Files API -- Required!!
$username = "'. $_POST["username"]. '";
$key = "'. $_POST["key"]. '";

// Datacenter
$datacenter = "'. $_POST["datacenter"]. '";

// URL
$url = "'. $_POST["url"]. '";
$url = str_replace("http://", "", $url);
$url = str_replace("https://", "", $url);

// Site Path
$path = "'. $_POST["path"]. '";

// Zipit Auth Hash
$auth_hash = "'. $_POST["auth_hash"]. '";

// Usage Feedback
$usage_feedback = "'. $_POST["usage"]. '";

?>';

$fp = fopen("zipit-config.php", "w");
fwrite($fp, $string);
fclose($fp);
}

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link rel="stylesheet" href="css/zipit/jquery-ui.css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
   function SelectAll(id) {
      document.getElementById(id).focus();
      document.getElementById(id).select();
   }
</script>

<script>
  function removeSpaces(string) {
  return string.split(' ').join('');
  }
</script>


<script src="js/jquery.js"></script>
<script src="js/jquery-ui.js"></script>

<script>
   $(function() {
      $( document ).tooltip({
         position: {
         my: "center bottom-20",
         at: "center top",
            using: function( position, feedback ) {
               $( this ).css( position );
               $( "<div>" )
               .addClass( "arrow" )
               .addClass( feedback.vertical )
               .addClass( feedback.horizontal )
               .appendTo( this );
            }  
         }
      });
   });
</script>

</head>
<body>

<div class="wrapper">
   <div style="text-align:center"><br />
      <form action="" method="post" name="settings" id="settings" class="settings">
      <p>Zipit Username:<br />
      <input name="zipituser" type="text" id="zipituser" value="<?php echo $zipituser;?>" onblur="this.value=removeSpaces(this.value);" required="required"> <img src="images/hint.png" title="This is the username for Zipit. Alphanumeric characters only!" />
      </p>
      <br />
      <p>Zipit Password:<br />
      <input name="password" type="password" id="password" value="<?php echo $password;?>" onblur="this.value=removeSpaces(this.value);" required="required"> <img src="images/hint.png" title="This is the password for Zipit. Alphanumeric characters only!" />
      </p>
      <br />
      <hr />
      <br />
      <p>API Username:<br />
      <input name="username" type="text" id="username" value="<?php echo $username;?>" onblur="this.value=removeSpaces(this.value);" required="required"> <img src="images/hint.png" title="This is the username for your API access. This is the same username that you use to login to manage.rackspacecloud.com.">
      </p>
      <br />
      <p>API Key:<br />
      <input name="key" type="password" id="key" value="<?php echo $key;?>" onblur="this.value=removeSpaces(this.value);" required="required"> <img src="images/hint.png" title="This is your API Key.">
      </p>
      <br />
      <hr />
      <br />
      <p>Datacenter:<br />
      <input name="datacenter" type="text" id="datacenter" value="<?php echo $datacenter ?>" onblur="this.value=removeSpaces(this.value);" required="required"> <img src="images/hint.png" title="This is the Datacenter where your backups will be stored. Changing this can affect how much bandwidth Zipit uses.">
      </p>
      <br />
      <p>URL:<br />
      <input name="url" type="text" id="url" value="<?php echo $url ?>" onblur="this.value=removeSpaces(this.value);" required="required"> <img src="images/hint.png" title="This is the URL of your site. It is used to name the backups and the containers that they are stored in. Do not include http://">
      </p>
      <br />
      <p>Auth Hash:<br />
      <input name="auth_hash" type="text" id="auth_hash" value="<?php echo $auth_hash ?>" onblur="this.value=removeSpaces(this.value);" required="required"> <img src="images/hint.png" title="This unique code is used for the Automated settings. Changing this will affect any previously configured Scheduled Tasks (cronjobs). Alphanumeric characters only!">
      </p>
      <br />
      <hr />
      <br />
      <p>
      <input type="checkbox" name="usage" id="usage" value="allow" <?php echo $checked ?> >Help make Zipit better by providing usage feedback. <a href="http://statcounter.com/about/cookies/" target="_blank">More info... <img src="https://raw.github.com/jeremehancock/zipit-backup-utility/master/images/open_in_new_window.png"/></a>
      </p>
      <p>
      <input name="path" type="hidden" id="path" value="<?php echo $path ?>" onblur="this.value=removeSpaces(this.value);" required="required" readonly>
      </p>
      <p>
      <br />
      <br />
      <button type="submit" name="Submit" value="Update" class="css3button">Update</button>
      </p>
   </form>

<script>
   $('input').bind('keypress', function (event) {
      var regex = new RegExp("^[a-zA-Z0-9]+$");
      var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
         if (!regex.test(key) && key.charCodeAt(0) > 32) {
            event.preventDefault();
            return false;
         }
  });
</script>

</div>

<script>
   $(function(){
      parent.$.colorbox.resize({
         innerWidth:$('body').width(),
         innerHeight:$('body').height()
      });
   });
</script>

</body>
</html>
