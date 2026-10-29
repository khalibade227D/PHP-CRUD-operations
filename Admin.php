<?php
session_start();

require_once 'include/dbh.php';
require_once 'include/auth.php';
require_Admin_login();

$query = "SELECT id, name, email FROM user ORDER BY id ASC";
$stmt = $conn->prepare($query);
$stmt->execute();

$user = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/Admin.css">
  <title>Admin Panel</title>
</head>

<body>

  <header class="topbar">
    <span class="topbar-title">Admin Panel</span>
    <a href="logout.php" class="btn btn-light">Log out</a>
  </header>

  <!-- add user Modal -->
  <div class="modal" id="myModal" aria-hidden="true">
    <section class="modal-content"
      role="dialog"
      aria-modal="true"
      aria-labelledby="modalTitle">

      <header class="modal-header">
        <h1 id="modalTitle">Add User</h1>
        <button class="close-button"
          id="closeModal"
          type="button"
          aria-label="Close modal">×</button>
      </header>

      <form id="userForm"
        action="include/Admin-formhandler.php"
        method="POST">

        <div class="form-group">
          <label for="userName">Name</label>
          <input type="text"
            id="userName"
            name="name"
            placeholder="Enter the user's name"
            autocomplete="name"
            required>
        </div>

        <div class="form-group">
          <label for="userEmail">Email</label>
          <input type="email"
            id="userEmail"
            name="email"
            placeholder="you@example.com"
            autocomplete="email"
            required>
        </div>

        <div class="form-group">
          <label for="userPwd">Password</label>
          <input type="password"
            id="userPwd"
            name="pwd"
            placeholder="Enter at least 8 characters"
            minlength="8"
            autocomplete="new-password"
            required>
        </div>

        <footer class="modal-footer">
          <button class="cancel-button"
            id="cancelModal"
            type="button">Cancel</button>

          <button class="save-button"
            name="addUser"
            type="submit">Add User</button>
        </footer>
      </form>
    </section>
  </div>

  <!-- edit user  Modal -->
  <div class="modal" id="myModal2" aria-hidden="true">
    <section class="modal-content"
      role="dialog"
      aria-modal="true"
      aria-labelledby="modalTitle">

      <header class="modal-header">
        <h1 id="modalTitle">Edit User</h1>
        <button class="close-button"
          id="closeModal2"
          type="button"
          aria-label="Close modal">×</button>
      </header>

      <form id="userForm2"
        action="include/edituser.php"
        method="POST">

        <input type="hidden" id="editUserId" name="id" value="">

        <div class="form-group">
          <label for="editUserName">Name</label>
          <input type="text"
            id="editUserName"
            name="name"
            placeholder="Enter the user's name"
            autocomplete="name"
            required>
        </div>

        <div class="form-group">
          <label for="editUserEmail">Email</label>
          <input type="email"
            id="editUserEmail"
            name="email"
            placeholder="you@example.com"
            autocomplete="email"
            required>
        </div>

        <footer class="modal-footer">
          <button class="cancel-button"
            id="cancelModal2"
            type="button">Cancel</button>

          <button class="save-button"
            name="editUser"
            type="submit">Save User</button>
        </footer>
      </form>
    </section>
  </div>
  <main class="container">

    <section class="welcome">
      <h1>Welcome, Admin</h1>
      <p>Here, you can manage your users.</p>
    </section>

    <section class="card">
      <div class="card-header">
        <h2>User List</h2>
        <a id="add" href="" class="btn btn-main">+ Add User</a>
      </div>

      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>EDit</th>
               <th>Delete</th>
            </tr>
          </thead>

          <tbody>
            <?php
            //  if (empty($user)):
               ?>
              <!-- <tr> -->
                <!-- <td colspan="4">No users found.</td>
              </tr> -->
            <?php
          //  else:
            ?>

              <?php foreach ($user as $u): ?>
                <tr>
                  <td>
                    <?= (int) $u['id'] ?>
                  </td>

                  <td>
                    <?= htmlspecialchars(
                      $u['name']
                    ) ?>
                  </td>

                  <td>
                    <?= htmlspecialchars(
                      $u['email']
                    ) ?>
                  </td>
                    <form
                      action="include/deleteuser.php"
                      method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this user?');"
                      style="display:inline;">

                  <td class="actions">
                    <a class="btn btn-edit edit-btn"
                      href="#"
                      data-id="<?= (int) $u['id'] ?>"
                      data-name="<?= htmlspecialchars($u['name']) ?>"
                      data-email="<?= htmlspecialchars($u['email']) ?>">
                      Edit
                    </a>
                  </td>

                  <td>
                      <button
                        type="submit"
                        name="DeleteBTN"
                        value="1"
                        class="btn btn-delete">
                        Delete
                      </button>
                  </td>
                    <!-- </a> -->
                      <!-- <input
                        type="hidden"
                        name="id"
                        value="
                        // (int) $u['id'] 
                         -->
                    
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>

  </main>

  <script>
    const modal = document.getElementById("myModal");
    const form = document.getElementById("userForm");
       const modal2 = document.getElementById("myModal2");
    const form2 = document.getElementById("userForm2");

    function openModal() {
      modal.classList.add("open");
      modal.setAttribute("aria-hidden", "false");
      document.getElementById("userName").focus();
    }

    function closeModal() {
      modal.classList.remove("open");
      modal.setAttribute("aria-hidden", "true");
      form.reset();
    }
    function openModal2(id, name, email) {
      document.getElementById("editUserId").value = id;
      document.getElementById("editUserName").value = name;
      document.getElementById("editUserEmail").value = email;
      modal2.classList.add("open");
      modal2.setAttribute("aria-hidden", "false");
      document.getElementById("editUserName").focus();
    }

    function closeModal2() {
      modal2.classList.remove("open");
      modal2.setAttribute("aria-hidden", "true");
      form2.reset();
    }

    document.getElementById("add").addEventListener("click", function(event) {
      event.preventDefault();
      openModal();
    });

    // Delegate click for all edit buttons
    document.addEventListener("click", function(event) {
      const btn = event.target.closest(".edit-btn");
      if (btn) {
        event.preventDefault();
        openModal2(btn.dataset.id, btn.dataset.name, btn.dataset.email);
      }
    });

    document.getElementById("closeModal")
      .addEventListener("click", closeModal);

    document.getElementById("cancelModal")
      .addEventListener("click", closeModal);

    modal.addEventListener("click", function(event) {
      if (event.target === modal) {
        closeModal();
      }
    });
        document.getElementById("closeModal2")
      .addEventListener("click", closeModal2);

    document.getElementById("cancelModal2")
      .addEventListener("click", closeModal2);

    modal2.addEventListener("click", function(e) {
      if (e.target === modal2) {
        closeModal2();
      }
    });
  </script>

</body>

</html>