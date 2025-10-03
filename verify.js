
let reset = document.querySelector('button[type="reset"]');
reset.addEventListener('click', check);


function check(e) {
  e.preventDefault();
  let confirmed = confirm("Are you sure you want to clear the form?");
  if (confirmed) {
    document.querySelector('#blog-form form').reset();
    window.location.href = 'clearSessionVar.php';
  }

}