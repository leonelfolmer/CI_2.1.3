<?php

function CheckAuthentication()
{
	$ci_session = $_COOKIE['ci_session'];
	$ci_session = stripslashes($ci_session);
	$ci_session = unserialize($ci_session);
	$ci_session_id = $ci_session['session_id'];
	

	$dbhost = '127.0.0.1';
	$dbuser = 'root';
	$dbpass = 'admin';
	$dbnya = 'CI_2_2_6';
	
	$ci_session_con = mysqli_connect($dbhost, $dbuser, $dbpass); 
		
		if (!$ci_session_con) 
		{
			die("Erro na conexão!"); 
		}

			// se for necessário, limitar a quantidade de usuários logados, '$ci_session_id' LIMIT 1
			$query = "SELECT user_data FROM ci_sessions WHERE session_id = '$ci_session_id'";
			mysqli_select_db($ci_session_con, $dbnya);
			$result = mysqli_query($ci_session_con, $query);
			if (!$result) 
			{
				die("Erro!");
			}

  $row = mysqli_fetch_assoc($result);
  $data = unserialize($row['user_data']);

  if( $data['group_id'] == '1' || $data['group_id'] == '2' )  // $data['group_id'] == '3'...
  {
	  return true; 
  }
		  else 
		  {
			return false;   
		  }
}

$config['LicenseName'] = 'opensource';
$config['LicenseKey'] = '55D63TXF2UBBEN7315VDRNXU9';

$baseUrl = '/CI_2.1.3/';

$baseDir = resolveUrl($baseUrl);

$config['Thumbnails'] = Array( 
		'url' => $baseUrl . 'assets/uploads/_thumbs',
		'directory' => $baseDir . 'assets/uploads/_thumbs',
		'enabled' => true,
		'directAccess' => false,
		'maxWidth' => 100,
		'maxHeight' => 100,
		'bmpSupported' => false,
		'quality' => 80); 

$config['Images'] = Array(
		'maxWidth' => 1600,
		'maxHeight' => 1200,
		'quality' => 80);

$config['RoleSessionVar'] = 'CKFinder_UserRole';

$config['AccessControl'][] = Array(
		'role' => '*',
		'resourceType' => '*',
		'folder' => '/',

		'folderView' => true,
		'folderCreate' => true,
		'folderRename' => true,
		'folderDelete' => true,

		'fileView' => true,
		'fileUpload' => true,
		'fileRename' => true,
		'fileDelete' => true);




$config['DefaultResourceTypes'] = '';

$config['ResourceType'][] = Array(
		'name' => 'Pastas', // Single quotes not allowed
		'url' => $baseUrl . 'assets/uploads/pastas',
		'directory' => $baseDir . 'assets/uploads/pastas',
		'maxSize' => 0,
		'allowedExtensions' => 'jpeg,jpg',
		'deniedExtensions' => '');

$config['ResourceType'][] = Array(
		'name' => 'Imagens',
		'url' => $baseUrl . 'assets/uploads/imagens',
		'directory' => $baseDir . 'assets/uploads/imagens',
		'maxSize' => "16M",
		'allowedExtensions' => 'jpeg,jpg',
		'deniedExtensions' => '');

$config['ResourceType'][] = Array(
		'name' => 'Flash',
		'url' => $baseUrl . 'assets/uploads/flash',
		'directory' => $baseDir . 'assets/uploads/flash',
		'maxSize' => 0,
		'allowedExtensions' => 'swf',
		'deniedExtensions' => '');


$config['CheckDoubleExtension'] = true;


$config['FilesystemEncoding'] = 'UTF-8';

/*
Perform additional checks for image files
if set to true, validate image size
*/
$config['SecureImageUploads'] = true;

/*
Indicates that the file size (maxSize) for images must be checked only
after scaling them. Otherwise, it is checked right after uploading.
*/
$config['CheckSizeAfterScaling'] = true;

/*
For security, HTML is allowed in the first Kb of data for files having the
following extensions only.
*/
$config['HtmlExtensions'] = array('html', 'htm', 'xml', 'js');

/*
Folders to not display in CKFinder, no matter their location.
No paths are accepted, only the folder name.
The * and ? wildcards are accepted.
*/
$config['HideFolders'] = Array(".svn", "CVS");

/*
Files to not display in CKFinder, no matter their location.
No paths are accepted, only the file name, including extension.
The * and ? wildcards are accepted.
*/
$config['HideFiles'] = Array(".*");

/*
After file is uploaded, sometimes it is required to change its permissions
so that it was possible to access it at the later time.
If possible, it is recommended to set more restrictive permissions, like 0755.
Set to 0 to disable this feature.
Note: not needed on Windows-based servers.
*/
$config['ChmodFiles'] = 0777 ;

/*
See comments above.
Used when creating folders that does not exist.
*/
$config['ChmodFolders'] = 0755 ;

/*
Force ASCII names for files and folders.
If enabled, characters with diactric marks, like å, ä, ö, ć, č, đ, š
will be automatically converted to ASCII letters.
*/
$config['ForceAscii'] = false;


include_once "plugins/imageresize/plugin.php";
include_once "plugins/fileeditor/plugin.php";

$config['plugin_imageresize']['smallThumb'] = '90x90';
$config['plugin_imageresize']['mediumThumb'] = '120x120';
$config['plugin_imageresize']['largeThumb'] = '180x180';
