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

    protected function prepareStringDoubleMap($map)
    {
        foreach ($map as $key => $value)
            $map[$key] = $this->prepareStringMap($value);
    
        return $map;
    }

    protected function prepareString($text)
    {
        return htmlentities($text);
    }

    protected function decodeString($text)
    {
        return html_entity_decode($text);
    }

    protected function decodeMap($map)
    {
        foreach ($map as $key => $value)
            $map[$key] = $this->decodeString($value);

        return $map;
    }

}

?>