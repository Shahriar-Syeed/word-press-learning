This is our completely amazing custom theme.
<?php 
// function myFirstFunction (){
//   echo 2+2;
//   echo "<h3>This is my first function.</h3>";
// }
// myFirstFunction();
// myFirstFunction();
function greet($name, $color){
  echo 
 " <p>Hi, my name is $name and my favorite color is $color.</p>";
}
greet('John', 'orange');
greet('Jane', 'red');
?>
<h1><?php bloginfo('name');?></h1>
<p><?php bloginfo('description');?></p>

<?php 
 $names= array('Brad', 'John','Jane','Meowsalot', 'alif', 'sultan');
 $count = 0;
 echo "<ol>";
while($count < count($names)){
 echo "<li>Hi my name is $names[$count]</li>";
 $count++;
}
echo "</ol>"
?>
<?php ?>
<p>Hi my name is <?php echo $names[3]; ?>.</p>