<?php

declare(strict_types=1);

namespace Framework\Form;

interface FormType
{
    public function buildForm(Form $form);
}