# php-redis-stream-wrapper
PHP Stream Wrapper to use Redis as a File System.

## This project aren't in production yet. ##

Allows you to use PHP native functions (*file_put_contents*, *file_get_contents*, *fopen*, *fwrite*, etc) on Redis context.

**This project can be usefull if you are using Redis as "File System"**

Redis Example:
```redis
    SET /path/to/file "content"
    GET /path/to/file
```

PHP Example:
```php
    file_put_contents('redis:///path/to/file', 'content');
    $fileContent = file_get_contents('redis:///path/to/file');
```

