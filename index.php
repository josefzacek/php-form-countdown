<?php					

$message_length = 19;// sets maximum of characters allowed for rextarea in this case

if(isset($_POST["message_subject"]) && isset($_POST["email"]) && isset($_POST["message"]))
	{	
		$message_subject = $_POST["message_subject"];// converts input from form to variable
		$message = $_POST["message"];
		$email = $_POST["email"];
			
			if(!empty($message_subject) && !empty($message) && !empty($email))// checks if specified field are not empty
				{	
					$filled_message = strlen($message);// gets length of text inputed by user
					
					if(strlen($message) <= $message_length)//checks if no of characters is less or equal than the characters allowed 
						{
							  $to = "info@josefzacek.cz, info@josefzacek.com";		// receiver
							  $subject = $message_subject;							// subject of message
							  $body = "Message subject: ".$message_subject."\n".	// this is what will e received in email
									  "Email: ".$email."\n".
									  "Message:".$message;
							  $headers = "From: ".$email;							// email of message sender 
							  
								  if(mail($to,$subject, $body, $headers))
									  {
										  echo "Following detail has been sent to ".$to."<br>"; // all this is just to show sender what was send
										  echo "Message subject: ".$message_subject."<br>";
										  echo "Email: ".$email."<br>";
										  echo "Message: ".$message."<br>";
									  }
								  else
									  {
										  echo "ERROR - message not sent";  // display this in case of sending error
									  }	
						}
					else 
						{
							echo "Message field can contain only ".$message_length." characters,\n 
									your message is ".$filled_message." characters."; // if message field contain more character than specified show user this message on 2 lines
						}		
				}
			else
				{
					echo "Please fill out all fields";// output if required fields not filled out
				}
	}


?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<script type="text/javascript" src="jquery-1.8.1.min.js"></script>


</head>

<body>


<form title="index.html" method="post">
    Message subject:<br>
    <input type="text" name="message_subject"/>
    <br>
     Email:<br>
    <input type="email" name="email" />
    <br>
    Message:<br>
	<textarea name="message" cols="30" rows="5" maxlength="20" data-limit-input="19" ></textarea>
	<div>0 of <?php echo $message_length; ?> characters used</div>
    <br>
    <br>
    <input type="submit" name="submit" value="Submit"/>	
</form>



<script>

$("textarea[data-limit-input]").keyup(function (e) {
    var $this      = $(this),
        charLength = $this.val().length,
        charLimit  = $this.attr("data-limit-input");
// Displays count
    $this.next("div").html(charLength + " of " + charLimit + " characters used");
// Alert when max is reached
    if ($this.val().length > charLimit) {
        $this.next("div").html("<strong>You may only have up to " + charLimit + " characters.</strong>");
    }
});

$("textarea[data-limit-input]").keydown(function (e) {
   var $this      = $(this),
       charLength = $this.val().length,
       charLimit  = $this.attr("data-limit-input");
    
   if ($this.val().length > charLimit && e.keyCode !== 8 && e.keyCode !== 46) {
       return false;
   }
});
</script>


</body>
</html>