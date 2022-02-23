<?php
$dbconn = pg_connect("host=localhost dbname=postgres user=postgres password=nhonnam");
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    $uname = $_POST["username"];
    $passwd = $_POST["password"];
    if (str_starts_with($uname,'drt')){
        $sql = "SELECT * FROM Director WHERE username = '".$uname."' AND password = '".$passwd."'";
        $data = pg_query($dbconn,$sql);
        $login_check = pg_num_rows($data);
        if($login_check > 0){
            header('Location: allshops.php');
        }   
        else{
            echo "Login falied";
		    die();
        }
    }
    else{
        $sql = "SELECT * FROM Staff WHERE usernam = '".$uname."' AND password = '".$passwd."'";
        $data = pg_query($dbconn,$sql); 
        $login_check = pg_num_rows($data);
        if($login_check > 0){
            $arr = pg_fetch_array($data);
            if ($arr["shop"] == "SHOP_A")
                header('Location: shopA.php');
            else header('Location: shopB.php');
        }
        else{
            echo "Login falied";
		    die();
        }
    }
}
?>
<html>
    <form action="login.php" method="post">
        <p>Username: <input type="text" name="username"/></p></br>
        <p>Password: <input type="password" name="password"/></p></br>
        <input type="submit" value="submit"/>
    </form>
</html>