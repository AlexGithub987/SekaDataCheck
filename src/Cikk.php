<?php

namespace AlexGithub987\sekadatacheck;

use AlexGithub987\sekadatacheck\Models\Cikk as ModelsCikk;

class Cikk
{
    // Build wonderful things
    public function hello()
    {
        return 'Hello, World!';
    } 

    public function index() {

        $cikk = ModelsCikk::select('*')->where('id', 1)->first();

        return ["cikk" => $cikk];

    }
     

}