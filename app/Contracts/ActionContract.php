<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface ActionContract
{
    public function __construct(Request $request);

    public function handler(): array;
}
