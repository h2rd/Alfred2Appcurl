<?php
require __DIR__ . '/workflows.php';

$wf = new Workflows();

$query = $_SERVER['argv'][1];

$detecturl = "http://www.appcurl.com/api/0/appcurl/qs/?q=" . urlencode( $query );
$items = json_decode( $wf->request( $detecturl ), true);

$wf->result(time(), $query, 'Open in appcurl.com', '', 'icon.png');

if ($items && $items['total']):
    foreach($items['result'] as $item):
        $url = "http://www.airomo.com/apps/" . $item['id'];

        // TODO: Change icon.png to $item['icon'] when it will possible in Alfred
        $wf->result($item['id'], $url, $item['title'], $url, 'icon.png');
    endforeach;
else:
    $wf->result( 'appcurl', $query, 'No search suggestions found.', '', 'icon.png' );
endif;

echo $wf->toxml();
