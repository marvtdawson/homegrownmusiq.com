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
        $artistMusicPath,
        $artistMusic;

    public function __construct()
    {
        $loggedInUserName = new Userprofile();
        $this->username = $loggedInUserName->getLoggedInUserInfo()->regMem_Name;
        $this->userId =  $loggedInUserName->getLoggedInUserInfo()->id;
    }

    public function setPath($path){

        // removes the trailing '/' on the image path
        if(substr($path, -1) === '/'){
            $path = substr($path, 0, -1);
        }
    }

    /**
     * @param $path
     * @return array
     */
    private function getDirectory($path){
        return $path;
    }

    public function getMusic($path, $extensions = array('mp3', 'ogg', 'wav')){

        if($path !== null ){

            echo 'You have a path! ' . $path;

            $artistMusic = $this->getDirectory($path); // array
            $this->artistMusicPath = $path;

            foreach($this->artistMusicPath as $index => $music){

                $extension = explode('.', $music);
                $musicFile_ext = strtolower(end($extension));

                if(!in_array($musicFile_ext, $extensions)){
                    unset($this->artistMusicPath[$index]);
                }else{
                    $this->artistMusic[$index] = array(
                        'full' => $path . '/' . $music,
                        //'thumb' => $path . '/' . $music
                    );
                }
            }
        }else{
            echo 'No Path Marvo you still fucked!';
        }
        // check if there are images before outputting
        return (count($this->artistMusic)) ? $this->artistMusic : false;
    }

}