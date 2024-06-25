<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Todo</title>
  <link rel="stylesheet" href="todo.css" />
</head>

<body>
  <div class="heading">
    <h2 class="heading1">TO DO LIST</h2>
  </div>
  
<?php
  $err = '';

  // Ensure user is logged in
  if (!isset($_SESSION['user_id'])) {
      header('Location: login.php');
      exit();
  }
?>

<form method="post" action="intro.php" class="input_form"> 
      <?php if (!empty($err)) { ?>
          <p><?php echo $err; ?></p>
      <?php } ?>

    <?php
    //getting the values, id & task from the URL
    if (isset($_GET['id']) && isset($_GET['task'])) {
      $id = $_GET['id'];
      $task = $_GET['task']; ?>
        <!-- fetching from database using id -->
        <form action="intro.php" method="post">
          <?php
        $todo = mysqli_query($db_conn2, "SELECT * FROM todos where id = $id");
        while ($row = mysqli_fetch_array($todo)) {
        //getting the entries from the query
    ?>
          <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
          <!--the value is the task we are currently editing-->
          <input type="text" name="input_task" class="input_task" placeholder="Enter a new task..." value="<?php echo $row['task'] ?>" />
          <button type="submit" name="update" id="update" class="add_task">
            Update Task
          </button>
        </form>
      <?php }} else { ?>
       <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
       <input type="text" name="input_task" class="input_task" placeholder="Enter a new task..." />
        <button type="submit" name="submit" id="add_task" class="add_task">
          Add Task
        </button>
  </form>
<?php } ?>
<table>
  <thead>
    <tr>
      <th>S/N</th>
      <th>Tasks</th>
      <th style="width: 60px">Operation</th>
    </tr>
  </thead>

  <tbody>
    <?php
    $todo = mysqli_query($db_conn2, "SELECT * FROM todos where user_id = ".$_SESSION['user_id']."");
    $i = 1;
    while ($row = mysqli_fetch_array($todo)) {
    ?>
      <tr>
        <td> <?php echo $i; ?> </td>
        <td class="task"> <?php echo $row["task"]; ?> </td>
        <td>
          <form action="intro.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
            <button type="submit" name="delete" id="delete" class="delete_task">
              DEL
            </button>
          </form>
        </td>
        <td>
          <form action="intro.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
            <input type="hidden" name="task" value="<?php echo $row['task'] ?>">
            <button type="submit" name="edit" id="edit" class="edit_task">
              EDIT
            </button>
          </form>
        </td>
      </tr>
    <?php
      $i++;
    }
    ?>
  </tbody>
</table>
</body>
</html>