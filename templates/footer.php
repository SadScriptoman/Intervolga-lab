<? if (($jquery) || ($mask) || ($bootstrap) || ($all_scripts)): ?><script src="src/js/jquery-3.4.1.min.js" ></script><? endif;?>
<? if (($mask) || ($all_scripts)): ?><script src="src/js/mask.min.js" ></script><? endif;?>
<? if (($bootstrap) || ($all_scripts)): ?><script src="bootstrap/bootstrap.bundle.min.js" ></script><? endif;?>

<? if (($mask) || ($anchor) || ($all_scripts)): ?> <script type="text/javascript">
    <? if (($anchor)|| ($all_scripts)): ?>
      $(function(){
        $(".back-to-top").click(function(){
          var _href = $(this).attr("href");
          $("html, body").animate({scrollTop: $(_href).offset().top+"px"});
          return false;
        });
      });
    <? endif;?>
    <? if (($mask) || ($all_scripts)): ?>
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
    <? endif;?>
</script>
<? endif;?>

</body>
</html>