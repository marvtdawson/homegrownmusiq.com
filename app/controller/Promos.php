<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 5/19/17
 * Time: 2:58 PM
 */

namespace app\controller;

use core\Controller;
use core\View;
use core\Config;
use library\Models\CorePagesModel;
use library\Models\SiteKeyWordsModel;
use appcms\controller\Userprofile;


class Promos extends Controller
{
    public $display_page_content,
        $get_page_content,
        $core_page_number = 1138,
        $keyword_type = Config::CORE_PAGES_KEYWORDS,
        $getSiteKeywords,
        $siteName,
        $siteContent,
        $username,
        $userLogin;

    public function __construct(array $route_params)
    {
        parent::__construct($route_params);
    }


    /**
     * Before filter which is useful for login authentication
     * session control and cookies
     *
     * @return void
     */
    protected function before()
    {
        $this->siteName = parent::getSiteName();

        $this->getSiteKeywords = new SiteKeyWordsModel();
        $this->getSiteKeywords->find($this->keyword_type);
        $this->siteKeywords = $this->getSiteKeywords->data()->pages_Keywords;

       /* $this->getPageContent = new CorePagesModel();
        $this->getPageContent->find($this->core_page_number);
        $this->siteContent = $this->getPageContent->data()->corePages_Content;*/

        $loggedInUserName = new Userprofile();
        $this->username = $loggedInUserName->userName;
        $this->userLogin = $loggedInUserName->checkLoggedInUser();

    }

    /**
     * After filter which could potentially be good for destroying sessions etc
     *
     * @return void
     */
    protected function after(){}


    public function indexAction()
    {
        View::renderTemplate('promos/index.phtml', [
            'tabTitle' => 'Promotions',
            //'pageTitle' => 'Promotions',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'pageDescription' => 'Promotions',
            'username' =>  $this->username,
            'userLogin' => $this->userLogin,
            //'pageContent' => $this->siteContent,
        ]);

    }

    public function ogkushAction()
    {
        View::renderTemplate('promos/ogkush.phtml', [
            'tabTitle' => 'First Step',
            //'pageTitle' => 'First Step',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'pageDescription' => 'First Step',
            'username' =>  $this->username,
            'userLogin' => $this->userLogin,
            //'pageContent' => $this->siteContent,
        ]);

    }

    public function ogkush_learn_howAction()
    {
        View::renderTemplate('promos/ogkush_learn_how.phtml', [
            'tabTitle' => 'OG Kush Free Web Hosting Promotion',
            'pageTitle' => 'OG Kush Free Web Hosting Promotion',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'pageDescription' => 'OG Kush Free Web Hosting Promotion',
            'username' =>  $this->username,
            'userLogin' => $this->userLogin,
            //'pageContent' => $this->siteContent,
        ]);

    }

    public function testfbAction()
    {
        View::renderTemplate('promos/testfb.phtml', [
            'tabTitle' => 'OG Kush Free Web Hosting Promotion',
            //'pageTitle' => 'OG Kush Free Web Hosting Promotion',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'pageDescription' => 'OG Kush Promo aims at helping Independent Hip Hop Artist getting started with the music career',
            'fbOGUrl' => 'http://www.homegrownmusiq.com/promos/testfb',
            'fbOGType' => 'website',
            'fbOGTitle' => 'Hip Hop Artist OG Kush Free Website',
            'fbOGDescription' => 'OG Kush Promo aims at helping Independent Hip Hop Artist getting started with the music career.',
            'fbOGImage' => 'http://www.homegrownmusiq.com/assets/images/promos/grown_home_grown_dope_base_1200_x_650.jpg',
            'username' =>  $this->username,
            'userLogin' => $this->userLogin,
            //'pageContent' => $this->siteContent,
        ]);

    }



}