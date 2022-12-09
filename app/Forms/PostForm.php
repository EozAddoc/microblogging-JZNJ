<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;


class PostForm extends Form
{
    public function buildForm()
    {
        $this->formOptions=[
            "method"=>"POST",
            "url"=>"/posts2"
        ];
        $this->add("description")->add("img_url")->add("submit", "submit", [
            "label"=>"Valider"
        ]);
    }
}
