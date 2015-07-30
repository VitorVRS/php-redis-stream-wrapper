<?php

namespace VRS\Redis;

class Factory extends \Bcn\Component\StreamWrapper\Stream\Factory {

  public static function getInstance()
  {
    if (static::$instance === null) {
      static::$instance = new static();
    }

    return static::$instance;
  }

  public function capture()
  {
    $this->create('redis');
  }

  protected function create($id)
  {
    stream_wrapper_register($id, $this->getProxyClassName());
  }

  protected function getProxyClassName() {
    return "\\VRS\\Redis\\Proxy";
  }

  public function getStream($id)
  {
    if (!isset($this->used[$id])) {

      $path = str_replace('redis://', '', $id);

      /**
       * @todo remove this from here
       */
      $content = \VRS\Redis\Client::getInstance()->get($path);

      $this->used[$id] = new Stream($id, $content);
    }

    return $this->used[$id];
  }

}