{
    "responseData": {
        "results": [<?php $nb = count($tweets); $i = 0; foreach ($tweets as $url => $tweet): ++$i ?>
{"url":"<?php echo $url ?>", <?php $nb1 = count($tweet); $j = 0; foreach ($tweet as $key => $value): ++$j ?>
"<?php echo $key ?>":<?php echo json_encode($value).($nb1 == $j ? '' : ',') ?>
<?php endforeach; ?>
}<?php echo $nb == $i ? '' : ',' ?>
<?php endforeach; ?>
],
"cursor": {
            "pages": [
                {
                    "start": "0",
                    "label": 1
                },
                {
                    "start": "8",
                    "label": 2
                },
                {
                    "start": "16",
                    "label": 3
                },
                {
                    "start": "24",
                    "label": 4
                },
                {
                    "start": "32",
                    "label": 5
                },
                {
                    "start": "40",
                    "label": 6
                },
                {
                    "start": "48",
                    "label": 7
                },
                {
                    "start": "56",
                    "label": 8
                }
            ],
            "estimatedResultCount": "4880",
            "currentPageIndex": 0,
            "moreResultsUrl": "http://www.google.com/search?oe\u003dutf8\u0026ie\u003dutf8\u0026source\u003duds\u0026start\u003d0\u0026hl\u003dde\u0026q\u003dmuehlburger"
        }
    },
    "responseDetails": null,
    "responseStatus": 200
}