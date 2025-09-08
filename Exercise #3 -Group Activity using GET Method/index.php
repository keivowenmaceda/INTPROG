<?php
$team = [
    [
        "name" => "David James",
        "location" => "Bacoor City",
        "phone" => "0906346900",
        "facebook" => "https://www.facebook.com/davidiamsepolon",
        "github" => "https://github.com/DavidJamesPolon/INTPROG-1",
        "img" => "david james.png"
    ],
    [
        "name" => "Keiv Owen",
        "location" => "Poblacion Muntinlupa",
        "phone" => "8-7000",
        "facebook" => "https://www.facebook.com/Keivthegreyt",
        "github" => "https://www.facebook.com/Keivthegreyt",
        "img" => "keiv owen .png"
    ],
    [
        "name" => "Mark Pimentel",
        "location" => "Alabang magmamahal d'yan?",
        "phone" => "09929864285",
        "facebook" => "https://www.facebook.com/pimentel24",
        "github" => "https://github.com/markyyy-dev",
        "img" => "mark pimentel.png"
    ]
];

// GET method: pick a member if ?member=index is set
$selected = isset($_GET['member']) ? (int)$_GET['member'] : null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pro Salita</title>
    <style>
      body {
    background-image: url(blackk.jpg);
    background-attachment: fixed;
    background-size: 100% 100%;
    color: #ffffff;
}
/*Header*/
header {
    text-align: center;
    padding: 20px 0;
    background-color: #000000;
    border-bottom: 2px solid #ffffff;
}
header h1 {
    font-size: 2.5em;
    color: #ffffff;
    letter-spacing: 2px;
}
/*Team section*/
.team {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    margin-top: 30px;
}
/*Member card*/
.member {
    background-color: #111111;
    border-radius: 10px;
    padding: 20px;
    margin: 10px;
    width: 280px;
    text-align: center;
    transition: transform 0.3s ease;
}
.member:hover {
    transform: translateY(-5px);
}
/*Member image*/
.member img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 15px;
    border: 3px solid #ffffff;
}
/*Member name*/
.member h3 {
    font-size: 1.4em;
    color: #ffffff;
    margin-bottom: 5px;
}
/*Member description*/
.member strong {
    display: block;
    color: #cccccc;
    margin-bottom: 10px;
}
/*Contact info*/
.content {
    font-size: 0.95em;
    margin-bottom: 10px;
    color: #dddddd;
}
/*Links*/
.member a {
    display: inline-block;
    margin: 5px;
    padding: 8px 12px;
    background-color: #000000;
    color: #ffffff;
    text-decoration: none;
    border: 1px solid #ffffff;
    border-radius: 5px;
    font-size: 0.9em;
    transition: background-color 0.3s ease, color 0.3s ease;
}
.member a:hover {
    background-color: #ffffff;
    color: #000000;
 }
    </style>
</head>
<body>
    <h1>Pro Salita Team</h1>
    <section class="team">
        <?php 
        if ($selected !== null && isset($team[$selected])): 
            // Show only selected member
            $member = $team[$selected]; ?>
            <div class="member">
                <img src="<?= $member['img'] ?>" alt="<?= $member['name'] ?>">
                <h3><?= $member['name'] ?></h3>
                <strong><?= $member['location'] ?></strong>
                <p class="content">📞 <?= $member['phone'] ?></p>
                <a href="<?= $member['facebook'] ?>" target="_blank">Facebook</a>
                <a href="<?= $member['github'] ?>" target="_blank">GitHub</a>
                <button onclick="toggleContent(this)">Toggle Contact</button>
            </div>
            <p><a href="index.php" style="color:white;">🔙 Back to All</a></p>
        <?php else: 
            // Show all members
            foreach ($team as $index => $member): ?>
            <div class="member">
                <img src="<?= $member['img'] ?>" alt="<?= $member['name'] ?>">
                <!-- Add GET link -->
                <h3><a href="?member=<?= $index ?>" style="color:white;"><?= $member['name'] ?></a></h3>
                <strong><?= $member['location'] ?></strong>
                <p class="content">📞 <?= $member['phone'] ?></p>
                <a href="<?= $member['facebook'] ?>" target="_blank">Facebook</a>
                <a href="<?= $member['github'] ?>" target="_blank">GitHub</a>
                <button onclick="toggleContent(this)">Toggle Contact</button>
            </div>
            <?php endforeach; 
        endif; ?>
    </section>

    <script>
        function toggleContent(button) {
            const content = button.parentElement.querySelector(".content");
            content.classList.toggle("show");
        }
    </script>
</body>
</html>
