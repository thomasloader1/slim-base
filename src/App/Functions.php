<?php

use Jenssegers\Blade\Blade;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\UploadedFileInterface;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function view(Response $response, $template, $with){
    $cache = __DIR__. '/../Cache';
    $views = __DIR__. '/../Views';
    
    $blade = (new Blade($views,$cache))->make($template,$with);
    $response->getBody()->write($blade->render());
    return $response;
}

function fetchView($template, $with){
    $cache = __DIR__. '/../Cache';
    $views = __DIR__. '/../Views';
    
    $blade = (new Blade($views,$cache))->make($template,$with);
    // $response->getBody()->write($blade->render());
    return $blade->render();
}

function siteUrl($url) {
    global $app;
    
    $basePath = $app->getBasePath();
    return $basePath . '/' . ltrim($url, '/');
}

function br2nl($string){
    $newlineTags = array(
        '<br>',
        '<br/>',
        '<br />',
      );
    return str_replace($newlineTags, PHP_EOL, $string);
}

function getYouTubeID($string){
    // $url = "www.youtube.com/cCnrX1w5luM";

    $regex_pattern = "/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/";
    $match;
    
    if(preg_match($regex_pattern, $string, $match)){
        
        return $match[4];
    }else{
        
        return '';
    }
}

function getYouTubeLinkFromID($id){
    return strlen($id)>0 ? 'https://www.youtube.com/watch?v='.$id : '';
}

function makePrettyUrl($id,$title){
    $string = $id."-";
    $string = $string.url_slug($title, array('transliterate' => true));
    return mb_substr($string, 0, 50);;
}

function moveUploadedFile(string $directory, UploadedFileInterface $uploadedFile, $changeName=true)
{
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);

	// see http://php.net/manual/en/function.random-bytes.php
	if($changeName){
		$basename = bin2hex(random_bytes(8));
		$filename = sprintf('%s.%0.8s', $basename, $extension);
	}else{
		$filename = $uploadedFile->getClientFilename();
	}
    $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

    return $filename;
}

function hexToRgb($hex, $alpha = false) {
	$hex      = str_replace('#', '', $hex);
	$length   = strlen($hex);
	$rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
	$rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
	$rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
	if ( $alpha ) {
	   $rgb['a'] = $alpha;
	}
	return (object)$rgb;
}

