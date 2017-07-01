<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 2/20/17
 * Time: 7:34 AM
 */

namespace AppCMS\Controller;
use core\Config;
use core\Controller;
use core\View;
use library\Models\SiteKeyWordsModel;

class Video extends Controller
{

    public $username,
        $loggedInUserName,
        $keyword_type = Config::CPANEL_PAGES_KEYWORDS,
        $getSiteKeywords,
        $siteKeywords,
        $userYouTubeId,
        $html,
        $url;

    public function __construct(array $route_params)
    {
        parent::__construct($route_params);
    }

    /**
     * Before filter which is useful for login authentication
     *
     * @return void
     */
    protected function before(){
        $this->siteName = parent::getSiteName();

        $this->getSiteKeywords = new SiteKeyWordsModel();
        $this->getSiteKeywords->find($this->keyword_type);
        $this->siteKeywords = $this->getSiteKeywords->data()->pages_Keywords;

        $loggedInUserName = new Userprofile();
        $this->username = $loggedInUserName->getLoggedInUserInfo()->regMem_Name;
        $this->userId =  $loggedInUserName->getLoggedInUserInfo()->id;

        $this->userYouTubeId = 'UCM23pWsmebpMekjPMY_wcJA';
    }

    /**
     * After filter which could potentially be good for destroying sessions
     *
     * @return void
     */
    protected function after(){}

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('video/index.phtml', [
            'tabtitle' => 'Artist Video',
            'pageTitle' => 'Artist Video',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'cPanel',
            'indexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'addvideo' => Config::APP_CMS_ADD_VIDEO_PRETTY_URI,
            'editvideo' => Config::APP_CMS_EDIT_VIDEO_PRETTY_URI,
            'deletevideo' => Config::APP_CMS_DELETE_VIDEO_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');
    }

    public function addAction()
    {
        View::renderTemplate('video/addvideo.phtml', [
            'tabtitle' => 'Add video',
            'pageTitle' => 'Add video',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'Video',
            'indexpage' => Config::APP_CMS_VIDEO_INDEX_PRETTY_URI,
            'addvideo' => Config::APP_CMS_ADD_VIDEO_PRETTY_URI,
            'editvideo' => Config::APP_CMS_EDIT_VIDEO_PRETTY_URI,
            'deletevideo' => Config::APP_CMS_DELETE_VIDEO_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username,
            'showYouTubeStuff' => $this->url,
        ],  'appcms/views');

       /* $html = '';
        $url = 'https://www.youtube.com/feeds/videos.xml?channel_id=UCNtaDbQvj2i-6KN1araC3Hg';
        $url = 'https://www.youtube.com/feeds/videos.xml?channel_id=' . $this->userYouTubeId;
        $xml = simplexml_load_file($url);
        for($i = 0; $i < 10; $i++){

        }
        echo $this->url;*/
    }

    public function editAction()
    {
        View::renderTemplate('video/editvideo.phtml', [
            'tabtitle' => 'Edit video',
            'pageTitle' => 'Edit video',
            'siteName' => Config::SITE_NAME,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'cPanel',
            'indexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'addvideo' => Config::APP_CMS_ADD_VIDEO_PRETTY_URI,
            'editvideo' => Config::APP_CMS_EDIT_VIDEO_PRETTY_URI,
            'deletevideo' => Config::APP_CMS_DELETE_VIDEO_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');

    }

    public function deleteAction()
    {
        View::renderTemplate('video/deletevideo.phtml', [
            'tabtitle' => 'Delete video',
            'pageTitle' => 'Delete video',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'Video',
            'indexpage' => Config::APP_CMS_VIDEO_INDEX_PRETTY_URI,
            'addvideo' => Config::APP_CMS_ADD_VIDEO_PRETTY_URI,
            'editvideo' => Config::APP_CMS_EDIT_VIDEO_PRETTY_URI,
            'deletevideo' => Config::APP_CMS_DELETE_VIDEO_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');
    }


}