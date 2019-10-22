<?php
namespace Src\Models\helper;

class StsSession
{
    private $Data;

    public function setData($data = array())
    {
        $this->Data = $data;

        foreach ($this->Data as $key => $value) {
            if(!isset($_SESSION[$key])){
                $_SESSION[$key] = $value;
            }
        }

    }

    public function unsetData()
    {
        $this->Data = $_SESSION;

        foreach ($this->Data as $key => $value) {
            if(isset($_SESSION[$key])){
                unset($_SESSION[$key]);
            }
        }
    }

    public function setField($field, $value)
    {
        if(!isset($_SESSION[$field])){
            $_SESSION[$field] = $value;
        }
    }

    public function unsetField($field)
    {
        if(isset($_SESSION[$field])){
            unset($_SESSION[$field]);
        }
    }

    public function getFieldValue($field)
    {
        if(isset($_SESSION[$field])){
            return $_SESSION[$field];
        } else {
            return false;
        }
    }

    public function setMsgError($msg = NULL)
    {
        $_SESSION['msg'] = $msg;
    }

    public function setMsgSuccess($msg = NULL)
    {
        $_SESSION['msg'] = $msg;
    }

}
