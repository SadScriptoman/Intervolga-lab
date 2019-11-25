
<script src="core/src/js/jquery-3.4.1.min.js" ></script>
<script src="core/src/js/mask.min.js" ></script>
<script src="core/src/js/custom-file-input.js" ></script>
<script src="core/src/bootstrap/bootstrap.bundle.min.js" ></script>


<script type="text/javascript">
   $(document).ready( function(){

        bsCustomFileInput.init()
        $("#tel").mask("(999) 999-99-99");

        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });

        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        if (vars["state"] == 0){
          $('#handlerModal').modal('show');
        }else if (vars["state"] == 1){
          $('#handlerModal').modal('show');
          $('#handlerModal').on('hidden.bs.modal', function (e) {
            window.location.href = window.location.origin + window.location.pathname;
          });
        }else if (vars["state"] == 2){
          $('#deleteModal').modal('show');
          $('#deleteModal').on('hidden.bs.modal', function (e) {
              window.location.href = window.location.origin + window.location.pathname;
          });
        }

        $("input[type='file']#image").change(function(e){
          $("#photo_preview").css({
            "width" : "auto",
            "margin-right" : "1rem"
          }); 
          var photo = $("#photo_preview #photo");
          if (photo.length == 0){
            $("#photo_preview").append('<img id="photo" width="<?=$_CONFIG['EMPLOYEES']["IMAGE_W"]?>" height="<?=$_CONFIG['EMPLOYEES']["IMAGE_H"]?>" src="'+URL.createObjectURL(event.target.files[0])+'" alt="Preview">');
          }else{
            photo.attr("src", URL.createObjectURL(event.target.files[0]));
          }
        });

   });
</script>

</body>
</html>