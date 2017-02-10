<?php

namespace Deimos\Helper\Helpers;

use Deimos\Helper\AbstractHelper;
use Deimos\Helper\Exceptions\CurlError;

class Send extends AbstractHelper
{

    /**
     * @var resource
     */
    protected $ch;

    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var array
     */
    protected $files = [];

    /**
     * @var string
     */
    protected $to;

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var bool
     */
    protected $isJson = false;

    /**
     */
    protected function build()
    {
        $this->ch = curl_init();

        if (!empty($this->files))
        {
            curl_setopt($this->ch, CURLOPT_BINARYTRANSFER, true);
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);

            foreach ($this->files as $key => $file)
            {
                $this->data[$key] = '@' . $file;
            }
        }

        if ($this->method === 'GET')
        {
            $this->to .= '?';
            $this->data = http_build_query($this->data);
        } else {
            curl_setopt($this->ch, CURLOPT_POST, 1);

            if($this->method !== 'POST')
            {
                curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $this->method);
            }
        }

        if ($this->isJson)
        {
            $this->headers[] = 'Accept: application/json';
            $this->headers[] = 'Content-Type: application/json';
        }

        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->headers);

        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->data);
    }

    /**
     * @param string $name
     * @param string $path
     *
     * @return $this
     */
    public function file($name, $path)
    {
        $this->files[$name] = $path;

        return $this;
    }

    /**
     * @param string $method
     *
     * @return $this
     */
    public function method($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @param array $storage
     *
     * @return $this
     */
    public function data(array $storage)
    {
        $this->data = $storage;

        return $this;
    }

    /**
     * @param string $to
     *
     * @return mixed
     *
     * @throws CurlError
     */
    public function exec($to)
    {
        $this->build();

        curl_setopt($this->ch, CURLOPT_URL, $to);
        $data = curl_exec($this->ch);

        if(curl_errno($this->ch))
        {
            throw new CurlError(curl_error($this->ch));
        }

        curl_close($this->ch);

        return $data;
    }

    /**
     * @return resource curl_init
     */
    public function &getCh()
    {
        $this->build();

        return $this->ch;
    }

    public function json()
    {
        $this->isJson = true;

        return $this;
    }

    /**
     * @param string $user
     * @param string $password
     *
     * @return $this
     */
    public function httpAuth($user, $password)
    {
        curl_setopt($this->ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($this->ch, CURLOPT_USERPWD, "$user:$password");

        return $this;
    }

    /**
     * @param array $headers example: ['Accept: application/json', 'Content-Type: application/json']
     *
     * @return $this
     */
    public function headers(array $headers)
    {
        $this->headers = array_merge($this->headers, $headers);

        return $this;
    }

}
