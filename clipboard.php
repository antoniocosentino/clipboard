<?
$fileName = "clipboard_content.txt";
$newData = $_POST['content'];

if ($newData) {
    $myfile = fopen($fileName, "w") or die("Unable to open file!");
    fwrite($myfile, $newData);
    fclose($myfile);
    exit;
}

$myfile = fopen($fileName, "r") or die("Unable to open file!");
$content = fread($myfile, filesize($fileName));
fclose($myfile);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kose Clipboard</title>

    <style>
        textarea {
            padding: 20px;
            border: none;
            outline: none;
            width: calc(100% - 40px);
        }
    </style>

</head>

<body>

    <textarea cols="60" rows="10"><?= $content ?></textarea>

    <script>
        const initializeTextarea = () => {
            const textAreaElement = document.querySelector('textarea');

            let debounceTimeout;

            textAreaElement.addEventListener("input", (event) => {
                const newVal = event.target.value;

                clearTimeout(debounceTimeout);
                debounceTimeout = setTimeout(() => {
                    const formData = new FormData();
                    formData.append('content', newVal);

                    fetch(window.location.href, {
                        method: "POST",
                        body: formData
                    });
                }, 300);
            });
        };

        initializeTextarea();
    </script>
</body>

</html>