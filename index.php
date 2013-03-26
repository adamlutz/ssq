<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Sans Souci Quartet</title>
    <META NAME="Description" CONTENT="SSQ: progressive string music.">
    <meta name="description" content="SSQ: progressive string music." />
    <meta name="keywords" content="bluegrass, music, acoustic, folk, jam" />
    <meta property="og:title" content="Sans Souci Quartet"/>
    <meta property="og:image" content="resources/imgs/lemming_goog.jpg"/>
    <meta property="og:description" content="SSQ: progressive string music."/>

    <link href='http://fonts.googleapis.com/css?family=Comfortaa:700' rel='stylesheet' type='text/css'>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
    <script type="text/javascript" src="resources/scripts/jquery.jplayer.min.js"></script>
    <link href="resources/player/player_skin.css" rel="stylesheet" type="text/css" />

    <link href="resources/styles/front_style.css?1338410736" media="screen" rel="stylesheet" type="text/css" />

    <script type="text/javascript">
        //<![CDATA[
        $(document).ready(function(){
            $("#jquery_jplayer_1").jPlayer({
                ready: function (event) {
                    $(this).jPlayer("setMedia", {
                       mp3:"resources/player/pgoat.mp3",
                       oga:"resources/player/pgoat.ogg"
                    });
                },
                swfPath: "resources/player",
                preload: "auto",
                solution: "html,flash",
                supplied: "mp3,oga",
                wmode: "window"
            });
        });
        //]]>

        function show(div) {
            switch(div)
            {
            case 'bio':
                $('div#bio').show();
                $('div#shows').hide();
                $('div#press').hide();
                break;
            case 'press':
                $('div#press').show();
                $('div#shows').hide();
                $('div#bio').hide();
                break;
            case 'shows':
                $('div#shows').show();
                $('div#bio').hide();
                $('div#press').hide();
            }
        }
    </script>
</head>
<?php
date_default_timezone_set('America/Chicago');

$rss = simplexml_load_file('http://artistdata.sonicbids.com/sans-souci-quartet/shows/xml/future');

$shows = array();
foreach($rss->show as $feed_item) {
    //var_dump($rss);exit;
    $date = new DateTime((string)$feed_item->gmtDate[0], new DateTimeZone('GMT'));
    $date->setTimezone(new DateTimeZone(date_default_timezone_get()));

    $show['name'] =(string) $feed_item->name[0];
    $show['day'] = (string) $date->format('D M jS');
    $show['time'] = (string) $date->format('g a');
    $show['description'] = "";

    $i = 0;
    $len = count($feed_item->otherArtists);
    if (!empty($feed_item->otherArtists)) {

        foreach($feed_item->otherArtists as $key => $artist) {
            $show['description'] .= (string) $artist->name[0];
            //$show['description'] .= "<a href='".(string) $artist->uri[0]."'>" . (string) $artist->name[0] . "</a>";

            if ($i !== $len-1) {
                $show['description'] .= " + ";
            }
            $i++;
        }

        if (trim($show['description']) !== '') {
            $show['description'] = "with ". $show['description'];
        }

    }

    if( !empty($feed_item->description) ) {
        $show['description'] .= "\r".(string) $feed_item->description[0];
    }
    $show['venue'] = (string) $feed_item->venueName[0];
    $show['location'] = (string) $feed_item->city[0].", ".(string) $feed_item->stateAbbreviation[0];
    $show['ticket_url'] = (string) $feed_item->ticketURI[0];
    $show['venue_url'] = (string) $feed_item->venueURI[0];

    $shows[] = $show;
}
?>
<body>
<!--[if IE]>
<div class="nav_side_ie">
<![endif]-->
<!--[if !IE]> -->
<div class="nav_side">
<!-- <![endif]-->
    <table class="nav">
        <tr>
            <td align="center" width="33%"><a href="javascript:;" onclick="show('press');">press</a></td>
            <td align="center" width="33%"><a href="javascript:;" onclick="show('bio');">bio</td>
            <td align="center" width="33%"><a href="javascript:;" onclick="show('shows');">shows</a></td>
        </tr>
    </table>
