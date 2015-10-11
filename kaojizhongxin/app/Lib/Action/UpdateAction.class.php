<?php


Class UpdateAction extends Action{

    public function index(){

        if(session('username')==""){
                    
                   $this->login();
                   exit;
           }

        $this->assign('curpage' ,I('action'));

        if ( I('action') == 'add' ){  //添加
            $this->display('add');
        } elseif ( I('action') == 'edit' ){  //修改
            
            $res = M('Update');
            $vo = $res->where('id=' .I('id'))->find();
        
            $this->assign('curpage' ,'edit');
            $this->assign('vo' ,$vo);
            $this->display('edit');
        
        } else {  //列表
        
            $res = M('Update');
            $list = $res->order('id')->select();

            $this->assign('list' ,$list);
            $this->display();
            
        }

    }


    Public function handle(){
    
        $res = M('Update');
        
        $data['id'] = I('id');
        
        If( I('action') == 'del'){
            $res->where('id=' . $data['id'])->delete();
        } else {
            $res->save($data);
        }

        if($res){
            $this->success('操作成功！');
        } else {
            $this->error('操作失败');
        }

    }


    public function save(){

        import("ORG.Net.UploadFile");
        $upload = new UploadFile();

        $upload->maxSize = 1024 * 1024 * 2;  
        $upload->savePath  = './Downloads/';  //保存路径
        $upload->saveRule = 'uniqid' ;//上传文件规则


        if(!$upload->upload()){
            //捕获上传异常
            //$this->error($upload->getErrorMsg());
            $imgs = '';

        }else{
            //取得成功上传的文件信息
            $uploadList = $upload->getUploadFileInfo();




            $imgs = $uploadList[0]['savename'];
        }

        
        $data['title']   = I('title');
        $data['odate'] = I('odate');
        $data['url']     = $_POST['url'];
      


        $Update = M('Update');

        if(I('action') == 'add'){
            $data['path']  = $imgs;

            $res = $Update->data($data)->add();
        }else{
            $data['id'] = I('id' ,0 ,'intval');//intval($_GET['id']);
            if($imgs != '') $data['path'] = $imgs; //判断有无重新上传图片
            $res = $Update->save($data);
        }

        
        if($res){
            $this->success('操作成功' ,U('Update/index' ,'' ,''));
        }else{
            $this->error('操作失败');
        }

    }



}


?>