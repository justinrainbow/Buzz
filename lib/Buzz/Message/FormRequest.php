<?php

namespace Buzz\Message;

/**
 * FormRequest.
 *
 * @author Marc Weistroff <marc.weistroff@sensio.com>
 */
class FormRequest extends Request
{
    protected $fields = array();

    public function __construct($method = self::METHOD_POST, $resource = '/', $host = null)
    {
        parent::__construct($method, $resource, $host);
    }

    public function setField($name, $value)
    {
        $this->fields[$name] = $value;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function setFields(array $fields)
    {
        $this->fields = $fields;
    }

    public function setContent($content)
    {
        throw new \BadMethodCallException('It is not permitted to set the content.');
    }

    public function getContent()
    {
        return http_build_query($this->fields);
    }

    public function getHeaders()
    {
        return array_merge(parent::getHeaders(), array(
            'Content-Type: application/x-www-form-urlencoded',
            'Content-Length: '.strlen($this->getContent()),
        ));
    }
}
