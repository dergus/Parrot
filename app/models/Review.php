<?php

    namespace app\models;

    use dergus\fw\BaseModel;
    use dergus\fw\FW;


    /**
    *
    */
    class Review extends BaseModel
    {

        //model properties

        public $id;
        public $name;
        public $email;
        public $msg;
        public $status;
        public $changed;
        public $created_at;

        public static function getImg($img)
        {
            return '/images/'.$img;
        }

        public function rules()
        {
            return [

                [
                    ['name','email', 'msg'],function($attr){
                                    if(empty($this->$attr)){
                                        $this->errors[$attr][]="Field $attr is required";

                                    }
                                    return $this->$attr;
                                }
                ]


            ];
        }

        public static function getDb()
        {
            if(!static::$__db){
                $db = FW::getService('db');
                $db->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
                static::$__db = $db;
            }
            return static::$__db;
        }


        public function save()
        {
            $params=[$this->name, $this->email, $this->msg];
            $db=self::getDb();

            $sql="INSERT INTO reviews(name, email, msg) VALUES(?, ?, ?)";
            $db=$db->prepare($sql);
            $res = $db->execute($params);
            return $res;
        }

        public static function getAll($params=[])
        {
            $defaultParams=[':status'=>1,':limit'=>15];
            $params=$defaultParams+$params;
            $db=self::getDb();
            $db->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            $sql="SELECT * FROM reviews WHERE status=:status ORDER BY created_at DESC LIMIT :limit";
            $db=$db->prepare($sql);
            $db->execute($params);

            return self::models($db->fetchAll(\PDO::FETCH_ASSOC));

        }

    }