<footer class="py-3 text-white">
    <!--  <div class="container" style="margin-top: 4rem;">
    <p style="text-align: center;">Copyright &copy; <?= date('Y') ?>, Learn with Steve. All rights reserved.</p>
    <p style="text-align: center;">Powered by <?= $this->Html->link('CakePHP', 'https://cakephp.org') ?>.</p>
    </div> -->


    <div class="container">
        <div class="row border-bottom pt-5 pb-3">
            <div class="col-md-8">
                <h3 class="border-bottom">Site Links</h3>

                <div class="row">
                    <div class="col-md-6">
                        <ul class="pt-3">
                            <li>Home Page</li>
                            <li>About Me </li>
                            <li>My Main Website</li>
                        </ul>

                    </div>

                    <div class="col-md-6">
                        <ul class="pt-3">
                            <li>Bootstrap Website</li>
                            <li>Cakephp Website</li>
                            <li>"W3c Schools Website"</li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="col-md-4">
                <h3 class="border-bottom">Social Media</h3>
                <p class="text-white" style="font-size: 1.3rem;"><b>Follow me on the following platforms</b></p>
                <p class="text-white" style="font-size: 3rem;"><i class="bi bi-facebook"> </i> <i class="bi bi-instagram"> </i><i class="bi bi-twitter-x"> </i><i class="bi bi-youtube"></i></p>

                <hr>

                <h3 class="border-bottom">Email Me</h3>
                <p class="text-white">support@stevehouldey.me.uk</p>
                <p class="text-white">info@stevehouldey.me.uk</p>

            </div>
        </div>
        <div class="row">
            <div class="copyright">
                <p class="text-center text-white mx-auto pt-3">Created by S Houldey</p>
            </div>
        </div>
    </div>
</footer>



<?php // Include Bootstrap JS from CDN for any Bootstrap components used in the app 
?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>


<?= $this->element('modals/userlogout'); ?>

<!-- Initialize Tagify on the tags input field -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var input = document.querySelector('#tags-input');

        // Initialize Tagify
        var tagify = new Tagify(input, {
            delimiters: ",", // comma-separated
            maxTags: 10,
            dropdown: {
                enabled: 1 // disable suggestions dropdown
            }
        });

        // Optional: Listen for tag removal
        tagify.on('remove', function(e) {
            console.log("Removed tag:", e.detail.data.value);
        });
    });
</script>


</body>

</html>