<?php

namespace controller;

use core\Controller;
use core\Model;
use model\User;
use core\Config;

class UserController extends Controller 
{
    public function getOne()
    {
        $res = User::find()->one();
        print_r($res);
    }

    public function getAll()
    {
        $res = User::find()->all();
        print_r($res);
    }


    public function getInfo(Config $conf)
    {

 	 echo "<pre>";
	 print_r($conf);
#        $res1 = User::find()
#            ->select('id')
#            ->where(['<','age',16])
#            ->and(['in','height',[165,170]])
#            ->all();
        
#        print_r($res1);
        
#        $res2 = User::find()
#            ->select('id')
#            ->where(['=','gender',1])
#            ->or(['like','name','%Wang'])
#            ->all();
        
#        print_r($res2);

#        $res3 = User::find()
#            ->select('id')
#            ->where(['between','weight',[40,50]])
#            ->and(['>','id',4])
#            ->all();
#        print_r($res3);
    }
}
