<?php
class Logging
{
    
    private static $file = null;
    
    public static function setFile($file)
    {
        $file = SPATH . 'logs/' . $file . '.txt';
        if(!file_exists($file))
        {
            $file_handle = fopen($file);
            fclose($file_handle);
        }
        
        if(!is_writable($file))
        {
            throw new Exception('File' . $file . 'is not writeable.');
        }
        
        self::$file = $file;
    }

    public static function write($message, $file = NULL, $line = NULL)
    {
        $message = time() . ' - ' . $message;
        $message .= $file == NULL ? '' : ' in ' . $file;
        $message .= $line == NULL ? '' : ' on line ' . $line;
        $message .= PHP_EOL;

        return file_put_contents(self::$file, $message, FILE_APPEND);
    }
    
}