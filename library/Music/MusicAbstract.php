<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 5/31/17
 * Time: 1:29 AM
 */

namespace library\Music;
use appcms\controller\Userprofile;


class MusicAbstract
{
    public $path,
        $artistMusicPath;

    public function __construct()
    {
        $loggedInUserName = new Userprofile();
        $this->username = $loggedInUserName->getLoggedInUserInfo()->regMem_Name;
        $this->userId =  $loggedInUserName->getLoggedInUserInfo()->id;

        //$this->path = 'm3Mb3rz/'. $this->userId . '/media/music/projects/';

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
        return $path;
    }

    public function getMusic($path, $extensions = array('mp3', 'ogg', 'wav')){

        echo $path;
        $artistMusic = $this->getDirectory(scandir($path));

        foreach($artistMusic as $index => $music){

            $extension = explode('.', $music);
            $musicFile_ext = strtolower(end($extension));

            if(!in_array($musicFile_ext, $extensions)){
                unset($artistMusic[$index]);
            }else{
                $artistMusic[$index] = array(
                    'full' => $path . '/' . $music,
                    //'thumb' => $path . '/' . $music
                );
            }
        }
        // check if there are images before outputting
        return (count($artistMusic)) ? $artistMusic : false;
    }

}