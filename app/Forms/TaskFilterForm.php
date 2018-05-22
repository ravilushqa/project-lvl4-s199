<?php

namespace App\Forms;

use App\Tag;
use App\TaskStatus;
use App\User;
use Kris\LaravelFormBuilder\Form;

class TaskFilterForm extends Form
{
    public function buildForm()
    {

        $this
            ->add('creator', 'select', [
                'choices' => User::all()->pluck('name', 'name')->toArray(),
                'label' => 'Creator',
                'empty_value' => 'Select creator'
            ])
            ->add('assigned', 'select', [
                'choices' => User::all()->pluck('name', 'name')->toArray(),
                'label' => 'Assigned to',
                'empty_value' => 'Select assigned'
            ])
            ->add('status', 'select', [
                'choices' => TaskStatus::all()->pluck('name', 'name')->toArray(),
                'label' => 'Status',
                'default_value' => null,
                'empty_value' => 'Select status'

            ])
            ->add('tag', 'choice', [
                'choices' => Tag::all()->pluck('name', 'name')->toArray(),
                'choice_options' => [
                    'wrapper' => ['class' => 'choice-wrapper'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'selected' => null,
                'expanded' => false,
                'multiple' => false,
                'empty_value' => 'Select tag'
            ])
            ->add('submit', 'submit', ['label' => 'Find tasks'])
        ;
    }
}
