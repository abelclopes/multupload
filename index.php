<form action="index.php" method="post" enctype="multipart/form-data">

    <input type="file" name="arquivos[]" id="arquivos" multiple>
<br />
    <button type="submit">uploads</button>
</form>


<?php

if($_FILES["arquivos"])
{
    $arquivos = $_FILES["arquivos"];
    for ($i = 0; $i < count($arquivos["name"]); $i++ ) 
    {
        $data[$i]["nome_arquivo"] = $arquivos["name"][$i];
        $data[$i]["type"] = $arquivos["type"][$i];
        $data[$i]["tmp_name"] = $arquivos["tmp_name"][$i];
        $data[$i]["size"] = $arquivos["size"][$i];
    }

    foreach($data as $key => $value)
    {
       echo $file = getcwd()."/upload/". sha1_file($value["nome_arquivo"]);
       move_uploaded_file($value["tmp_name"], $file );

    }

    echo "<pre>";
    print_r($data);
    echo "</pre>";

}