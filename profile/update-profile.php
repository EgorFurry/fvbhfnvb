<?php
// Получаем данные из формы
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Проверяем, что данные получены
if ($username && $email) {
    // Обработка данных (например, обновление в базе данных)
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Пример использования MySQL (предполагается, что у вас настроена база данных)
    $mysqli = new mysqli("localhost", "root", "", "your_database");

    if ($mysqli->connect_error) {
        die("Ошибка подключения: " . $mysqli->connect_error);
    }

    $stmt = $mysqli->prepare("UPDATE users SET username=?, email=?, password=? WHERE user_id=?");
    $stmt->bind_param("sssi", $username, $email, $hashedPassword, $userId);

    if ($stmt->execute()) {
        echo "Профиль успешно обновлен!";
    } else {
        echo "Ошибка: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
} else {
    echo "Пожалуйста, заполните все обязательные поля!";
}
?>
