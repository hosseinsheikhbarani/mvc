<?php

namespace lil\App\Core;

class Controller
{
    public string $layout = 'main';
    public array $properties =[];
    public array $head = [
        'title'=>[
            'val'=>APPTITLE,
            'el'=>'<title>{{el}}</title>'
        ],
        'description'=>['val'=>'hossein','el'=>'<meta property="description" content="{{el}}" />']
    ];

    
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
    public function setLayoutProperties($properties)
    {
        $this->properties = $properties;
    }
    public function getLayoutProperties()
    {
        return $this->properties;
    }
    
}
