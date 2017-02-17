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

    protected function buildTo()
    {
        if($this->to)
        {
            curl_setopt($this->ch, CURLOPT_URL, $this->to);
        }
    }

    protected function buildFiles()
    {
        $this->data = $this->http_build_query_develop($this->data);

        if (!empty($this->files))
        {
            curl_setopt($this->ch, CURLOPT_BINARYTRANSFER, true);
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, ['Content-type: multipart/form-data']);

            foreach ($this->files as $key => $file)
            {
                $this->data[$key] = new \CURLFile($file, mime_content_type($file));
            }
        }
    }

    /**
     * patch for CURL bug
     * @link https://bugs.php.net/bug.php?id=67477
     *
     * @param $data
     *
     * @return array
     */
    protected function http_build_query_develop($data)
    {
        if (!is_array($data))
        {
            return $data;
        }
        foreach ($data as $key => $val)
        {
            if (is_array($val))
            {
                foreach ($val as $k => $v)
                {
                    if (is_array($v))
                    {
                        $data = array_merge($data, $this->http_build_query_develop(["{$key}[{$k}]" => $v]));
                    }
                    else
                    {
                        $data["{$key}[{$k}]"] = $v;
                    }
                }

                unset($data[$key]);
            }
        }

        return $data;
    }

    protected function buildMethod()
    {
        if ($this->method === 'GET')
        {
            $this->to .= '?' . http_build_query($this->data);
        } else {
            curl_setopt($this->ch, CURLOPT_POST, 1);

            if($this->method !== 'POST')
            {
                curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $this->method);
            }

            $this->buildFiles();

            curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->data);
        }
    }

    protected function buildJson()
    {
        if ($this->isJson)
        {
            $this->headers[] = 'Accept: application/json';
            $this->headers[] = 'Content-Type: application/json';
        }
    }

    protected function build()
    {
        $this->ch = curl_init();

        $this->buildMethod();
        $this->buildJson();

        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->headers);

        $this->buildTo();
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
     * @return $this
     */
    public function to($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @return mixed
     *
     * @throws CurlError
     */
    public function exec()
    {
        $this->build();

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
