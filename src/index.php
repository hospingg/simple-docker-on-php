<?php
$jsonFilePath = 'users.json';

class MyProfile {
    public $firstname;
    public $lastname;
    public $image;
    public $city;
    public $phoneNumber;

    public function __construct($firstname, $lastname, $image, $city, $phoneNumber) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->image = $image;
        $this->city = $city;
        $this->phoneNumber = $phoneNumber;
    }
}

$myProfile = new MyProfile("Anzhelika", "Yusiuk", "assets/images/userImg.png", 'Запоріжжя', '+380687379608');

function getImageSrc($src) {
    $defaultImage = "assets/images/unknow.jpg";
    return htmlspecialchars($src) !== '' ? htmlspecialchars($src) : $defaultImage;
}

function getInfo($info) {
    $unknowInfo = "невідоме";
    return htmlspecialchars($info) !== '' ? htmlspecialchars($info) : $unknowInfo;
}


if (!file_exists($jsonFilePath)) {
    die('Файл не знайдено');
}

$jsonData = file_get_contents($jsonFilePath);

$users = json_decode($jsonData, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die('Помилка декодування JSON');
}
?>
<!DOCTYPE html>
    <html lang="uk">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="styles/style.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <title>Facebook</title>
        </head>
        <body>
            <img class="banner" src="assets/images/banner.jpg" alt="Banner">

            <div class="profile-container">
                <img class="profile-img" src="<?php echo getImageSrc($myProfile->image); ?>" alt="Profile Image">
                <div class="user-profile-info">
                    <h1 class="user-name"><?php echo htmlspecialchars($myProfile->firstname . ' ' . $myProfile->lastname); ?></h1>
                    <span>друзі: <?php echo count($users); ?></span>
                    <ul class="user-list">
                        <?php foreach ($users as $user): ?>
                            <li class="friend-card-list">
                                <img class="friend-list-img" src="<?php echo getImageSrc($user['src']); ?>" alt="Friend Image">
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="wrapper about-me">
                <h4>Про вас:</h4>
                <p>Місте народження: <?php echo htmlspecialchars($myProfile->city); ?></p>
                <p>Номер телефону: <?php echo htmlspecialchars($myProfile->phoneNumber); ?></p>
            </div>
            <div class="wrapper">
                <h4>Ваші друзі:</h4>
                <table class="friends-table-list">
                    <thead>
                        <tr>
                            <th>Фото</th>
                            <th>Ім'я та прізвище</th>
                            <th class="more-info-coll">Детальна інформація</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td>
                                    <img class="friends-table-img" src="<?php echo getImageSrc($user['src']); ?>" alt="Friend Table Image">
                                </td>
                                <td><p class="table-name"> <?php echo htmlspecialchars($user['firstname']); ?>
                                <?php echo htmlspecialchars($user['lastname']); ?></p></td>
                                <td class="more-info-coll">
                                    <?php echo getInfo($user['city']) ?> <i class="fa-solid fa-location-dot"></i> <br>
                                    <?php echo getInfo($user['phoneNumber']) ?><i class="fa-solid fa-phone"></i> 
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- <div class="container">
                <h4>Ваші друзі:</h4>
                <?php foreach ($users as $user): ?>
                    <div class="item">
                        <h2><?php echo htmlspecialchars($user['firstname']); ?></h2>
                        <p><?php echo htmlspecialchars($user['lastname']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div> -->
        </body>
    </html>
