<form action="index.php" method="post" enctype="multipart/form-data">

    <input type="file" name="arquivos[]" id="arquivos" multiple>
    <br />
    <button type="submit">uploads</button>
</form>


<?php

if(@$_FILES["arquivos"])
{
    $arquivos = @$_FILES["arquivos"];
    for ($i = 0; $i < count($arquivos["name"]); $i++ ) 
    {
        $data[$i]["nome_arquivo"] = $arquivos["name"][$i];
        $data[$i]["type"] = $arquivos["type"][$i];
        $data[$i]["tmp_name"] = $arquivos["tmp_name"][$i];
        $data[$i]["size"] = $arquivos["size"][$i];
    }

    foreach($data as $key => $value)
    {
        $filenameSplit = explode(".",$value["nome_arquivo"]);
        $file_extension = $filenameSplit[1];
        $filename = sha1($value["nome_arquivo"]).".jpg";
        $file = getcwd()."/upload/". $filename;
        if (move_uploaded_file($value["tmp_name"], $file)) {
            echo "<img src='./upload/".$filename ."' /><br />";
            echo "Arquivo válido e enviado com sucesso.<br />";
        } else {
            echo "Possível ataque de upload de arquivo!<br />";
        }
    }

    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";

}