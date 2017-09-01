<?php 
namespace App\Http\Libraries;

//use Croppic as CroppicLib;
use Auth;
use File;
use Intervention\Image\ImageManagerStatic as Image;
use App\Newsfeed;
use App\Photo;
use App\Profiles;

class Croppic{

	protected $filename;
	protected $user_folder;
    protected $avatar_size_large = 200;
    protected $max_photo_height = 670;
    protected $max_photo_widht = 950;
	public function __construct()
	{
		//Auto execute in to init file or class

		//$this->filename = crypt(Auth::user()->id);
		$this->user_folder = $this->__GetUserFolder();
	}

	public function save()
	{
        $imagePath = $this->__GetUserFolder();
        if(is_array($imagePath)){
            $response['status'] = 'error';
            $response['message'] = $imagePath['message'];
            return $response;
        }
        $allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
        $temp = explode(".", $_FILES["img"]["name"]);
        $extension = end($temp);

        $_FILES["img"]["name"] = uniqid(rand()).".".$extension;
        //Check write Access to Directory

        if(!is_writable($imagePath)){
            $response = Array(
                "status" => 'error',
                "message" => 'Can`t upload File; no write Access'
            );
            print json_encode($response);
            return;
        }

        if ( in_array($extension, $allowedExts))
        {
            if ($_FILES["img"]["error"] > 0)
            {

                $response['status'] = 'error';
                switch ($_FILES["img"]["error"]){
                    case 1:
                    case 2:
                        $response["message"] = 'ERROR: The file exceeds the allowed size.';
                        break;
                    case 3:
                        $response["message"] = 'ERROR: The file was only partially uploaded.';
                        break;
                    case 4:
                        $response["message"] = 'ERROR: Not uploaded any file.';
                        break;
                    case 5:
                        $response["message"] = 'ERROR: Not uploaded any file.';
                        break;
                    case 6:
                        $response["message"] = 'ERROR: Missing temporary folder on the server.';
                        break;
                    case 7:
                        $response["message"] = 'ERROR: Could not write the file on the server.';
                        break;
                    default:
                        $response["message"] = 'There was an unknown error.';
                }
            }
            else
            {

                $filename = $_FILES["img"]["tmp_name"];
                list($width, $height) = getimagesize( $filename );

                move_uploaded_file($filename,  $imagePath . $_FILES["img"]["name"]);

                $response = array(
                    "status" => 'success',
                    "url" => $imagePath.$_FILES["img"]["name"],
                    "width" => $width,
                    "height" => $height
                );

            }
        }
        else
        {
            $response = array(
                "status" => 'error',
                "message" => 'something went wrong, most likely file is to large for upload. check upload_max_filesize, post_max_size and memory_limit in you php.ini',
            );
        }

        print json_encode($response);
	}

