<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //通过$table属性来定义对应的表
    protected $table = 'my_articles';
}
