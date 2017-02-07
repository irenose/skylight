<section>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
    <?php
        $encoded_address = $installer_array[0]->address . '+' . $installer_array[0]->city . ',' . $installer_array[0]->state . '+' . $installer_array[0]->zip;
    ?>
    <div id="map" data-lat="<?=$installer_array[0]->latitude; ?>" data-long="<?=$installer_array[0]->longitude; ?>" data-address="<?=$encoded_address; ?>"></div>
</section>