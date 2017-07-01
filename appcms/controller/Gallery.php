<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 3/23/17
 * Time: 8:10 AM
 */

namespace AppCMS\Controller;
use core\Config;
use core\Controller;
use core\View;
use library\Models\SiteKeyWordsModel;

class Gallery extends Controller
{
    public $username,
        $keyword_type = Config::CPANEL_PAGES_KEYWORDS,
        $getSiteKeywords,
        $siteKeywords;

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
    }

    /**
     * After filter which could potentially be good for destroying sessions
     *
     * @return void
     */
    protected function after(){}

    /**
     * Show the index page
     * @return void
     */
    public function indexAction()
    {
        //echo 'User index on User Page<br>';
        View::renderTemplate('gallery/index.phtml', [
            'tabtitle' => 'Gallery',
            'pageTitle' => 'Gallery',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'cPanel',
            'addgallery' => Config::APP_CMS_GALLERY_ADD_PAGE_PRETTY_URI,
            'editgallery' => Config::APP_CMS_GALLERY_EDIT_PAGE_PRETTY_URI,
            'deletegallery' => Config::APP_CMS_GALLERY_DELETE_PAGE_PRETTY_URI,
            'indexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');


    }

    /**
     * Show the index page
     * @return void
     */
    public function addgalleryAction()
    {
        //echo 'User index on User Page<br>';
        View::renderTemplate('gallery/addgallery.phtml', [
            'tabtitle' => 'Add Gallery',
            'pageTitle' => 'Add Gallery',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'Gallery',
            'indexpage' => Config::APP_CMS_GALLERY_INDEX_PAGE_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');


    }

    /**
     * Show the index page
     * @return void
     */
    public function editgalleryAction()
    {
        //echo 'User index on User Page<br>';
        View::renderTemplate('gallery/editgallery.phtml', [
            'tabtitle' => 'Edit Gallery',
            'pageTitle' => 'Edit Gallery',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'Gallery',
            'indexpage' => Config::APP_CMS_GALLERY_INDEX_PAGE_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');


    }

    /**
     * Show the index page
     * @return void
     */
    public function deletegalleryAction()
    {
        //echo 'User index on User Page<br>';
        View::renderTemplate('gallery/deletegallery.phtml', [
            'tabtitle' => 'Delete Gallery',
            'pageTitle' => 'Delete Gallery',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'Gallery',
            'indexpage' => Config::APP_CMS_GALLERY_INDEX_PAGE_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');

    }

}