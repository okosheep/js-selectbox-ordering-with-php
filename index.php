<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>SELECT BOXを順に送信</title>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>

<body>
    <h1>SELECT BOXを順に送信するサンプル</h1>
    <form action="second.php" method="post">
        <p id="selected"></p>
        <select id="select1" name="_select1[]" multiple="multiple">
            <option value="1">アイテム1</option>
            <option value="2">アイテム2</option>
            <option value="3">アイテム3</option>
            <option value="4">アイテム4</option>
            <option value="5">アイテム5</option>
            <option value="6">アイテム6</option>
            <option value="7">アイテム7</option>
            <option value="8">アイテム8</option>
        </select>
        <input type="submit" name="submit-button" value="サブミット">
    </form>
    <script>
        $(function() {
            $("#select1").on("mouseup", function() {

                // 表示しているリストに表示されていて選択されているものを取得
                var items = [];
                $("#select1>option").each(function(index, element) {
                    if ($(element).prop("selected")) {
                        items.push($(element).val());
                    }
                });

                // 前回までに選択されていた値を取得
                var last = [];
                $("input[name='select1[]']").each(function(index, element) {
                    last.push($(element).val());
                });

                // 前回までに選択されていて，今選択されていないものを削除
                var deleteValues = $(last).not(items).get();
                $(deleteValues).each(function(index, value) {
                    $("input[name='select1[]'][value='" + value + "']").remove();
                });

                // 差分を取得して，新しく選択されたアイテムを追加
                var newValues = $(items).not(last).get();
                $(newValues).each(function(index, value) {
                    $("<input />").appendTo($("#select1").parent())
                        .attr("type", "hidden")
                        .attr("name", "select1[]")
                        .attr("value", value);
                });
                
                // 選択した順番を表示
                var text = "選択順：";
                $("input[name='select1[]']").each(function(index, element) {
                    var value = $(element).val();
                    var item = $("#select1>option[value='" + value + "']");
                    text += item.text() + ", ";
                });
                $("#selected").text(text);
            });
            
            $("#selected").text("ここに選択した順で値を表示します。");
        });

    </script>
</body>

</html>
