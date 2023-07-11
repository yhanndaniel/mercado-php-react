<?php

namespace App\Enums;

use App\Middlewares\Auth;
use App\Middlewares\Teste;

enum RouteMiddlewares: string
{
  case auth = Auth::class;
  case teste = Teste::class;
}
