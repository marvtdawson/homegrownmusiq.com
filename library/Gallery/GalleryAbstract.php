<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 4/4/17
 * Time: 4:30 PM
 */

namespace library\Gallery;
use appcms\controller\Userprofile;

class GalleryAbstract
{
    public $path,
           $slideImagesPath;

    public function __construct()
    {
        $loggedInUserName = new Userprofile();
        $this->username = $loggedInUserName->getLoggedInUserInfo()->regMem_Name;
        $this->userId =  $loggedInUserName->getLoggedInUserInfo()->id;

        $this->path = 'm3Mb3rz/'. $this->userId . '/media/music/projects/thumbs/';

    }

    public function setPath($path){

        // removes the trailing '/' on the image path
        if(substr($path, -1) === '/'){
            $path = substr($path, 0, -1);
        }
       //$this->path = $path;
    }

    /**
     * @param $path
     * @return array
     */
    private function getDirectory($path){

            return scandir($path);



    }

  public function getImages($path, $extensions = array('jpg', 'jpeg', 'JPEG', 'png')){

        $images = $this->getDirectory($path);

        foreach($images as $index => $image){

            $extension = explode('.', $image);
            $imageFile_ext = strtolower(end($extension));

            if(!in_array($imageFile_ext, $extensions)){
                unset($images[$index]);
            }else{
                $images[$index] = array(
                    //'full' => $this->path . '/' . $image,
                    'thumb' => $path  . $image
                );
            }
        }
        // check if there are images before outputting
        return (count($images)) ? $images : false;
    }

}