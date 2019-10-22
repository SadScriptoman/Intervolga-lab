<script src="src/js/jquery-3.4.1.min.js" ></script>
<script src="src/js/mask.min.js" ></script>
<script src="bootstrap/bootstrap.bundle.min.js" ></script>

<script type="text/javascript">
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      $("#tel").mask("(999) 999-99-99");
      let forms = document.getElementsByClassName('needs-validation');
      let validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
</script>

</body>
</html>