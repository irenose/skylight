<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title></title>
        <meta name="robots" content="noindex, nofollow">
        <link rel="canonical" href="<?=base_url() ?>bz-container"/>
    </head>
    <body>
        <script type="text/javascript" src="<?=$this->config->item('bazaarvoice_js_link')?>"></script>
        <script>
            $BV.container('global', {});
        </script>
    </body>
</html>