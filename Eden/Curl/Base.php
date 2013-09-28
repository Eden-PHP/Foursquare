<?php //-->
/*
 * This file is part of the Curl package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Curl;

use Eden\Core\Base as CoreBase;

/**
 * The base class for all classes wishing to integrate with Eden.
 * Extending this class will allow your methods to seemlessly be
 * overloaded and overrided as well as provide some basic class
 * loading patterns.
 *
 * @vendor Eden
 * @package Curl
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Base extends CoreBase
{

	const PUT = 'PUT';
    const DELETE = 'DELETE';
    const GET = 'GET';
    const POST = 'POST';

    protected $options = array();
    protected $meta = array();
    protected $query = array();
    protected $headers = array();

    /**
     * Determines if the method is an actual curl option
     *
     * @param *string
     * @param *array
     * @return object
     */
    public function __call($name, $args) 
    {
        Argument::i()
			//argument 1 must be a string
            ->test(1, 'string') 
			//argument 2 must be an array
            ->test(2, 'array'); 

        if(strpos($name, 'set') === 0) {
            $method = substr($name, 3);

            if(isset(self::$setBoolKeys[$method])) {
                Argument::i()->virtual($name, $args, 1, 'bool');
                $key = self::$setBoolKeys[$method];
                $this->options[$key] = $args[0];

                return $this;
            }

            if(isset(self::$setIntegerKeys[$method])) {
                Argument::i()->virtual($name, $args, 1, 'int');
                $key = self::$setIntegerKeys[$method];
                $this->options[$key] = $args[0];

                return $this;
            }

            if(isset(self::$setStringKeys[$method])) {
                Argument::i()->virtual($name, $args, 1, 'string');
                $key = self::$setStringKeys[$method];
                $this->options[$key] = $args[0];

                return $this;
            }

            if(isset(self::$setArrayKeys[$method])) {
                Argument::i()->virtual($name, $args, 1, 'array');
                $key = self::$setArrayKeys[$method];
                $this->options[$key] = $args[0];

                return $this;
            }

            if(isset(self::$setFileKeys[$method])) {
                $key = self::$setFileKeys[$method];
                $this->options[$key] = $args[0];

                return $this;
            }

            if(isset(self::$setCallbackKeys[$method])) {
                Argument::i()->virtual($name, $args, 1, 'array', 'string');
                $key = self::$setCallbackKeys[$method];
                $this->options[$key] = $args[0];

                return $this;
            }
        }

        parent::__call($name, $args);
    }

    /**
     * Send the curl off and returns the results
     * parsed as DOMDocument
     *
     * @return DOMDOcument
     */
    public function getDomDocumentResponse() 
    {
        $this->meta['response'] = $this->getResponse();
        $xml = new DOMDocument();
        $xml->loadXML($this->meta['response']);
        return $xml;
    }

    /**
     * Send the curl off and returns the results
     * parsed as JSON
     *
     * @param bool
     * @return array
     */
    public function getJsonResponse($assoc = true) 
    {
        //argument 1 must be a boolean
        Argument::i()->test(1, 'bool');

        $this->meta['response'] = $this->getResponse();
        return json_decode($this->meta['response'], $assoc);
    }

    /**
     * Returns the meta of the last call
     *
     * @param string|null
     * @return array
     */
    public function getMeta($key = null) 
    {
        //argument 1 must be a string or null
        Argument::i()->test(1, 'string', 'null');

        if(isset($this->meta[$key])) {
            return $this->meta[$key];
        }

        return $this->meta;
    }

    /**
     * Send the curl off and returns the results
     * parsed as url query
     *
     * @return array
     */
    public function getQueryResponse() 
    {
        $this->meta['response'] = $this->getResponse();
        parse_str($this->meta['response'], $response);
        return $response;
    }

    /**
     * Send the curl off and returns the results
     *
     * @return string
     */
    public function getResponse() 
    {
        $curl = curl_init();

        $this->addParameters()->addHeaders();
        $this->options[CURLOPT_RETURNTRANSFER] = true;
        curl_setopt_array($curl, $this->options);

        $response = curl_exec($curl);

        $this->meta = array(
            'info'             => curl_getinfo($curl, CURLINFO_HTTP_CODE),
            'error_message'    => curl_errno($curl),
            'error_code'    => curl_error($curl));

        curl_close($curl);
        unset($curl);

        return $response;
    }

    /**
     * Send the curl off and returns the results
     * parsed as SimpleXml
     *
     * @return SimpleXmlElement
     */
    public function getSimpleXmlResponse() 
    {
        $this->meta['response'] = $this->getResponse();
        return simplexml_load_string($this->meta['response']);
    }

    /**
     * isset using the ArrayAccess interface
     *
     * @param *scalar|null|bool
     * @return bool
     */
    public function offsetExists($offset) 
    {
        //argument 1 must be scalar, null or bool
        Argument::i()->test(1, 'scalar', 'null', 'bool');

        return isset($this->option[$offset]);
    }

    /**
     * returns data using the ArrayAccess interface
     *
     * @param *scalar|null|bool
     * @return bool
     */
    public function offsetGet($offset) 
    {
        //argument 1 must be scalar, null or bool
        Argument::i()->test(1, 'scalar', 'null', 'bool');

        return isset($this->option[$offset]) ? $this->option[$offset] : null;
    }

    /**
     * Sets data using the ArrayAccess interface
     *
     * @param *scalar|null|bool
     * @param mixed
     * @return void
     */
    public function offsetSet($offset, $value) 
    {
        //argument 1 must be scalar, null or bool
        Argument::i()->test(1, 'scalar', 'null', 'bool');

        if (!is_null($offset)) {
            if(in_array($offset, $this->setBoolKeys)) {
                $method = array_search($offset, $this->setBoolKeys);
                $this->call('set'.$method, array($value));
            }

            if(in_array($offset, $this->setIntegerKeys)) {
                $method = array_search($offset, $this->setIntegerKeys);
                $this->call('set'.$method, array($value));
            }

            if(in_array($offset, $this->setStringKeys)) {
                $method = array_search($offset, $this->setStringKeys);
                $this->call('set'.$method, array($value));
            }

            if(in_array($offset, $this->setArrayKeys)) {
                $method = array_search($offset, $this->setArrayKeys);
                $this->call('set'.$method, array($value));
            }

            if(in_array($offset, $this->setFileKeys)) {
                $method = array_search($offset, $this->setFileKeys);
                $this->call('set'.$method, array($value));
            }

            if(in_array($offset, $this->setCallbackKeys)) {
                $method = array_search($offset, $this->setCallbackKeys);
                $this->call('set'.$method, array($value));
            }
        }
    }

    /**
     * unsets using the ArrayAccess interface
     *
     * @param *scalar|null|bool
     * @return bool
     */
    public function offsetUnset($offset) 
    {
        //argument 1 must be scalar, null or bool
        Argument::i()->test(1, 'scalar', 'null', 'bool');

        unset($this->option[$offset]);
    }

    /**
     * Send the curl off 
     *
     * @return Eden\Curl\Base
     */
    public function send() 
    {
        $curl = curl_init();

        $this->addParameters()->addHeaders();
        curl_setopt_array($curl, $this->options);
        curl_exec($curl);

        $this->meta = array(
            'info'             => curl_getinfo($curl, CURLINFO_HTTP_CODE),
            'error_message'    => curl_errno($curl),
            'error_code'    => curl_error($curl));

        curl_close($curl);
        unset($curl);

        return $this;
    }

    /**
     * Curl has problems handling custom request types
     * from misconfigured end points or vice versa. 
     * When default cURL fails, try a custom GET instead
     *
     * @return Eden\Curl\Base
     */
    public function setCustomGet() 
    {
        $this->setCustomRequest(self::GET);
        return $this;
    }

    /**
     * Curl has problems handling custom request types
     * from misconfigured end points or vice versa. 
     * When default cURL fails, try a custom POST instead
     *
     * @return Eden\Curl\Base
     */
    public function setCustomPost() 
    {
        $this->setCustomRequest(self::POST);
        return $this;
    }

    /**
     * Curl has problems handling custom request types
     * from misconfigured end points or vice versa. 
     * When default cURL fails, try a custom PUT instead
     *
     * @return Eden\Curl\Base
     */
    public function setCustomPut() 
    {
        $this->setCustomRequest(self::PUT);
        return $this;
    }

    /**
     * Curl has problems handling custom request types
     * from misconfigured end points or vice versa. 
     * When default cURL fails, try a custom DELETE instead
     *
     * @return Eden\Curl\Base
     */
    public function setCustomDelete() 
    {
        $this->setCustomRequest(self::DELETE);
        return $this;
    }

    /**
     * CURLOPT_POSTFIELDS accepts array and string
     * arguments, this is a special case that __call 
     * does not handle
     *
     * @param *string|array
     * @return Eden\Curl\Base
     */
    public function setPostFields($fields) 
    {
        //argument 1 must be a string or array
        Argument::i()->test(1, 'array', 'string');

        $this->options[CURLOPT_POSTFIELDS] = $fields;

        return $this;
    }

    /**
     * Sets request headers
     *
     * @param *array|string
     * @param scalar|null
     * @return Eden\Curl\Base
     */
    public function setHeaders($key, $value = null) 
    {
        Argument::i()
			//argument 1 must be a string or array
            ->test(1, 'array', 'string') 
			//argument 2 must be scalar or null
            ->test(2, 'scalar','null');  

        if(is_array($key)) {
            $this->headers = $key;
            return $this;
        }

        $this->headers[] = $key.': '.$value;
        return $this;
    }

    /**
     * Sets url parameter
     *
     * @param *array|string
     * @param scalar
     * @return Eden\Curl\Base
     */
    public function setUrlParameter($key, $value = null) 
    {
        Argument::i()
			//argument 1 must be a string or array
            ->test(1, 'array', 'string') 
			//argument 2 must be scalar
            ->test(2, 'scalar');         

        if(is_array($key)) {
            $this->param = $key;
            return $this;
        }

        $this->param[$key] = $value;
    }

    /**
     * Sets CURLOPT_SSL_VERIFYHOST
     *
     * @param bool
     * @return Eden\Curl\Base
     */
    public function verifyHost($on = true) 
    {
        Argument::i()->test(1, 'bool'); //argument 1 must be a boolean

        $this->options[CURLOPT_SSL_VERIFYHOST] = $on ? 1 : 2;
        return $this;
    }

    /**
     * Sets CURLOPT_SSL_VERIFYPEER
     *
     * @param bool
     * @return Eden\Curl\Base
     */
    public function verifyPeer($on = true) 
    {
        Argument::i()->test(1, 'bool'); //argument 1 must be a boolean

        $this->options[CURLOPT_SSL_VERIFYPEER] = $on;
        return $this;
    }

    /**
     * Adds extra headers to the cURL request
     *
     * @return Eden\Curl\Base
     */
    protected function addHeaders() 
    {
        if(empty($this->headers)) {
            return $this;
        }

        $this->options[CURLOPT_HTTPHEADER] = $this->headers;
        return $this;
    }

    /**
     * Adds extra post parameters to the cURL request
     *
     * @return Eden\Curl\Base
     */
    protected function addParameters() 
    {
        if(empty($this->params)) {
            return $this;
        }

        $params = http_build_query($this->params);
        if($this->options[CURLOPT_POST]) {
            $this->options[CURLOPT_POSTFIELDS] = $params;
            return $this;
        }

        //if there is a question mark in the url
        if(strpos($this->options[CURLOPT_URL], '?') === false) {
            //add the question mark
            $params = '?'.$params;
        //else if the question mark is not at the end
        } else if(substr($this->options[CURLOPT_URL], -1, 1) != '?') {
            //append the parameters to the end
            //with the other parameters
            $params = '&'.$params; 
        }

        //append the parameters
        $this->options[CURLOPT_URL] .= $params;

        return $this;
    }

    protected static $setBoolKeys = array(
        'AutoReferer' => CURLOPT_AUTOREFERER,
        'BinaryTransfer' => CURLOPT_BINARYTRANSFER,
        'CookieSession' => CURLOPT_COOKIESESSION,
        'CrlF' => CURLOPT_CRLF,
        'DnsUseGlobalCache' => CURLOPT_DNS_USE_GLOBAL_CACHE,
        'FailOnError' => CURLOPT_FAILONERROR,
        'FileTime' => CURLOPT_FILETIME,
        'FollowLocation' => CURLOPT_FOLLOWLOCATION,
        'ForbidReuse' => CURLOPT_FORBID_REUSE,
        'FreshConnect' => CURLOPT_FRESH_CONNECT,
        'FtpUseEprt' => CURLOPT_FTP_USE_EPRT,
        'FtpUseEpsv' => CURLOPT_FTP_USE_EPSV,
        'FtpAppend' => CURLOPT_FTPAPPEND,
        'FtpListOnly' => CURLOPT_FTPLISTONLY,
        'Header' => CURLOPT_HEADER,
        'HeaderOut' => CURLINFO_HEADER_OUT,
        'HttpGet' => CURLOPT_HTTPGET,
        'HttpProxyTunnel' => CURLOPT_HTTPPROXYTUNNEL,
        'Netrc' => CURLOPT_NETRC,
        'Nobody' => CURLOPT_NOBODY,
        'NoProgress' => CURLOPT_NOPROGRESS,
        'NoSignal' => CURLOPT_NOSIGNAL,
        'Post' => CURLOPT_POST,
        'Put' => CURLOPT_PUT,
        'ReturnTransfer' => CURLOPT_RETURNTRANSFER,
        'SslVerifyPeer' => CURLOPT_SSL_VERIFYPEER,
        'TransferText' => CURLOPT_TRANSFERTEXT,
        'UnrestrictedAuth' => CURLOPT_UNRESTRICTED_AUTH,
        'Upload' => CURLOPT_UPLOAD,
        'Verbose' => CURLOPT_VERBOSE);

    protected static $setIntegerKeys = array(
        'BufferSize' => CURLOPT_BUFFERSIZE,
        'ClosePolicy' => CURLOPT_CLOSEPOLICY,
        'ConnectTimeout' => CURLOPT_CONNECTTIMEOUT,
        'ConnectTimeoutMs' => CURLOPT_CONNECTTIMEOUT_MS,
        'DnsCacheTimeout' => CURLOPT_DNS_CACHE_TIMEOUT,
        'FtpSslAuth' => CURLOPT_FTPSSLAUTH,
        'HttpVersion' => CURLOPT_HTTP_VERSION,
        'HttpAuth' => CURLOPT_HTTPAUTH,
        'InFileSize' => CURLOPT_INFILESIZE,
        'LowSpeedLimit' => CURLOPT_LOW_SPEED_LIMIT,
        'LowSpeedTime' => CURLOPT_LOW_SPEED_TIME,
        'MaxConnects' => CURLOPT_MAXCONNECTS,
        'MaxRedirs' => CURLOPT_MAXREDIRS,
        'Port' => CURLOPT_PORT,
        'ProxyAuth' => CURLOPT_PROXYAUTH,
        'ProxyPort' => CURLOPT_PROXYPORT,
        'ProxyType' => CURLOPT_PROXYTYPE,
        'ResumeFrom' => CURLOPT_RESUME_FROM,
        'SslVerifyHost' => CURLOPT_SSL_VERIFYHOST,
        'SslVersion' => CURLOPT_SSLVERSION,
        'TimeCondition' => CURLOPT_TIMECONDITION,
        'Timeout' => CURLOPT_TIMEOUT,
        'TimeoutMs' => CURLOPT_TIMEOUT_MS,
        'TimeValue' => CURLOPT_TIMEVALUE);

    protected static $setStringKeys = array(
        'CaInfo' => CURLOPT_CAINFO,
        'CaPath' => CURLOPT_CAPATH,
        'Cookie' => CURLOPT_COOKIE,
        'CookieFile' => CURLOPT_COOKIEFILE,
        'CookieJar' => CURLOPT_COOKIEJAR,
        'CustomRequest' => CURLOPT_CUSTOMREQUEST,
        'EgdSocket' => CURLOPT_EGDSOCKET,
        'Encoding' => CURLOPT_ENCODING,
        'FtpPort' => CURLOPT_FTPPORT,
        'Interface' => CURLOPT_INTERFACE,
        'Krb4Level' => CURLOPT_KRB4LEVEL,
        'PostFields' => CURLOPT_POSTFIELDS,
        'Proxy' => CURLOPT_PROXY,
        'ProxyUserPwd' => CURLOPT_PROXYUSERPWD,
        'RandomFile' => CURLOPT_RANDOM_FILE,
        'Range' => CURLOPT_RANGE,
        'Referer' => CURLOPT_REFERER,
        'SslCipherList' => CURLOPT_SSL_CIPHER_LIST,
        'SslCert' => CURLOPT_SSLCERT,
        'SslCertPassword' => CURLOPT_SSLCERTPASSWD,
        'SslCertType' => CURLOPT_SSLCERTTYPE,
        'SslEngine' => CURLOPT_SSLENGINE,
        'SslEngineDefault' => CURLOPT_SSLENGINE_DEFAULT,
        'Sslkey' => CURLOPT_SSLKEY,
        'SslKeyPasswd' => CURLOPT_SSLKEYPASSWD,
        'SslKeyType' => CURLOPT_SSLKEYTYPE,
        'Url' => CURLOPT_URL,
        'UserAgent' => CURLOPT_USERAGENT,
        'UserPwd' => CURLOPT_USERPWD);

    protected static $setArrayKeys = array(
        'Http200Aliases' => CURLOPT_HTTP200ALIASES,
        'HttpHeader' => CURLOPT_HTTPHEADER,
        'PostQuote' => CURLOPT_POSTQUOTE,
        'Quote' => CURLOPT_QUOTE);

    protected static $setFileKeys = array(
        'File' => CURLOPT_FILE,
        'InFile' => CURLOPT_INFILE,
        'StdErr' => CURLOPT_STDERR,
        'WriteHeader' => CURLOPT_WRITEHEADER);

    protected static $setCallbackKeys = array(
        'HeaderFunction' => CURLOPT_HEADERFUNCTION,
        'ReadFunction' => CURLOPT_READFUNCTION,
        'WriteFunction' => CURLOPT_WRITEFUNCTION);

}