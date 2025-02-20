
<html>

<?php 

$valor="Red";

if (isset($_COOKIE["Color"] ) )
{
    $color=$_COOKIE["Color"];
}
else 
{
    $color="Blue";
    setcookie("Color",$valor,time()+3600); 
}
    

?>

<body bgcolor='<?php echo $color; ?>' >



</body>

</html>