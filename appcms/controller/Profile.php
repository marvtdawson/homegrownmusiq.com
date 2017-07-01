<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 4/5/17
 * Time: 11:47 PM
 */

namespace appcms\controller;
use core\Config;
use core\Controller;
use core\View;
use library\Models\Model;
use library\Models\SiteKeyWordsModel;
use library\Form\Input;
use library\Controller\Redirect;
use PDOException;
use library\Gallery\GalleryAbstract;
use library\Music\MusicAbstract;
use Twig_Environment;
use Twig_SimpleFunction;


class Profile extends Controller
{
    private $_db;

    public $regSuccess,
        $username,
        $userLogin,
        $userId,
        $currUser,
        $curruserInfo,
        $key,
        $memberPermissions,
        $keyword_type = Config::CPANEL_PAGES_KEYWORDS,
        $getSiteKeywords,
        $siteKeywords,
        $getContactEntries,
        $entry,
        $formEntry,
        $loggedInUserName,
        $billboard,
        $billboardType = 'profile-billboard',
        $billboardImage,
        $thumbProfile,
        $thumbnailType = 'profile-thumbnail',
        $parentUrl,
        $hgmDomain,
        $hgmRelPath,
        $slide_dir,
        $checkImage,
        $slideFile,
        $slideFileExt,
        $slideShowImages,
        $uploadOk,
        $slideTempName,
        $slideOrigName,
        $cdCoverImages,
        $cdCoverFileName,
        $cdCoverImagesDir,
        $artistMusicProjectsDir,
        $errMsg;

    public function __construct()
    {
        // connect to db
        $this->_db = Model::getInstance();

    }


    /**
     * Before filter which is useful for login authentication
     *
     * @return void
     */
    protected function before()
    {
        $this->siteName = parent::getSiteName();

        $this->getSiteKeywords = new SiteKeyWordsModel();
        $this->getSiteKeywords->find($this->keyword_type);
        $this->siteKeywords = $this->getSiteKeywords->data()->pages_Keywords;

        $loggedInUserName = new Userprofile();
        $this->username = $loggedInUserName->getLoggedInUserInfo()->regMem_Name;
        $this->userId =  $loggedInUserName->getLoggedInUserInfo()->id;

        //$this->slideShowImages = new SlideShowModel();
        // get billboard image
        //$this->slideShowImages->find($this->billboardType);
        //$this->billboardImage = $this->slideShowImages->data()->slide_Image_Status;
        //echo $this->billboardImage;

        $this->billboard = '../../assets/m3Mb3rz/' . $this->userId . '/images/billboard/default.jpg';
        $this->thumbProfile = '../../assets/m3Mb3rz/' . $this->userId . '/images/thumbs/default.jpg';

        // set path to music tracks and thumb images
        $this->cdCoverImagesDir = Config::MEMBER_ASSET_FILE_DIR . $this->userId . '/media/music/projects/thumbs/';
        $this->artistMusicProjectsDir = Config::MEMBER_ASSET_FILE_DIR . $this->userId . '/media/music/projects';

        //$this->hgmDomain = getenv('HTTP_HOST');
        //$this->hgmRelPath = '../public_html/' . $this->hgmDomain;
        //$this->parentUrl = '../public_html/';

    }

    /**
     * After filter
     *
     * @return void
     */
    protected function after()
    {
        //echo " (after)";
    }


    public function indexAction()
    {
        echo $this->cdCoverImagesDir . "<br>";
        echo $this->artistMusicProjectsDir . '<br>';

        View::renderTemplate('memberprofile/index.phtml', [
            'tabTitle' => 'Member Profile',
            'pageTitle' => 'Member Profile',
            'pageDescription' => 'Member Profile Page',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'billboardFormName' => 'upload_profile_billboard_image',
            'thumbFormName' => 'upload_profile_thumb_image',
            'processBillboardForm' => '/appcms/profile/uploadbillboard',
            'processThumbnailForm' => '/appcms/profile/uploadthumbnail',
            'submitbutton' =>  Config::REGISTER_FORM_SUBMIT_BUTTON,
            'userReg' => $this->regSuccess,
            'username' =>  $this->username,
            'userLogin' => $this->userLogin,
            'userId' => $this->userId,
            'billboard' => $this->billboard,
            'thumbProfile' => $this->thumbProfile,
            'siteUrl' => $this->hgmRelPath,
            'cdThumbCovers' => $this->getCdCoversAction(),
            'artistMusicTracks' => $this->getArtistProjectsAction(),
            'stepsToOwn' => 'step2Completed',
            //'errorMsg' => $this->uploadthumbnailAction()->errMsg,
        ]);
    }

