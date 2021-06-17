<?php

namespace App\Repositories\Eloquent;

use App\Repositories\TempQuestionInterface;
use Illuminate\Support\Collection;
use App\Models\TempQuestion;
use DB;
//use Your Model

/**
 * Class BrandRepository.
 */
class TempQuestionRepository implements TempQuestionInterface
{
    protected $model;
   
    public function __construct(TempQuestion $tempModel)
    {
        $this->model = $tempModel;
    }

    public function create(array $data, $examID,$questionID,$userID,$question)
    {
        
        $istrue = DB::table('temp_questions')
        ->where('examID',$examID)
        ->where('questionID',$questionID)
        ->where('studentID',$userID)
        ->where('question',$question)
        ->exists();

        if(!$istrue)
        {
            return $this->model->create($data);
        }
    }

    public function single($id)
    {
        return $this->model
        ->where('examID',$id)
        ->limit(1)
        //->orderby('id','asc')
        ->get();
    }
    
    public function next($id)
    {
        return $this->model
        ->where('id','=',$id)
        ->limit(1)
        ->orderby('id','asc')
        ->get();
    }

    public function previous($id)
    {
        return $this->model->where('id','=',$id)
        ->where('id',$id)
        ->limit(1)
        ->orderby('id','desc')
        ->get();
    }

    public function delete($id)
    {
        return $this->model->where('studentID','=',$id)->delete();
    }

}
