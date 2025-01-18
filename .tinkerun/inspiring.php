<?php

use App\Models\Client;
use App\Models\Command;
use App\Models\Product;
$commands = Command::all();

foreach($commands as $item){
    $item->amount = $item->total();
    $item->save();
  }
