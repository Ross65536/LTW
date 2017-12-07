<?php

class ListsHTMLDecorator
{
    public function __construct($instance) {
        $this->instance = $instance;
    }

    public function getListMainInfo($id)
    {
        $map = $this->instance->getListMainInfo($id);


        foreach ($map as $key => $value)
            $map[$key] = $this->prepareHTML($value);


        return $map;
    }

    private function prepareHTML($text)
    {
        return htmlentities($text);
    }

    public function displayCreator($id) {
       return $this->prepareHTML($this->instance->displayCreator($id));
    }

    public function getListItems($id) {
      return $this->instance->getListItems($id);
    }

    public function getListUsers($id) {
      return $this->instance->getListItems($id);
    }
}
?>