    /**
     * upload new billboard image function
     */
    public function uploadbillboard(){

        $this->loggedInUserName = new Userprofile();
        $this->username = $this->loggedInUserName->getLoggedInUserInfo()->regMem_Name;
        $this->userId =  $this->loggedInUserName->getLoggedInUserInfo()->id;

        // add billboard
        // check if the input data via post or get method existt
        if(Input::exists()) {

            // get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

                $this->slide_dir =  '../public/assets/m3Mb3rz/' . $this->userId . '/images/billboard/';
                $this->slideFile = $this->slide_dir . basename($_FILES["upload_profile_billboard_image"]["name"]);
                //echo $this->slideFile . '<br >';

                $this->slideFileExt = pathinfo($this->slideFile, PATHINFO_EXTENSION);
                //echo 'This file ext is: ' . $this->slideFileExt . '<br >';

                $this->checkImage = mime_content_type($_FILES["upload_profile_billboard_image"]["tmp_name"]);
                //echo 'This image type is: ' . $this->checkImage . '<br >';

                // 1. check if image being upload is the right formatted mime type / image
                if($this->checkImage !== 'image/jpg' ||
                    $this->checkImage !== 'image/jpeg' ||
                    $this->checkImage !== 'image/JPEG' ||
                    $this->checkImage !== 'image/png' ||
                    $this->checkImage !== 'image/gif'){
                    // redirect or display modal
                    //echo "Wrong file type was attempted to upload<br>";
                    $this->uploadOk = 0;
                }

                // 2. check if file already exists
                if (file_exists($this->slideFile)) {
                    echo "Sorry, file already exists.<br>";
                    $this->uploadOk = 0;
                }

                // 3. file size
                if ($_FILES["upload_profile_billboard_image"]["size"] > 500000) {
                    echo "Sorry, your file is too large.<br>";
                    $this->uploadOk = 0;
                }

                // 4. check file extension
                /*if($this->slideFileExt){
                    if($this->slideFileExt !== 'jpg'){
                        echo 'This is not a jpg. <br>';
                    }
                    if($this->slideFileExt !== 'jpeg'){
                        echo 'This is not a jpeg. <br>';
                    }
                    if($this->slideFileExt !== 'JPEG'){
                        echo 'This is not a JPEG. <br>';
                    }
                    if($this->slideFileExt !== 'png'){
                        echo 'This is not a PNG. <br>';
                    }
                    if($this->slideFileExt !== 'gif'){
                        echo 'This is not a GiF. <br>';
                    }
                  }*/

                // 5. move file to upload
                if($this->uploadOk === 1){
                    echo "Sorry, your file was not uploaded.";
                }elseif($this->uploadOk === 0){

                    if (move_uploaded_file($_FILES["upload_profile_billboard_image"]["tmp_name"], $this->slideFile)) {

                        // set vars for slide names
                        $this->slideTempName =  $_FILES["upload_profile_billboard_image"]["tmp_name"];
                        $this->slideOrigName =  $_FILES["upload_profile_billboard_image"]["name"];

                        try {
                            $this->_db->insert('syst3mSlid3sz', array(  // update user member profile billboard in table
                                'hgm_Member_Id' => $this->userId,
                                'slide_Type' => 'profile-billboard',
                                'slide_Tmp_Name' => $this->slideTempName,
                                'slide_Orig_Name' => $this->slideOrigName,
                                'slide_Image_Status' => 'default',
                                'slide_Date' => date('M d, Y'),
                            ));
                            //echo "The file ". basename( $_FILES["upload_profile_image"]["name"]). " has been uploaded.";
                            Redirect::to('/appcms/profile/index');
                        }
                        catch (PDOException $e) {
                            die($e->getMessage());
                        }
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
           // } // csrf token exists
        }
    }

    /**
     * upload new profile image function
     */
    public function uploadthumbnailAction(){
        $this->loggedInUserName = new Userprofile();
        $this->username = $this->loggedInUserName->getLoggedInUserInfo()->regMem_Name;
        $this->userId =  $this->loggedInUserName->getLoggedInUserInfo()->id;

        // add billboard
        // check if the input data via post or get method existt
        if(Input::exists()) {

            // get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

            $this->slide_dir =  '../public/assets/m3Mb3rz/' . $this->userId . '/images/thumbs/';
            $this->slideFile = $this->slide_dir . basename($_FILES["upload_profile_thumb_image"]["name"]);
            //echo $this->slideFile . '<br >';

            $this->slideFileExt = pathinfo($this->slideFile, PATHINFO_EXTENSION);
            //echo 'This file ext is: ' . $this->slideFileExt . '<br >';

            $this->checkImage = mime_content_type($_FILES["upload_profile_thumb_image"]["tmp_name"]);
            //echo 'This image type is: ' . $this->checkImage . '<br >';

            // 1. check if image being upload is the right formatted mime type / image
            if($this->checkImage !== 'image/jpg' ||
                $this->checkImage !== 'image/jpeg' ||
                $this->checkImage !== 'image/JPEG' ||
                $this->checkImage !== 'image/png' ||
                $this->checkImage !== 'image/gif'){
                // redirect or display modal
                //echo "Wrong file type was attempted to upload<br>";
                $this->uploadOk = 0;
            }

            // 2. check if file already exists
            if (file_exists($this->slideFile)) {

                $this->uploadOk = 0;

                $this->errMsg = "Sorry, file already exists.<br>";
                //echo "Sorry, file already exists.<br>";

                echo $this->errMsg;
            }

            // 3. file size
            if ($_FILES["upload_profile_thumb_image"]["size"] > 500000) {

                $this->errMsg = "Sorry, your file is too large.<br>";

                //echo "Sorry, your file is too large.<br>";
                $this->uploadOk = 0;

                echo $this->errMsg;
            }

            // 4. check file extension
            /*if($this->slideFileExt){
                if($this->slideFileExt !== 'jpg'){
                    echo 'This is not a jpg. <br>';
                }
                if($this->slideFileExt !== 'jpeg'){
                    echo 'This is not a jpeg. <br>';
                }
                if($this->slideFileExt !== 'JPEG'){
                    echo 'This is not a JPEG. <br>';
                }
                if($this->slideFileExt !== 'png'){
                    echo 'This is not a PNG. <br>';
                }
                if($this->slideFileExt !== 'gif'){
                    echo 'This is not a GiF. <br>';
                }
              }*/

            // 5. move file to upload
            if($this->uploadOk === 1){
                echo "Sorry, your file was not uploaded.";
            }elseif($this->uploadOk === 0){

                // set vars for slide names
                $this->slideTempName =  $_FILES["upload_profile_thumb_image"]["tmp_name"];
                $this->slideOrigName =  $_FILES["upload_profile_thumb_image"]["name"];

                if (move_uploaded_file($_FILES["upload_profile_thumb_image"]["tmp_name"], $this->slideFile)) {

                    /*try {
                        $this->_db->insert('syst3mSlid3sz', array(  // update user member profile billboard in table
                            'hgm_Member_Id' => $this->userId,
                            'slide_Type' => 'profile-billboard',
                            'slide_Tmp_Name' => $this->slideTempName,
                            'slide_Orig_Name' => $this->slideOrigName,
                            'slide_Image_Status' => 'default',
                            'slide_Date' => date('M d, Y'),
                        ));

                        // after upload

                        Redirect::to('/appcms/profile/index');
                    }
                    catch (PDOException $e) {
                        die($e->getMessage());
                    }*/
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
            // } // csrf token exists
        }
    }


    /**
     * get music cd covers
     */
    public function getCdCoversAction()
    {
        // get gallery object
        $memberThumbGallery = new GalleryAbstract();
        $memberThumbGallery->setPath($this->cdCoverImagesDir);

        $thumbImages = $memberThumbGallery->getImages($this->cdCoverImagesDir, array('jpg'));
        return $thumbImages;
    }

    /**
     * @return array|bool
     * get music project lists
     */
    public function getArtistProjectsAction(){

        // get artist music projects
        $artistMusicProjects = new MusicAbstract();
        $artistMusicProjects->setPath($this->artistMusicProjectsDir);

        $artistMusicTrack = $artistMusicProjects->getMusic($this->artistMusicProjectsDir, array('mp3'));
        echo '<pre>', print_r($artistMusicTrack), '</pre>';
        return $artistMusicTrack;
    }

}