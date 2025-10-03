<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <base href="http://localhost/WebTechCW/">
  <title>Personal Portfolio Website</title>
  <link rel="stylesheet" href="reset.css">
  <link rel="stylesheet" href="style.css">
  <script src="checkEmpty.js" defer></script>
  <script src="verify.js" defer></script>
  <script src="getPreview.js" defer></script>
</head>
<body>

  <header>
      <section id="NavBar">
        <nav>
          <div class="NavDivA">
            <form method="POST" action="logout.php">
                <button type="submit" class="button-main-logout">Logout</button>
            </form>
          </div>
        </nav>
      </section>
  </header>

  <section id="blog-form">
  <form method="POST" action="addPost.php">
      <div class="fieldset-div">
        <fieldset>
          <legend> Create a Blog Post </legend>

          <label for="title">Title:</label>
          <input type="text" id="title" name="title" value="<?php 
                if(isset($_SESSION['title'])) {
                    echo $_SESSION['title']; 
                } else {
                    echo '';
                }
            ?>">

          <label for="content">Content:</label>
          <textarea id="content" name="content"><?php 
              if(isset($_SESSION['content'])) {
                  echo $_SESSION['content'];
              } else {
                  echo '';
              }
          ?></textarea>

          <div class="button-style">
            <button type="submit" class="button-itself">Post</button>
            <button type="reset" class="button-itself">Clear</button>
            <button type="button" id="preview" class="button-itself">Preview</button>
          </div>
        </fieldset>
        
      </div>

    </form>
  </section>

</body>
</html>