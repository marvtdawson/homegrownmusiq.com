<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 12/13/16
 * Time: 1:28 AM
 */

namespace App\Controller;
use core\Config;
use core\Controller;
use core\View;
use appcms\controller\Userprofile;
use library\Models\CorePagesModel;
use library\Models\SiteKeyWordsModel;

class Vlog extends Controller
{
    public $displaypagecontent,
        $userLogin,
        $username,
        $getpagecontent,
        $siteContent,
        $getSiteKeywords,
        $siteKeywords,
        $core_page_number = 1127,
        $keyword_type = Config::CORE_PAGES_KEYWORDS;

    public function __construct(array $route_params)
    {
        parent::__construct($route_params);
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

        $this->getPageContent = new CorePagesModel();
        $this->getPageContent->find($this->core_page_number);
        $this->siteContent = $this->getPageContent->data()->corePages_Content;

        $loggedInUserName = new Userprofile();
        $this->username = $loggedInUserName->userName;
        $this->userLogin = $loggedInUserName->checkLoggedInUser();
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
        View::renderTemplate('vlog.phtml', [
            'tabTitle' => 'Vlog',
            'pageTitle' => 'Vlog',
            'siteName' => $this->siteName,
            'username' =>  $this->username,
            'userLogin' => $this->userLogin,
            'pageContent' => $this->siteContent,
            'siteKeywords' => $this->siteKeywords,
            'processBlogForm' => '/subscribe/process',
            'submitbutton' => 'SUBSCRIBE',
        ]);
    }

}