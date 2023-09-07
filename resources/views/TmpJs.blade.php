<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Document</title>
</head>
<body>
<script>
    let TmpUrl = `'https://xxxxxxxxxxxxxxxxx'`;
    fetch(TmpUrl)
        // 回應的資料型態
        .then((response) => {
            return response.json();
        })
        // 後端回應結果資料
        .then((response) => {
            console.log(response);
        })
        // 後端發生異常回應位置
        .catch((error) => {
            console.log(`Error: ${error}`);
        })
</script>
</body>
</html>
