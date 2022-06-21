<?php

if(is_uploaded_file($_FILES["csvfile"]["tmp_name"])){
    $file_tmp_name = $_FILES["csv_file"]["tmp_name"];
    $file_name = $_FILES["csv_file"]["name"];

    //拡張子判定
    if(pathinfo($file_name, PATHINFO_EXTENSION) != 'csv') {
        $err_msg = "CSVファイルをアップロードしてください";
    }else{
        if(move_uploaded_file($file_tmp_name, "./uploaded/" . $file_name)){
            chmod("./uploaded/" . $file_name, 0644);
            $msg = $file_name . "アップロード成功";
            $file = "./uploaded/" . $file_name;
            $fp = fopen($file, "r");

            while(($data = fgetcsv($fp, 0, ",")) !== FALSE){
                $asins[] = $data;
            }
            fclose($fp);
            unlink("./uploaded/" . $file_name);
        }else{
            $err_msg = "エラーが発生しました";
        }
    }
}

?>