function url_slug($str, $options = array()) {
	// Make sure string is in UTF-8 and strip invalid UTF-8 characters
	$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
	
	$defaults = array(
		'delimiter' => '-',
		'limit' => null,
		'lowercase' => true,
		'replacements' => array(),
		'transliterate' => true,
	);
	
	// Merge options
	$options = array_merge($defaults, $options);
	
	$char_map = array(
		// Latin
		'??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'AE', '??' => 'C', 
		'??' => 'E', '??' => 'E', '??' => 'E', '??' => 'E', '??' => 'I', '??' => 'I', '??' => 'I', '??' => 'I', 
		'??' => 'D', '??' => 'N', '??' => 'O', '??' => 'O', '??' => 'O', '??' => 'O', '??' => 'O', '??' => 'O', 
		'??' => 'O', '??' => 'U', '??' => 'U', '??' => 'U', '??' => 'U', '??' => 'U', '??' => 'Y', '??' => 'TH', 
		'??' => 'ss', 
		'??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'ae', '??' => 'c', 
		'??' => 'e', '??' => 'e', '??' => 'e', '??' => 'e', '??' => 'i', '??' => 'i', '??' => 'i', '??' => 'i', 
		'??' => 'd', '??' => 'n', '??' => 'o', '??' => 'o', '??' => 'o', '??' => 'o', '??' => 'o', '??' => 'o', 
		'??' => 'o', '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'y', '??' => 'th', 
		'??' => 'y',

		// Latin symbols
		'??' => '(c)',

		// Greek
		'??' => 'A', '??' => 'B', '??' => 'G', '??' => 'D', '??' => 'E', '??' => 'Z', '??' => 'H', '??' => '8',
		'??' => 'I', '??' => 'K', '??' => 'L', '??' => 'M', '??' => 'N', '??' => '3', '??' => 'O', '??' => 'P',
		'??' => 'R', '??' => 'S', '??' => 'T', '??' => 'Y', '??' => 'F', '??' => 'X', '??' => 'PS', '??' => 'W',
		'??' => 'A', '??' => 'E', '??' => 'I', '??' => 'O', '??' => 'Y', '??' => 'H', '??' => 'W', '??' => 'I',
		'??' => 'Y',
		'??' => 'a', '??' => 'b', '??' => 'g', '??' => 'd', '??' => 'e', '??' => 'z', '??' => 'h', '??' => '8',
		'??' => 'i', '??' => 'k', '??' => 'l', '??' => 'm', '??' => 'n', '??' => '3', '??' => 'o', '??' => 'p',
		'??' => 'r', '??' => 's', '??' => 't', '??' => 'y', '??' => 'f', '??' => 'x', '??' => 'ps', '??' => 'w',
		'??' => 'a', '??' => 'e', '??' => 'i', '??' => 'o', '??' => 'y', '??' => 'h', '??' => 'w', '??' => 's',
		'??' => 'i', '??' => 'y', '??' => 'y', '??' => 'i',

		// Turkish
		'??' => 'S', '??' => 'I', '??' => 'C', '??' => 'U', '??' => 'O', '??' => 'G',
		'??' => 's', '??' => 'i', '??' => 'c', '??' => 'u', '??' => 'o', '??' => 'g', 

		// Russian
		'??' => 'A', '??' => 'B', '??' => 'V', '??' => 'G', '??' => 'D', '??' => 'E', '??' => 'Yo', '??' => 'Zh',
		'??' => 'Z', '??' => 'I', '??' => 'J', '??' => 'K', '??' => 'L', '??' => 'M', '??' => 'N', '??' => 'O',
		'??' => 'P', '??' => 'R', '??' => 'S', '??' => 'T', '??' => 'U', '??' => 'F', '??' => 'H', '??' => 'C',
		'??' => 'Ch', '??' => 'Sh', '??' => 'Sh', '??' => '', '??' => 'Y', '??' => '', '??' => 'E', '??' => 'Yu',
		'??' => 'Ya',
		'??' => 'a', '??' => 'b', '??' => 'v', '??' => 'g', '??' => 'd', '??' => 'e', '??' => 'yo', '??' => 'zh',
		'??' => 'z', '??' => 'i', '??' => 'j', '??' => 'k', '??' => 'l', '??' => 'm', '??' => 'n', '??' => 'o',
		'??' => 'p', '??' => 'r', '??' => 's', '??' => 't', '??' => 'u', '??' => 'f', '??' => 'h', '??' => 'c',
		'??' => 'ch', '??' => 'sh', '??' => 'sh', '??' => '', '??' => 'y', '??' => '', '??' => 'e', '??' => 'yu',
		'??' => 'ya',

		// Ukrainian
		'??' => 'Ye', '??' => 'I', '??' => 'Yi', '??' => 'G',
		'??' => 'ye', '??' => 'i', '??' => 'yi', '??' => 'g',

		// Czech
		'??' => 'C', '??' => 'D', '??' => 'E', '??' => 'N', '??' => 'R', '??' => 'S', '??' => 'T', '??' => 'U', 
		'??' => 'Z', 
		'??' => 'c', '??' => 'd', '??' => 'e', '??' => 'n', '??' => 'r', '??' => 's', '??' => 't', '??' => 'u',
		'??' => 'z', 

		// Polish
		'??' => 'A', '??' => 'C', '??' => 'e', '??' => 'L', '??' => 'N', '??' => 'o', '??' => 'S', '??' => 'Z', 
		'??' => 'Z', 
		'??' => 'a', '??' => 'c', '??' => 'e', '??' => 'l', '??' => 'n', '??' => 'o', '??' => 's', '??' => 'z',
		'??' => 'z',

		// Latvian
		'??' => 'A', '??' => 'C', '??' => 'E', '??' => 'G', '??' => 'i', '??' => 'k', '??' => 'L', '??' => 'N', 
		'??' => 'S', '??' => 'u', '??' => 'Z',
		'??' => 'a', '??' => 'c', '??' => 'e', '??' => 'g', '??' => 'i', '??' => 'k', '??' => 'l', '??' => 'n',
		'??' => 's', '??' => 'u', '??' => 'z'
	);
	
	// Make custom replacements
	$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
	
	// Transliterate characters to ASCII
	if ($options['transliterate']) {
		$str = str_replace(array_keys($char_map), $char_map, $str);
	}
	
	// Replace non-alphanumeric characters with our delimiter
	$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
	
	// Remove duplicate delimiters
	$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
	
	// Truncate slug to max. characters
	$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
	
	// Remove delimiter from ends
	$str = trim($str, $options['delimiter']);
	
	return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}

