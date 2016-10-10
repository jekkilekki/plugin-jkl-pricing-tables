<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="wrap">
    <h1>JKL Pricing Tables Options</h1>
    <form method="post" action="options.php">
        <?php
            settings_fields( 'jklpt_options' );
            do_settings_sections( 'jklpt_options' );
            submit_button();
            ?>
    </form>
</div>

<?php
