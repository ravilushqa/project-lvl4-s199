<?php

namespace App\Forms;

use App\Tag;
use App\TaskStatus;
use App\User;
use Kris\LaravelFormBuilder\Form;

class TaskStatusForm extends Form
{
    public function buildForm()
    {

        $this
            ->add('name', 'text', [
                'rules' => 'required|string'
            ])
            ->add('submit', 'submit', ['label' => 'Save status']);
    }
}
