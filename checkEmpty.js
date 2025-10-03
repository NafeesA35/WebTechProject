let submit = document.querySelector('#blog-form form button[type="submit"]');
submit.addEventListener('click', check);

function check(e) {
  e.preventDefault();
  let title = document.querySelector('input[id="title"]');
  let content = document.querySelector('textarea[id="content"]');
  let blogF1 = document.querySelector('#blog-form input[type="text"]');
  let blogF2 = document.querySelector('#blog-form textarea');

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

  }else{
    blogF1.style.backgroundColor = "white";
    blogF2.style.backgroundColor = "white";
    document.querySelector('#blog-form form').submit()
  }

}