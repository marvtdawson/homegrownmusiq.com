<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 3/16/17
 * Time: 4:58 PM
 *
 * This class reflects the fact that we are
 * repackaging data received from teh external web webservice.
 */

namespace library\API;


class Received extends AbstractHttp
{
    public function __construct(
                        $uri = NULL,
                        $method = NULL,
                        array $headers = NULL,
                        array $data = NULL,
                        array $cookies = NULL)
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->headers = $headers;
        $this->data = $data;
        $this->cookies = $cookies;
        $this->setTransport();
    }
}