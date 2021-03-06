<?php

namespace app\home\controller;
use app\admin\model\Node;
use think\Controller;
use think\Request;

class Base extends Controller
{
    public function _initialize()
    {
        if (Request::instance()->isMobile()){
            $this->redirect(url('wap/home'));
        }
        if(!session('uid')){
            $this->redirect(url('login/index'));
        }

        $auth = new \com\Auth();
        $module     = strtolower(request()->module());
        $controller = strtolower(request()->controller());
        $action     = strtolower(request()->action());
        $url        = $module."/".$controller."/".$action;


        //跳过检测以及主页权限
//        if(session('uid')!=1){
//
//            if(!in_array($url, ['home/index/index','home/index/indexpage'])){
//                if(!$auth->check($url,session('uid'))){
//                    $this->error('抱歉，您没有操作权限');
//                }
//            }
//        }

        $node = new Node();
        $this->assign([
            'username' => session('username'),
            'menu' => $node->getMenu(session('rule')),
            'rolename' => session('rolename')
        ]);

    }
}