	public function crop()
	{
        /*
        *	!!! THIS IS JUST AN EXAMPLE !!!, PLEASE USE ImageMagick or some other quality image processing libraries
        */
        $imgUrl = $_POST['imgUrl'];
        // original sizes
        $imgInitW = $_POST['imgInitW'];
        $imgInitH = $_POST['imgInitH'];
        // resized sizes
        $imgW = $_POST['imgW'];
        $imgH = $_POST['imgH'];
        // offsets
        $imgY1 = $_POST['imgY1'];
        $imgX1 = $_POST['imgX1'];
        // crop box
        $cropW = $_POST['cropW'];
        $cropH = $_POST['cropH'];
        // rotation angle
        $angle = $_POST['rotation'];

        $jpeg_quality = 100;

        $folder = $this->__GetUserFolder();

        $subname_image      = rand();
        $large_name_image   = $folder."large_".$subname_image;
        $medium_name_image  = $folder."medium_".$subname_image;
        $small_name_image   = $folder."small_".$subname_image;

        $output_filename    = $large_name_image;

// uncomment line below to save the cropped image in the same location as the original image.
//$output_filename = dirname($imgUrl). "/croppedImg_".rand();

        $what = getimagesize($imgUrl);

        switch(strtolower($what['mime']))
        {
            case 'image/png':
                $img_r = imagecreatefrompng($imgUrl);
                $source_image = imagecreatefrompng($imgUrl);
                $type = '.png';
                break;
            case 'image/jpeg':
                $img_r = imagecreatefromjpeg($imgUrl);
                $source_image = imagecreatefromjpeg($imgUrl);
                error_log("jpg");
                $type = '.jpeg';
                break;
            case 'image/gif':
                $img_r = imagecreatefromgif($imgUrl);
                $source_image = imagecreatefromgif($imgUrl);
                $type = '.gif';
                break;
            default: die('image type not supported');
        }


//Check write Access to Directory

        if(!is_writable(dirname($output_filename))){
            $response = Array(
                "status" => 'error',
                "message" => 'Can`t write cropped File: '.$output_filename
            );
        }else{

            // resize the original image to size of editor
            $resizedImage = imagecreatetruecolor($imgW, $imgH);
            imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);
            // rotate the rezized image
            $rotated_image = imagerotate($resizedImage, -$angle, 0);
            // find new width & height of rotated image
            $rotated_width = imagesx($rotated_image);
            $rotated_height = imagesy($rotated_image);
            // diff between rotated & original sizes
            $dx = $rotated_width - $imgW;
            $dy = $rotated_height - $imgH;
            // crop rotated image to fit into original rezized rectangle
            $cropped_rotated_image = imagecreatetruecolor($imgW, $imgH);
            imagecolortransparent($cropped_rotated_image, imagecolorallocate($cropped_rotated_image, 0, 0, 0));
            imagecopyresampled($cropped_rotated_image, $rotated_image, 0, 0, $dx / 2, $dy / 2, $imgW, $imgH, $imgW, $imgH);
            // crop image into selected area
            $final_image = imagecreatetruecolor($cropW, $cropH);
            imagecolortransparent($final_image, imagecolorallocate($final_image, 0, 0, 0));
            imagecopyresampled($final_image, $cropped_rotated_image, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);
            // finally output png image
            //imagepng($final_image, $output_filename.$type, $png_quality);
            imagejpeg($final_image, $output_filename.$type, $jpeg_quality);
            //$intervention_image = new ImageManager(['driver'=>'imagick']);
            $make_image = Image::make($output_filename.$type);
            $resized_medium_image = $make_image->resize(200,200)->save($medium_name_image.$type);
            $resized_small_image = $make_image->resize(80,80)->save($small_name_image.$type);

            Photo::where([
                ['user_id'  , '=', Auth::user()->id],
                ['is_avatar', '=', true],
                ['status', '=', 1]
            ])->update(['is_avatar' => false]);
            $new_photo = new Photo();
            $new_photo->user_id = Auth::user()->id;
            $new_photo->is_avatar = true;
            $new_photo->original = $imgUrl;
            $new_photo->large = $output_filename.$type;
            $new_photo->medium = $medium_name_image.$type;
            $new_photo->small = $small_name_image.$type;
            $new_photo->privacy = '1';
            $new_photo->status = 1;
            $new_photo->save();

            $update_profile = Profiles::where('user_id',Auth::user()->id);
            $info_profile['avatar_photo_id'] = $new_photo->id;
            $update_profile->update($info_profile);

            $response = Array(
                "status"    => 'success',
                "url"       => $output_filename.$type,
                'medium'    => $medium_name_image.$type,
                'small'     => $small_name_image.$type
            );

            $feed = new Newsfeed();

            $feed->user_id   = Auth::user()->id;
            $feed->type      = 2;
            $feed->status    = 1;
            $feed->object    = $new_photo->id;

            $feed->save();
        }
        return json_encode($response);
	}

	public function create_photo($req)
    {
        $make_photo = Image::make($req->file_name);
        $current_folder = $this->__GetUserFolder();
        $subname_image      = rand();
        $original_name_image = $current_folder."original_".$subname_image;
        $large_name_image   = $current_folder."large_".$subname_image;
        $medium_name_image  = $current_folder."medium_".$subname_image;
        $small_name_image   = $current_folder."small_".$subname_image;
        $photo_height = $make_photo->height();
        $photo_widht = $make_photo->width();

        $resize_small   = 30;
        $resize_medium = 50;
        $resize_large = 75;

        $output_sizes = [
            'small'     => [
                'width' => $photo_widht*$resize_small/100,
                'height'=> $photo_height*$resize_small/100,
            ],
            'medium'    => [
                'width' => $photo_widht*$resize_medium/100,
                'height'=> $photo_height*$resize_medium/100,
            ],
            'large'     => [
                'width' => $photo_widht*$resize_large/100,
                'height'=> $photo_height*$resize_large/100,
            ]
        ];

        switch(strtolower($make_photo->mime()))
        {
            case 'image/png':
                $type = '.png';
                break;
            case 'image/jpeg':
                $type = '.jpeg';
                break;
            case 'image/gif':
                $type = '.gif';
                break;
            default: return ['status','error','message','image type not supported'];
        }
        if($photo_height > $this->max_photo_height && $photo_widht > $this->max_photo_widht){
            //$original = $make_photo->save($original_name_image.$type);

            $large = $make_photo->resize($output_sizes['large']['width'], $output_sizes['large']['height'], function ($constraint) {
                $constraint->aspectRatio();
            })->save($large_name_image.$type);

            $medium = $make_photo->fit(250, 250, function ($constraint) {
                $constraint->upsize();
            })->save($medium_name_image.$type);

            $small = $make_photo->fit(80, 80, function ($constraint) {
                $constraint->upsize();
            })->save($small_name_image.$type);
            $original_name_image = $large_name_image;
            $response = [
                'status'    => 'success',
                'original'  => $large_name_image.$type,
                'small'     => $small_name_image.$type,
                'medium'    => $medium_name_image.$type,
                'large'     => $large_name_image.$type
            ];
        }elseif($photo_height > $this->max_photo_height){
            $original = $make_photo->save($original_name_image.$type);

            $large = $make_photo->resize(null, $output_sizes['large']['height'], function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($large_name_image.$type);

            $medium = $make_photo->fit(250, 250, function ($constraint) {
                $constraint->upsize();
            })->save($medium_name_image.$type);

            $small = $make_photo->fit(80, 80, function ($constraint) {
                $constraint->upsize();
            })->save($small_name_image.$type);

            $response = [
                'status'    => 'success',
                'original'  => $original_name_image.$type,
                'small'     => $small_name_image.$type,
                'medium'    => $medium_name_image.$type,
                'large'     => $large_name_image.$type
            ];
        }else{
            $original = $make_photo->save($original_name_image.$type);

            $large = $make_photo->resize($output_sizes['large']['width'], null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($large_name_image.$type);

            $medium = $make_photo->fit(250, 250, function ($constraint) {
                $constraint->upsize();
            })->save($medium_name_image.$type);

            $small = $make_photo->fit(80, 80, function ($constraint) {
                $constraint->upsize();
            })->save($small_name_image.$type);

            $response = [
                'status'    => 'success',
                'original'  => $original_name_image.$type,
                'small'     => $small_name_image.$type,
                'medium'    => $medium_name_image.$type,
                'large'     => $large_name_image.$type
            ];
        }
        $new_photo = new Photo();
        $new_photo->user_id = Auth::user()->id;
        $new_photo->is_avatar = false;
        $new_photo->photo_origin = $original_name_image.$type;
        $new_photo->photo_large = $large_name_image.$type;
        $new_photo->photo_medium = $medium_name_image.$type;
        $new_photo->photo_small = $small_name_image.$type;
        //$new_photo->privacy = $req->privacy;
        $new_photo->photo_status = 1;
        $new_photo->save();

        /*$feed = new Newsfeed();

        $feed->user_id   = Auth::user()->id;
        $feed->type      = 1;
        $feed->status    = 1;
        $feed->object    = $new_photo->id;

        $feed->save();*/
        return [
            'status'    => 'success',
            'photo_id'  => \Hashids::encode($new_photo->id)
        ];
    }

	public static function __GetUserFolder()
	{
	    $public_folder = Auth::user()->profile->public_folder.date('Y-m-d').DS;
        $user_folder = PUBLIC_PATH.DS.Auth::user()->profile->public_folder.DS;
		$folder_exists = PUBLIC_PATH.DS.$public_folder;
        if(!is_dir($user_folder)){
            try{
                File::makeDirectory($user_folder);

                $index_file = PUBLIC_PATH.DS."users".DS."index.html";
                $new_index_file = $user_folder."index.html";
                if (!copy($index_file, $new_index_file)) {
                    $status = "Error al copiar $index_file...\n";
                }else{
                    $status = $folder_exists;
                }
            }catch(Exeption $e){
                $response['status'] = 'error';
                $response['messsage'] = 'Error with your images folder, please contact to admin';
                return $response;
            }
        }
        if(!is_dir($folder_exists)){
			try{
			    File::makeDirectory($folder_exists,0777);
				//File($folder_exists, 0777, TRUE);

				$index_file = PUBLIC_PATH.DS."users".DS."index.html";
				$new_index_file = $folder_exists."index.html";
				if (!copy($index_file, $new_index_file)) {
				    $status = "Error al copiar $index_file...\n";
				}else{
					$status = $folder_exists;
				}
			}catch(Exeption $e){
			    $status['status'] = 'error';
				$status['message'] = $e->getMessage();
			}
			return $status;
		}else{
		    return $public_folder;
        }
	}

}