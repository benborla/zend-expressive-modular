<?php
namespace Album\Model;

class Album
{
    public function exchangeArray()
    {
        return get_object_vars($this);
    }
}