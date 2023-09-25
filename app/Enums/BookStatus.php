<?php

namespace App\Enums;

enum BookStatus: int
{
    case AVAILABLE = 1;
    case BOOKED = 2;
}
