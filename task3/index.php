<?
function arrayFromCSV($file, $hasFieldNames = false, $delimiter = ',') {
    $result = Array();
    $size = filesize($file) +1;
    $file = fopen($file, 'r');
    #TO DO: There must be a better way of finding out the size of the longest row... until then
    if ($hasFieldNames) $keys = fgetcsv($file, $size, $delimiter);
    while ($row = fgetcsv($file, $size, $delimiter)) {
        $n = count($row); $res=array();
        for($i = 0; $i < $n; $i++) {
            $idx = ($hasFieldNames) ? $keys[$i] : $i;
            $res[$idx] = $row[$i];
        }
        $result[] = $res;
    }
    fclose($file);
    return $result;
}
$arResult = arrayFromCSV('test.csv');
?>
<style>
    table.minimalistBlack {
        border: 1px solid #000000;
        text-align: center;
        border-collapse: collapse;
    }
    table.minimalistBlack td, table.minimalistBlack th {
        border: 1px solid #000000;
        padding: 5px 4px;
    }
    table.minimalistBlack tbody td {
        font-size: 13px;
    }
    table.minimalistBlack thead {
        background: #DDDDDD;
        border-bottom: 1px solid #000000;
    }
    table.minimalistBlack thead th {
        color: #000000;
        text-align: center;
    }
</style>
<table class="minimalistBlack">
    <tbody>
    <? foreach($arResult as $arItems): ?>
        <tr>
            <? for($i = 0; $i < count($arItems); $i++): ?>
                <td><?= $arItems[$i] ?></td>
            <? endfor;?>
        </tr>
    <? endforeach;?>
    </tbody>
</table>

<form method="post" enctype="multipart/form-data">
    <span>Отправить CSV файл</span>
    <input type="file" name="file" required>
    <input type="submit">
    <input type="hidden" name="check" value="check">
</form>
<? if(isset($_POST['check'])):
    $uploadfile =  basename(uniqid() . '.csv');
    $result = move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
    $arResult = arrayFromCSV($uploadfile);
    ?>
    <span>CSV загруженный из формы</span>
    <table class="minimalistBlack">
        <tbody>
        <? foreach($arResult as $arItems): ?>
            <tr>
                <? for($i = 0; $i < count($arItems); $i++): ?>
                    <td><?= $arItems[$i] ?></td>
                <? endfor;?>
            </tr>
        <? endforeach;?>
        </tbody>
    </table>
<? endif; ?>