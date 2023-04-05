<?php
include('../connectiondb.php');

if (isset($_POST['row_id'])) {
  $row_id = $_POST['row_id'];

  // Retrieve the latest version of the content
  $stmt = $pdo->prepare("SELECT content FROM my_table WHERE id = :id");
  $stmt->bindParam(':id', $row_id);
  $stmt->execute();
  $row = $stmt->fetch();

  // Check if the content has changed
  $has_changes = false;
  if ($row['content'] != $_SESSION['content']) {
    $has_changes = true;
    $_SESSION['content'] = $row['content'];
  }

  // Return a JSON response
  $response = array(
    'has_changes' => $has_changes,
    'content' => $row['content']
  );
  echo json_encode($response);
}
?>