</div>
<div class="container">
    <img src="resources/imgs/banner.png"><br /><br />
    <div class="subhead">a consumer-focused music solution.</div>
    <br />

    <table class='player'>
        <tr>
            <td >
                <div id="jquery_jplayer_1" class="jp-jplayer"></div>

                <div id="jp_container_1" class="jp-audio">
                    <div class="jp-type-single">
                    <div class="jp-title">
                            <ul>
                                <li>listen: PGOAT</li>
                            </ul>
                        </div>

                        <div class="jp-gui jp-interface">
                            <ul class="jp-controls">
                                <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
                                <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
                                <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
                                <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
                            </ul>
                            <div class="jp-progress">
                                <div class="jp-seek-bar">
                                    <div class="jp-play-bar"></div>
                                </div>
                            </div>
                            <div class="jp-volume-bar">
                                <div class="jp-volume-bar-value"></div>
                            </div>
                            <div class="jp-time-holder">
                                <div class="jp-current-time"></div>
                                <div class="jp-duration"></div>
                            </div>
                        </div>
                    </div>
                </div>
        </td>
        <td width='300'>
            <div class="social">

                <div id="fb-root"></div>
                <div class="fb-like" data-href="http://www.facebook.com/sanssouciquartet" data-layout="box_count" data-show-faces="false">
                </div>

                <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://sanssouciquartet.com/" data-text="Sans Souci Quartet :" data-count="vertical" data-via="SansSouciQ">Tweet</a>

                <g:plusone size="tall"></g:plusone>
            </div>
        </td>
        </tr>
    </table>
    <br />

    <div id="shows">
        <table class="section" >
            <tr>
            <td colspan="4"><div class="section_head">upcoming shows</div></td>
            </tr>


            <?php foreach($shows as $show) { ?>

                <tr valign="top">
                    <td width="100"><b><?= $show['day'] ?><br /><?= $show['time'] ?></b></td>
                    <td ><b><?= $show['venue'] ?> -- <?= $show['location'] ?></b></td>
                    <td >
                        <?php if(!empty($show['venue_url'])) { ?>
                          <a href="<?= $show['venue_url'] ?>" target="_blank">venue</a>
                        <?php } ?>
                        <?php if(!empty($show['ticket_url'])) { ?>
                          <a href="<?= $show['ticket_url'] ?>" target="_blank">tickets</a>
                        <?php } ?>
                    </td>
                    <td width="40%"><?= preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $show['description']); ?></td>
    </tr>

            <?php } ?>


</table>




        </table>
    </div>
    <div id="bio">
        <table class="section">
        <tr>
            <td><div class="section_head">bio</div></td>
        </tr>
          <tr>
            <td>
                <p><img src="resources/imgs/full_band.jpg" class="floatright">Sans Souci Quartet has jumped into the Twin Cities music scene with a unique blend of bluegrass, folk rock and innovation. The instruments are traditional, the voices authentic, the words sometimes plaintive, but the arrangements are unique and refreshing.
                </p>
                <p>Sans Souci Quartet has had success playing numerous festivals including Harvest Fest, 10,000 Lakes Festival, Bella Family Music Festivals, Log Jam, and Boats &amp; Bluegrass. The band has shared the stage with many bands including Hot Buttered Rum, Charlie Parr,Cornmeal, Oakhurst, Packway Handle Bad, Head for the Hills, Pert Near Sandstone, and Wookiefoot.</p>
                <p>Each member brings his own musical influences to the quartet: Eric Larson, the frontman on mandolin, has decade of stage performance experience and a background that spans folk revival to modern pop. Zach Gusa, initially a guitar and harmonica troubador, now also channels the phrasings of Doc Watson and Tony Rice as the vocal harmonist of the group. Eric Roberts, inspired by the energy of the local folk music scene, has a banjo picking style all his own. Adam Lutz, in the back with the bass, has the most diverse background of the group, recently transitioning without compromise from electronic funk to acoustic folk. Coming together, these boys have found common inspiration from late 70's bluegrass bands such as Old and in the Way, and current bands like the Old Crow Medicine Show. </p>

                <p>In 2009, they released their first full-length album, "Knock Yourself Out," with nine original tunes. Though their name is playful, it's clear these boys care a great deal about their craft, and we look forward to more to come!
                </p>
                <p><img src="resources/imgs/ssq_live.jpg" class="floatleft">"Sans Souci Quartet attributes their success to the strong acoustic music scene in the Twin Cities area. The group has established a niche somewhere between the bluegrass and Americana/roots music scenes in this region, playing traditional instruments while pushing the traditional music envelope."&nbsp;&nbsp;--Inside Bluegrass
                </p>
                <p>"...arpeggiated mayhem..."&nbsp;&nbsp;--City Pages</p>
            </td>
          </tr>
        </table>
    </div>
    <div id="press">
        <table class="section">
  <tr>
            <td><div class="section_head">press info</div></td>
        </tr>
<tr>
                <td><a href="resources/promo/SSQ_press_release_11_10_11.pdf" target="_blank">Press Release: SANS SOUCI QUARTET TO RELEASE THEIR
SECOND FULL-LENGTH ALBUM LEMMING
</a>&nbsp;</td>
            </tr>
 <tr>
                <td><a href="http://mjgpro.com/contact/" target="_blank">Booking + Other Inquiries</a>&nbsp;</td>
            </tr>

            <tr>
                <td><a href="resources/promo/sans_souci_quartet.pdf" target="_blank">One-Sheet</a>&nbsp;</td>
            </tr>
            <tr>
                <td><a href="resources/promo/sans_souci_quartet_stage_plot.pdf" target="_blank">Stage Plot</a></td>
            </tr>
            <!--tr>
                <td><a href="promo/sans_souci_quartet_stage_plot.pdf">Hi-Res band images</a></td>
            </tr-->
        </table>
    </div>
</div>
<div id="fb-root"></div>
<script>
    $('div#bio').hide();
    $('div#press').hide();
</script>
<script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) {return;}
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=197659156926880";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
</script>
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
</body>
</html>
