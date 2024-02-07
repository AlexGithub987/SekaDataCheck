<?php

namespace AlexGithub987\sekadatacheck\Cikk;

use AlexGithub987\sekadatacheck\Models\Companies;

class Cikk
{

    // Build wonderful things
    public function hello()
    {
        return 'Hello, World!';
    } 

    public function index($request) {

        $company_id = Companies::select('*')->first()['id'];

        return $company_id;

    }
}