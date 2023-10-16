<?php


function add_custom_menu_item() {
    add_menu_page(
        'Social manager',   // Titolo del menu
        'Social manager',   // Etichetta nel menu
        'manage_options',    // Capacità richiesta per accedere
        'social-manager',  // Slug univoco del menu
        'display_custom_menu_item' // Callback per visualizzare il contenuto della pagina
    );
}

function display_custom_menu_item() {
    if (!current_user_can('manage_options')) {
        wp_die('Accesso negato');
    }
    if(isset($_POST['form1']) || isset($_POST['form2'] ) || isset($_POST['form3'] )){
        echo '<meta http-equiv="refresh" content="1">';
        echo '<div class="updated overlay-message"><p>Le impostazioni sono state salvate con successo</p></div>';

    }
    $pages = get_pages();



    echo '<h1>Options social menager</h1>';
    echo '<p class= "description">Inserisci i link ai tuoi profili social</p>'; 
    echo '<form method="post" >';
    // tabella con impostazione del plugin
    echo '<div class="wrap">';
    echo '<table class="form-table">';
    echo '<tr valign="top">';
    echo '<th scope="row">Facebook</th>';
    echo '<td><input type="text" name="facebook" value="' . esc_attr(get_option('facebook')) . '" /></td>';
    echo '</tr>';
    echo '<tr valign="top">';
    echo '<th scope="row">Twitter</th>';
    echo '<td><input type="text" name="twitter" value="' . get_option('twitter') . '" /></td>';
    echo '</tr>';

    echo '<tr valign="top">';
    echo '<th scope="row">Pinterest</th>';
    echo '<td><input type="text" name="pinterest" value="' . get_option('pinterest') . '" /></td>';
    echo '</tr>';
    echo '<tr valign="top">';
    echo '<th scope="row">Linkedin</th>';
    echo '<td><input type="text" name="linkedin" value="' . get_option('linkedin') . '" /></td>';
    echo '</tr>';
    echo '<tr valign="top">';
    echo '<th scope="row">Youtube</th>';
    echo '<td><input type="text" name="youtube" value="' . get_option('youtube') . '" /></td>';
    echo '</tr>';
    echo '<tr valign="top">';
    echo '<th scope="row">Instagram</th>';
    echo '<td><input type="text" name="instagram" value="' . get_option('instagram') . '" /></td>';
    echo '</tr>';
    echo '</table>';
    // pulsante di invio
    echo '<p class="submit">';
    echo '<input name="form1" type="submit" class="button-primary" value="Save Changes" />';
    echo '</p>';
    echo '</form>';
    echo '</div>';




    //separo con una linea
    echo '<hr>';
    echo '<h1>POSIZIONE</h1>';
    echo '<p class= "description">Inserisci la posizione dove vuoi visualizzare i link ai social</p>';
    echo '<form method="post" action="#">';
    echo '<div class="wrap">';
    echo '<table class="form-table">';
    echo '<tr valign="top">';
    echo '<th scope="row">Posizione</th>';
   
    //select    


    echo '<td><select name="posizione">';
    echo '<option value="header" ' . selected(get_option('posizione'), 'header', false) . '>Header</option>';
    echo '<option value="footer" ' . selected(get_option('posizione'), 'footer', false) . '>Footer</option>';
    echo '<option value="both" ' . selected(get_option('posizione'), 'both', false) . '>Both</option>';
    echo '<option value="deactive" ' . selected(get_option('posizione'), 'deactive', false) . '>Deactive</option>';
    echo '</select></td>';
    echo '</tr>';
    //faccio scegliere se visualizzare a destra o a sinistra o al centro
    echo '<tr valign="top">';
    echo '<th scope="row">Posizione</th>';
    echo '<td><select name="pos">';
    echo '<option value="left" ' . selected(get_option('pos'), 'left', false) . '>Left</option>';
    echo '<option value="center" ' . selected(get_option('pos'), 'center', false) . '>Center</option>';
    echo '<option value="right" ' . selected(get_option('pos'), 'right', false) . '>Right</option>';
    echo '</select></td>';
    echo '</tr>';
    echo '</table>';
    echo '<p class="submit">';
    echo '<input name="form2" type="submit" class="button-primary" value="Save Changes" />';
    echo '</p>';
    echo '</form>';
    echo '</div>';
    //separo con una linea
    echo '<hr>';

    //faccio selezionare le pagine in cui visualizzare le pagine dove visualizzare i link ai social
    echo '<h1>PAGINE</h1>';
    echo '<p class= "description">Seleziona le pagine dove vuoi visualizzare i link ai social</p>';
    echo '<form method="post" action="#">';
    echo '<div class="wrap">';
    echo '<table class="form-table">';
    echo '<tr valign="top">';
    echo '<th scope="row">Pagina</th>';

    //creo dei checkbox con le pagine
    $page_selected = get_option('page');
    foreach ($pages as $page) {
        echo '<tr>';
        echo '<td>'.$page->post_title.'</td>';
        echo '<td><input type="checkbox" name="page[]" value="' . $page->ID . '" ' . checked(in_array($page->ID, $page_selected), true, false) . ' /></td>';
        echo '</tr>';

    }    

    echo '</table>';
    echo '<p class="submit">';
    echo '<input name="form3" type="submit" class="button-primary" value="Save Changes" />';
    echo '</p>';
    echo '</form>';
    echo '</div>';

 


    


    
    if (isset($_POST['form1'])) {
        // Prendo i dati del form
        $facebook = $_POST['facebook'];
        $twitter = $_POST['twitter'];
        $google = $_POST['google'];
        $pinterest = $_POST['pinterest'];
        $linkedin = $_POST['linkedin'];
        $youtube = $_POST['youtube'];
        $instagram = $_POST['instagram'];
    
        // Salvo i dati
        update_option('facebook', $facebook);
        update_option('twitter', $twitter);
        update_option('google', $google);
        update_option('pinterest', $pinterest);
        update_option('linkedin', $linkedin);
        update_option('youtube', $youtube);
        update_option('instagram', $instagram);
    
    }
    
    if (isset($_POST['form2'])) {
        // Prendo i dati del form
        $posizione = $_POST['posizione'];
        $pos = $_POST['pos'];
        
        // Salvo i dati
        update_option('posizione', $posizione);
        update_option('pos', $pos);

    }
    if (isset($_POST['form3'])) {
        // Prendo i dati del form
        $page = $_POST['page'];
    
        // Salvo i dati
        update_option('page', $page);

    }
    


}

add_action('admin_menu', 'add_custom_menu_item');


?>