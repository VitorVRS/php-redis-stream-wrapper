<?php

namespace VRS\Redis;

class Client {

  private $redis;

  private static $instance;

  public function __construct()
  {
    $this->redis = new \Redis();
    $this->redis->connect('127.0.0.1');
  }

  /**
   * Return this class instance
   * @return Client instance
   */
  public static function getInstance()
  {

    if (static::$instance === null) {
      static::$instance = new static();
    }

    return static::$instance;
  }

  public function get($key)
  {
    return $this->redis->get($key);
  }

  public function set($key, $value = null)
  {
    return $this->redis->set($key, $value);
  }

}