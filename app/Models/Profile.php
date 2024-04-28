<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Profile extends Model
{
    use HasFactory;


    public function run()
    {
        Profile::factory()
                ->count(50)
                ->hasPosts(1)
                ->create();
    }


}
