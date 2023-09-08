<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerName = $_POST["customerName"];
    $checkInDate = $_POST["checkInDate"];
    $totalDays = intval($_POST["totalDays"]);
    $totalPersons = intval($_POST["totalPersons"]);
    $roomType = $_POST["roomType"];
    $amenities = isset($_POST["amenities"]) ? implode(", ", $_POST["amenities"]) : "";
    $roomRates = floatval($_POST["roomRates"]);
    $payment = floatval($_POST["payment"]);
    $balance = floatval($_POST["balance"]);
    $advanceAmount = floatval($_POST["advanceAmount"]);
    $additionalCharges = floatval($_POST["additionalCharges"]);
    $extraPersonCost = floatval($_POST["extraPersonCost"]);
    $roomCost = 0;
    if ($roomType == "deluxe") {
        $roomCost = 2500;
    } elseif ($roomType == "suite") {
        $roomCost = 4000;
    }
    $totalRoomCost = $roomCost * $totalDays;
    $totalCost = $totalRoomCost + $advanceAmount + $additionalCharges;
    $dbHost = "test";
    $dbUser = "test@1234";
    $dbPass = "idon'tknow";
    $dbName = "hotel_booking";

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO bookings (customerName, checkInDate, totalDays, totalPersons, roomType, amenities, roomRates, payment, balance, totalRoomCost, advanceAmount, totalCost, additionalCharges, extraPersonCost)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssiiissddddd", $customerName, $checkInDate, $totalDays, $totalPersons, $roomType, $amenities, $roomRates, $payment, $balance, $totalRoomCost, $advanceAmount, $totalCost, $additionalCharges, $extraPersonCost);

        if ($stmt->execute()) {
            echo "<p class='text-green-600 font-semibold'>Booking successfully recorded.</p>";
        } else {
            echo "<p class='text-red-600 font-semibold'>Error: Unable to insert data.</p>";
        }

        $stmt->close();
    } else {
        echo "<p class='text-red-600 font-semibold'>Error: " . $conn->error . "</p>";
    }

    $conn->close();
}
?>
