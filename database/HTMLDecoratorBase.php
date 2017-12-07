<?php

class HTMLDecoratorBase 
{
    public function __construct($instance) 
    {
        $this->instance = $instance;
    }

    protected function prepareStringMap($map)
    {
        foreach ($map as $key => $value)
            $map[$key] = $this->prepareString($value);
    
        return $map;
    }

    protected function prepareString($text)
    {
        return htmlentities($text);
    }
}

?>