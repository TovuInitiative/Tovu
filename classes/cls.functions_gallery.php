<?php

function createThumbnail($filename, $image_details, $thumbname, $target, $createThumb = 0, $resizeBig = 0) {
	//displayArray($image_details) ; exit;
	//require 'config.php';
$quality = "";	
// Set up the appropriate image handling functions based on the original image's mime type
switch ($image_details['mime'])
{
	case 'image/gif':
		// We will be converting GIFs to PNGs to avoid transparency issues when resizing GIFs
		// This is maybe not the ideal solution, but IE6 can suck it
		$creationFunction	= 'imagecreatefromgif';
		$outputFunction		= 'imagepng';
		$mime				= 'image/png'; // We need to convert GIFs to PNGs
		$doSharpen			= FALSE;
		$quality			= round(10 - ($quality / 10)); // We are converting the GIF to a PNG and PNG needs a compression level of 0 (no compression) through 9
	break;
	
	case 'image/x-png':
	case 'image/png':
		$creationFunction	= 'imagecreatefrompng';
		$outputFunction		= 'imagepng';
		$doSharpen			= FALSE;
		$quality			= round(10 - ($quality / 10)); // PNG needs a compression level of 0 (no compression) through 9
	break;
	
	default:
		$creationFunction	= 'imagecreatefromjpeg';
		$outputFunction	 	= 'imagejpeg';
		$doSharpen			= TRUE;
	break;
}

	$im = $creationFunction($target . $filename);
	
	if($im)
	{	
		$ox = imagesx($im);
		$oy = imagesy($im);
		
		if($ox > GALLIMG_WIDTH or $oy > GALLIMG_HEIGHT) //($resizeBig == 1)
		{
			// resize the large image (based on height or based on width)
			$fxRatio		= GALLIMG_WIDTH / $ox;
			$fyRatio		= GALLIMG_HEIGHT / $oy;
			
			//echo floor($oy * (GALLIMG_WIDTH / $ox)); //exit;
			
			if ($fxRatio * $oy < GALLIMG_HEIGHT)
			{ // Resize the image based on width
				$fny	= ceil($fxRatio * $oy);
				$fnx 	= GALLIMG_WIDTH;
			}
			else // Resize the image based on height
			{
				$fnx	= ceil($fyRatio * $ox);
				$fny	= GALLIMG_HEIGHT;
			}
			
				$fnm = imagecreatetruecolor($fnx, $fny);
				imagecopyresampled($fnm, $im, 0, 0, 0, 0, $fnx,$fny,$ox,$oy);
				$outputFunction($fnm, $target . $filename);
		}
		
		
		if($createThumb == 1)		
		{
				// resize the thumbnail image (based on height or based on width)
				$xRatio		= GALLTHMB_WIDTH / $ox;
				$yRatio		= GALLTHMB_HEIGHT / $oy;
				
				if ($xRatio * $oy < GALLTHMB_HEIGHT)
				{ // Resize the image based on width
					$ny		= ceil($xRatio * $oy);
					$nx 	= GALLTHMB_WIDTH;
				}
				else // Resize the image based on height
				{
					$nx		= ceil($yRatio * $ox);
					$ny		= GALLTHMB_HEIGHT;
				}
	
				$nm = imagecreatetruecolor($nx, $ny);
				imagecopyresampled($nm, $im, 0, 0, 0, 0, $nx,$ny,$ox,$oy);
				$outputFunction($nm, $target . $thumbname);
		}
	
	}
	
	return $im;
}


/*function getFileExtension($str) {

        $i = strrpos($str,".");
        if (!$i) { return ""; }

        $l = strlen($str) - $i;
        $ext = substr($str,$i+1,$l);

        return $ext;

    }*/

function getRandomName() {
		$len = 15; $upper = 2; $number = 1; $pass='';
		//$salt = "abcdefghjklmnpqrstuvwxyz";
		//$uppercase = "ABCDEFGHJKLMNPQRSTUVWXYZ";
		$salt = "abcdefghjklm"; //
		$uppercase = "npqrstuvwxyz";
		$numbers   = "123456789";
			if ($upper) $salt .= $uppercase;
			if ($number) $salt .= $numbers;
			
			srand((double)microtime()*1000000);
			$i = 0;
				while ($i <= $len) {
				$num = rand(111,999) % strlen($salt);
				$tmp = substr($salt, $num, 1);
				$pass = $pass . $tmp;
				$i++;
				}
			return $pass;
	}
	
	
	
	$imageTypeArray = array
     (
         0=>'UNKNOWN',
         1=>'GIF',
         2=>'JPG',
         3=>'PNG',
         4=>'SWF',
         5=>'PSD',
         6=>'BMP',
         7=>'TIFF',
         8=>'TIFF',
         9=>'JPC',
         10=>'JP2',
         11=>'JPX',
         12=>'JB2',
         13=>'SWC',
         14=>'IFF',
         15=>'WBMP',
         16=>'XBM',
         17=>'ICO',
         18=>'COUNT'  
     );
?>