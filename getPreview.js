document.getElementById('preview').addEventListener('click', function() {

    let title = document.getElementById('title');
    let content = document.getElementById('content');
    let blogF1 = document.querySelector('#blog-form input[type="text"]');
    let blogF2 = document.querySelector('#blog-form textarea');


    // Prevent red from occuring if user types
    title.addEventListener('input', function() {
      blogF1.style.backgroundColor = "white";

    });
    
    content.addEventListener('input', function() {
      blogF2.style.backgroundColor = "white";

    });


    if(title.value.trim() == "" || content.value.trim() == "") {

      if(title.value.trim() == "" && content.value.trim() == "") {
        blogF2.style.backgroundColor = "#9200002d";
        blogF1.style.backgroundColor = "#9200002d";
  
      }else if(title.value.trim() == "") {
        blogF1.style.backgroundColor = "#9200002d";
  
      }else{
        blogF2.style.backgroundColor = "#9200002d";
      }
  
    alert("Fill the form out");
    return;
    }
    
    // Create a form to send data to preview.php
    let form = document.querySelector('#blog-form form');
    form.action = 'preview.php';
    form.submit();

  });