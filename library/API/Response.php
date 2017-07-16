<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 3/16/17
 * Time: 6:40 PM
 */

namespace library\API;


class Response extends AbstractHttp
{
    public function __construct(Request $request = NULL,
                                $status = NULL, $contentType = NULL)
    {
        if ($request) {
            $this->uri = $request->getUri();
            $this->data = $request->getData();
            $this->method = $request->getMethod();
            $this->cookies = $request->getCookies();
            $this->setTransport();
        }
        $this->processHeaders($contentType);
        if ($status) {
            $this->setStatus($status);
        }
    }
    protected function processHeaders($contentType)
    {
        if (!$contentType) {
            $this->setHeaderByKey(self::HEADER_CONTENT_TYPE,
                self::CONTENT_TYPE_JSON);
        } else {
            $this->setHeaderByKey(self::HEADER_CONTENT_TYPE,
                $contentType);
        }
    }

    protected function processResponse($response)
    {
        if ($response->getHeaders()) {
            foreach ($response->getHeaders() as $key => $value) {
                header($key . ': ' . $value, TRUE,
                    $response->getStatus());
            }
        }
        header(Request::HEADER_CONTENT_TYPE
            . ': ' . Request::CONTENT_TYPE_JSON, TRUE);
        if ($response->getCookies()) {
            foreach ($response->getCookies() as $key => $value) {
                setcookie($key, $value);
            }
        }
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
    public function getStatus()
    {
        return $this->status;
    }
}