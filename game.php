<?php

if ( ! isset($_GET['name']) || strlen($_GET['name']) < 1  ) {
    die('Name parameter missing');
}

// If the user requested logout go back to index.php
if ( isset($_POST['logout']) ) {
    header('Location: index.php');
    return;
}

$names = array('Rock', 'Paper', 'Scissors');
$human = isset($_POST["human"]) ? $_POST['human']+0 : -1;

$computer = rand(0,2); 

function check($computer, $human)
{    
    if ( $human == $computer ) 
    {
        return "Tie";
    } 
    elseif($human == 0)
    {
        if($computer == 1)
        {
            return("You Lose");
        }
        else
        {
            return("You Win");
        }
    }
    elseif($human == 1)
    {
        if($computer == 0)
        {
            return("You win");
        }
        else
        {
            return("You Lose");
        }
    }
    elseif($human == 2)
    {
        if($computer == 0)
        {
            return("You Lose");
        }
        else
        {
            return("You Win");
        }        
    }
    else
    {
        return("Please choose one option.");
    }
    return false;
}

// Check to see how the play happenned
$result = check($computer, $human);

?>
<!DOCTYPE html>
<html>
<head>
<title>99e54b30</title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
 integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

 <!-- Page CSS -->
 <link rel="stylesheet" href="somecss.css">
 
</head>
<body>
<div class="container">
<h1>Rock Paper Scissors</h1>
<?php
if ( isset($_REQUEST['name']) ) {
    echo "<p>Welcome: ";
    echo htmlentities($_REQUEST['name']);
    echo "</p>\n";
}
?>
<form method="post">
<select name="human">
<option value="-1">Select</option>
<option value="0">Rock</option>
<option value="1">Paper</option>
<option value="2">Scissors</option>
<option value="3">Test</option>
</select>
<input type="submit" value="Play">
<input type="submit" name="logout" value="Logout">
</form>

<pre>
<?php
if ( $human == -1 ) {
    print "Please select a strategy and press Play.\n";
} else if ( $human == 3 ) {
    for($c=0;$c<3;$c++) {
        for($h=0;$h<3;$h++) {
            $r = check($c, $h);
            print "Human=$names[$h] Computer=$names[$c] Result=$r\n";
        }
    }
} else {
    print "Your Play=$names[$human] Computer Play=$names[$computer] Result=$result\n";
}
?>
</pre>
</div>
</body>
</html>
