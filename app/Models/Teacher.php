<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
  protected $table = 'teachers';

  protected $fillable = [
      'user_id','NationalID','photo','gender','country','gov','university','faculty','graduation_year',
      'acc_grade','school_name','field_of_teaching','educational_zone','position','experience'
  ];
}
