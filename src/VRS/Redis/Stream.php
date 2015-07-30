<?php

namespace VRS\Redis;

class Stream extends \Bcn\Component\StreamWrapper\Stream {

  public function __construct($filename, $content = null)
  {
    $this->filename = $filename;
    $this->content  = $content;
    $this->position = -1;
    $this->id = str_replace('redis://', '', $filename);

    $this->append = false;
  }

  public function __destruct()
  {
  }

  public function open($path, $mode, $options, &$opened_path)
  {
    if ($path == $this->filename && !$this->open) {
        $this->open = true;
        $this->append = false;

        $this->position = -1;
        if (false !== strpos($mode, 'w'))
        {
          $this->content = '';
        } elseif (false !== strpos($mode, 'a'))
        {
          $this->position = $this->size();
          $this->append = true;
        }

        return true;
    }

    return false;
  }

  public function getUri()
  {
    return $this->filename;
  }

  public function write($data)
  {
    // ugly solution for FILE_APPEND
    if ( $this->append ) {
      $this->position =  $this->size();
    }
    $size = parent::write($data);

    /**
     * @todo remove this from here
     */
    \VRS\Redis\Client::getInstance()->set($this->id, $this->content);

    return $size;
  }

  public function stat()
  {

    if ($this->content === false) {
      return false;
    }

    return parent::stat();
  }

}