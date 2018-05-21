<?php

namespace App\Forms;

use App\Tag;
use App\TaskStatus;
use App\User;
use Kris\LaravelFormBuilder\Form;

class TaskForm extends Form
{
    public function buildForm()
    {

        $this
            ->add('name', 'text', [
                'rules' => 'required'
            ])
            ->add('description', 'textarea')
            ->add('status_id', 'select', [
                'choices' => TaskStatus::all()->pluck('name', 'id')->toArray(),
                'label' => 'Status'
            ])
            ->add('assigned_id', 'select', [
                'choices' => User::all()->pluck('name', 'id')->toArray(),
                'label' => 'Assigned to'
            ])
            ->add('tags', 'choice', [
                'choices' => Tag::all()->pluck('name', 'id')->toArray(),
                'choice_options' => [
                    'wrapper' => ['class' => 'choice-wrapper'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'selected' => $this->model ? $this->model->tags : [],
                'expanded' => false,
                'multiple' => true
            ])
            ->add('submit', 'submit', ['label' => 'Save task'])
        ;
    }
}
