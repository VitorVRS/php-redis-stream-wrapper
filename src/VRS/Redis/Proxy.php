<?php

namespace VRS\Redis;

class Proxy extends \Bcn\Component\StreamWrapper\Stream\Proxy {

  protected function getStream()
  {
    if(!$this->id) {
      $this->id = str_replace(__CLASS__ . "_", '', get_class($this));
    }

    return \VRS\Redis\Factory::getInstance()->getStream($this->id);
  }

  public function stream_open($path, $mode, $options, &$opened_path)
  {
    $this->id = $path;
    return $this->getStream()->open($path, $mode, $options, $opened_path);
  }

  public function url_stat($path, $flags)
  {
    $this->id = $path;
    return parent::url_stat($path, $flags);
  }

  public function stream_stat()
  {
    return $this->getStream()->stat();
  }

}