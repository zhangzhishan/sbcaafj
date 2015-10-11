<?php

class ExcelToArray {  

  public function __construct() {  

       // Vendor("@.Extend.PHPExcel.PHPExcel");//引入phpexcel类(注意你自己的路径)  

        require dirname(__FILE__) . '/PHPExcel/PHPExcel.php';
       // echo dirname(__FILE__);
        //die;
       // Vendor("PHPExcel.PHPExcel.IOFactory");    
        require dirname(__FILE__) . '/PHPExcel/PHPExcel/IOFactory.php';

       // die;

  }    

  public function read($filename,$encode,$file_type){  
            if(strtolower ( $file_type )=='xls')//判断excel表类型为2003还是2007  
            {  
                //Vendor("PHPExcel.PHPExcel.Reader.Excel5");   

                require dirname(__FILE__) . '/PHPExcel/PHPExcel/IOFactory.php';
                $objReader = PHPExcel_IOFactory::createReader('Excel5');  
            }elseif(strtolower ( $file_type )=='xlsx')  
            {  
                //Vendor("PHPExcel.PHPExcel.Reader.Excel2007");   

                require dirname(__FILE__) . '/PHPExcel/PHPExcel/Reader/Excel2007.php';
                $objReader = PHPExcel_IOFactory::createReader('Excel2007');  
            }  
            $objReader->setReadDataOnly(true);  
            $objPHPExcel = $objReader->load($filename);  
            $objWorksheet = $objPHPExcel->getActiveSheet();  
            $highestRow = $objWorksheet->getHighestRow();  
            $highestColumn = $objWorksheet->getHighestColumn();  
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);  
            $excelData = array();  
            for ($row = 1; $row <= $highestRow; $row++) {  
                for ($col = 0; $col < $highestColumnIndex; $col++) {  
                    // $excelData[$row][] =(string)$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();  

                    if($col == 3){
                        $excelData[$row][] = (string)$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();  
                    }else{
                        $excelData[$row][] =(string)$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();  
                     }   
                }  
            }  
            return $excelData;  
      }  
 }


?>