function randomKey($length) {
	$pool = array_merge(range(0,9), range('a', 'k'),range('m', 'z'),range('A', 'H'),range('J', 'Z'));
	$key = '';
	for($i=0; $i < $length; $i++) {
		$key .= $pool[mt_rand(0, count($pool) - 1)];
	}
	return $key;
}

function sendMail($address,$name,$body,$subject){

	$mail = new PHPMailer(true);
	try {
		//Server settings
		$mail->SMTPDebug = false;                      // Enable verbose debug output
		// $mail->isSMTP();                                            // Send using SMTP
		$mail->Host       = 'mail.ruralsalliquelo.com';                    // Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail->Username   = 'no-reply@ruralsalliquelo.com';                     // SMTP username
		$mail->Password   = 'ARSalli2020';                               // SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

		//Recipients
		$mail->setFrom('contacto@ruralsalliquelo.com.ar', 'Asociaci??n Rural Salliquel??');
		$mail->addAddress($address, $name);
		$mail->addBCC('nicolas@antejosnegros.com');
		
		// Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = $subject;
		$mail->Body    = $body;
		$mail->CharSet = 'UTF-8';
		

		$mail->send();
		// echo 'Message has been sent';
	} catch (Exception $e) {
		$result['error'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		return $result;
	}
	$result['message']='Message has been sent';
	return $result;
}
function addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}


function thumb_makethumb($medida, $archivo, $origen, $destino) { 
	$th_max_width = $medida; 
	$carpeta_origen = $origen;
	$carpeta_destino = $destino;

	if(strpos($archivo, $origen) !== false){
		$archivo = str_replace($origen,'',$archivo);
	}
	
	if(!file_exists($carpeta_destino.$archivo)) {
	
		$img_ext=substr(strrchr($archivo,"."),1);
		 
	
		// Make temporary file name and location a variable 
		$temp_file_name = $carpeta_origen.$archivo; 
		
		// Get image attributes of temporary file 
		$image_attribs = getimagesize($temp_file_name); 
		
		// Make temporary file a resource 
		if($img_ext=="jpg" OR $img_ext=="JPG" OR $img_ext=="JPEG" OR $img_ext=="jpeg")
			{ 
			$im_temp = imagecreatefromjpeg($temp_file_name); 
			} 
		elseif($img_ext == "gif") 
			{ 
			$im_temp = imagecreatefromgif($temp_file_name); 
			$blanco=imagecolorallocate ($im_temp, 255, 255, 255);
			Imagefill ($im_temp, 0, 0, $blanco); 
	
			}elseif(($img_ext == "png") || ($img_ext == "PNG" ) ){
				return  $origen.$archivo;
			}
	   
		$proportion=$image_attribs[0]/$th_max_width;
		 
		
		// Scale to max width/height using ratio 
		$th_width = $image_attribs[0] / $proportion; 
		$th_height = $image_attribs[1] /$proportion; 
		
		
		// Create a true colour image and use anti-aliasing 
		$im_new = imagecreatetruecolor($th_width,$th_height); 
		imageantialias($im_new,true); 
	
		// Set thumb folder and file name 
		$th_file_name = $carpeta_destino.$archivo ; 
		
		// And copy the original image resized onto the new thumbnail. 
		imagecopyresampled($im_new,$im_temp,0,0,0,0,$th_width,$th_height, $image_attribs[0], $image_attribs[1]); 
	
		
		
		if($img_ext=="GIF" OR $img_ext=="gif"){
		imagegif($im_new,$th_file_name,90);
		}
		if($img_ext=="jpg" OR $img_ext=="JPG" OR $img_ext=="JPEG" OR $img_ext=="jpeg"){
		imagejpeg($im_new,$th_file_name,90);
		}
		// Clean up image resource 
		imagedestroy($im_new); 
		return $th_file_name;
	
	
	} else {
		
		return $carpeta_destino.$archivo;
		
	}
	
	} 