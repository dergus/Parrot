<?php

namespace dergus\fw;

/**
*
*/
class BaseModel
{
    public $activeAttributes=[];
    public $errors=[];
    public $scenario=false;
    public static $__db=false;

    protected function setActiveAttributes()
    {
        $scenario=$this->scenario;
        if($scenario){
            foreach ($this->rules() as $key => $rule) {
                if(isset($rule['on'])){

                    foreach ($rule['on'] as $key => $s) {
                        if($scenario==$s)
                            $this->activeAttributes+=$rule[0];
                    }

                }else{
                        $this->activeAttributes+=$rule[0];
                }
            }
        }else{
            foreach ($this->rules() as $key => $rule) {
                if(!isset($rule['on'])){
                    $this->activeAttributes+=$rule[0];
                }
            }
        }
    }

    public static function getDb()
    {

    }


    public function setAttributes($attrs)
    {

        $this->setActiveAttributes();

        foreach ($this->activeAttributes as $key => $attr) {
            if(isset($attrs[$attr])){
                $this->$attr=$attrs[$attr];
            }
        }


    }

    public function rules()
    {
        return [];
    }

    public function beforeValidate()
    {

    }

    public function afterValidate()
    {

    }

    public function validate()
    {
        $this->beforeValidate();

        $scenario=$this->scenario;
        if($scenario){
            foreach ($this->rules() as $key => $rule) {
                if(isset($rule['on'])){
                    foreach ($rule['on'] as $key => $s) {
                        if($scenario==$s)
                            $this->runRule($rule);
                    }
                }else{
                    $this->runRule($rule);
                }
            }
        }else{
            foreach ($this->rules() as $key => $rule) {
                if(!isset($rule['on'])){
                    $this->runRule($rule);
                }
            }
        }

        $this->afterValidate();

        if(empty($this->errors))
            return true;
        else
            return false;

    }

    public function runRule($rule)
    {
        foreach ($rule[0] as $key => $attr) {
            $this->$attr=$rule[1]($attr);
        }

    }

/**
 * creates new object of belonging
 * class type and sets its attributes
 * with given array of data
 * @param  array $attrs attribute key=>value
 * @return object
 */
    public static function model($attrs)
    {
        $model = new static;

        foreach ($attrs as $key => $value) {
            $model->$key = $value;
        }

        return $model;
    }

    public static function models($data)
    {
        $models=[];

        foreach ($data as $key => $value) {
            $models[]=static::model($value);
        }

        return $models;
    }


}