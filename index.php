<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Sans Souci Quartet</title>
    <META NAME="Description" CONTENT="SSQ: progressive string music.">
    <meta name="description" content="SSQ: progressive string music." />
    <meta name="keywords" content="bluegrass, string band, acoustic, folk, country, old crow medicine show" />
    <meta property="og:title" content="Sans Souci Quartet"/>
    <meta property="og:image" content="http://sanssouciquartet.com/resources/imgs/ssq_wolf.png"/>
    <meta property="og:description" content="SSQ: progressive string music."/>
<!-- f0ffc7 -->
    <meta name="viewport" content="width=device-width, initial-scale=0.941176471, maximum-scale=1, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <!-- player -->
    <link href="resources/player/skin/apmplayer_base.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="resources/player/skin/jquery-ui-slider.custom.css" type="text/css" media="all" />
    <link href="resources/player/skin/override.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script type="text/javascript" src="resources/player/script/lib/jquery-ui-slider.custom.min.js"></script>
    <script type="text/javascript" src="resources/player/script/lib/soundmanager2-jsmin.js"></script>
    <script type="text/javascript" src="resources/player/script/apmplayer-all.min.js"></script>

    <link href='http://fonts.googleapis.com/css?family=Waiting+for+the+Sunrise|IM+Fell+English' rel='stylesheet' type='text/css'>

    <!-- site css -->
    <link href="resources/styles/front_style.css" media="screen" rel="stylesheet" type="text/css" />

    <script type="text/javascript">
        //<![CDATA[
        $(document).ready(function(){
            $('#apm_media_wrapper').apmplayer_ui({
                playables : [
                    {
                        identifier: 'sanssouci',
                        type: 'audio',
                        program: 'Grin',
                        title: 'Lemming (2011)',
                        http_file_path: 'http://www.sanssouciquartet.com/resources/audio/tv.mp3',
                        duration: 255000
                    },
                    {
                        identifier: 'sanssouciquartet',
                        type: 'audio',
                        program: 'Sittin\' Duck',
                        title: 'Lemming (2011)',
                        http_file_path: 'http://www.sanssouciquartet.com/resources/audio/duck.mp3',
                        duration: 165000
                    }
                ],
                onPlaylistUpdate : function (playable) {
                    if ($('#apm_playlist li[ id = \'' + playable.identifier + '\']').length == 0) {   //create playlist item li + click handler if none exists.
                        $('#apm_playlist ul').append('<li id="' + playable.identifier + '" class="apm_playlist_item"></li>');

                        $('#apm_playlist li[ id = \'' + playable.identifier + '\']').click(function () {
                            $('#apm_player_container').apmplayer_ui('gotoPlaylistItem', this.id);
                        });
                    }
                    var snippet = '';
                    if (playable.program !== '') {
                        snippet += '<div class="apm_playlist_item_title">' + playable.program + '</div>';
                    }
                    if (playable.title !== '') {
                         snippet += '<div class="apm_playlist_item_info">' + playable.title + '</div>';
                    } else if (playable.description !== '') {
                         snippet += '<div class="apm_playlist_item_info">' + playable.description + '</div>';
                    }

                    $('#apm_playlist li[ id = \'' + playable.identifier + '\']').html(snippet);

                },
                onMetadata : function (playable) {
                    if (playable.image_lg !== ''
                            && playable.image_sm !== '') {
                        $('#apm_player_info').html('');
                        $('#apm_player_container').css('background-size', '100%');
                        $('#apm_player_container').css('background-repeat', 'no-repeat');
                        $('#apm_player_container').css('background-image', 'url('+playable.image_sm+')');
                        $('.apmbackgroundsize #apm_player_container').css('background-image', 'url('+playable.image_lg+')');
                    }
                    else {

                        var snippet = "<h4>SSQ Radio</h4>";
                        if (playable.program !== '') {
                            snippet += "<h2>"+playable.program+"</h2>";
                        }
                        if (playable.title !== ''
                            && playable.title.indexOf("null - American Public Media") === -1) {
                            snippet += "<p>"+playable.title;
                            snippet += ' [<a href="http://www.cdbaby.com/cd/sanssouciquartet" class="" target="_blank">buy album</a>]</p>';  //' + playable.identifier + '
                        }
                        $('#apm_player_container').css('background-image', '');
                        $('#apm_player_info').html(snippet);
                    }
                }
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

//var_dump($rss);exit;
foreach($rss->show as $feed_item) {

    if ($feed_item->venueName[0] == '')
    {
        continue;
    }
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
//var_dump($shows);
?>


<body id="apm_media_player">
    <div class="container">
        <div class="header">Sans Souci Quartet</div>
        <div class="subhead">progressive folk and bluegrass music.</div>
        <br />

        <div class="header_links">
            <a href="javascript:;" onclick="show('bio');">About</a> |
            <a href="javascript:;" onclick="show('shows');">Shows</a> |
            <a href="javascript:;" onclick="show('press');">Press</a>
        </div>

        <br />
        <table class="player">
            <tr>
                <!-- <td><img src="resources/imgs/ssq_cover.jpg" width='170' height='150'></td> -->
                <td >
                    <div id="apm_media_wrapper">
                        <section id="apm_player_container" class="rounded box clearfix">

                            <div id="apm_player_info"></div>


                            <div id="apm_player_controls" class="volume playtime">
                                <div id="apm_player_toggle">
                                    <div id="apm_player_play" class="player-toggle hide-text">
                                        Play
                                    </div>

                                    <div id="apm_player_pause" class="player-toggle hide-text">
                                        Pause
                                    </div>

                                    <div id="apm_player_bar_wrapper">
                                        <div id="apm_player_bar_container" class="rounded">
                                            <div id="apm_player_bar">
                                                <div id="apm_player_loading" class="rounded4"></div>
                                            </div>
                                        </div>

                                        <div id="apm_player_playtime">0:00</div>
                                    </div>

                                    <div id="apm_player_volume_wrapper">
                                        <div id="apm_player_volume_status">
                                        </div>

                                        <div id="apm_player_volume_slider_wrapper">
                                            <div id="apm_player_volume_slider_container" class="rounded">
                                                <div id="apm_volume_bar">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!-- END apm_media_wrapper -->
                    <section id="apm_playlist_container" class="rounded box clearfix">

                        <div id="apm_playlist">

                            <h4>Playlist</h4>

                            <ul>

                            </ul>

                        </div>


                    </section>
                </td>


            </tr>
        </table>

                    <div class="social">
                        <div class="fb-like" data-href="https://www.facebook.com/sanssouciquartet" data-width="450" data-show-faces="true" data-send="true"></div>
                    </div>
                    <br />
        <div id="shows">
            <table class="section" >
                <tr>
                     <td></td>
                     <td colspan="4"><div class="section_head">Upcoming Shows</div></td>
                </tr>

                <?php if (empty($shows)) { ?>
                    <tr valign="top">
                        <td></td>
                        <td width="100" colspan="4">Currently no shows are scheduled.  Please like our <a href="https://facebook.com/sanssouciquartet/" target="_blank">facebook page</a> to be notified when we announce new shows.</td>
                    </tr>
                <?php } ?>
                <?php foreach($shows as $show) { ?>

                    <tr valign="top">
                        <td></td>
                        <td width="130"><?= $show['day'] ?><br /><?= $show['time'] ?></td>
                        <td><?= $show['venue'] ?> -- <?= $show['location'] ?></td>
                        <!-- <td width="100"><b>Oct 5<br />9pm</b></td> -->
                        <!-- <td ><b>The Northwoods Deal -- Chico, MN</b></td> -->
                        <td align='left'>
                            <?php if(!empty($show['venue_url'])) { ?>
                              <a  class="section" href="<?= $show['venue_url'] ?>" target="_blank">venue</a>
                            <?php } ?>
                            <?php if(!empty($show['ticket_url'])) { ?>
                              <br /><a  class="section"  href="<?= $show['ticket_url'] ?>" target="_blank">tickets</a>
                            <?php } ?>
                        </td>
                        <!-- <td width="40%">some kind of festival w/ other guys and what nots</td> -->
                        <td width="30%"><?= preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $show['description']); ?></td>
                    </tr>

                <?php } ?>




            </table>
        </div>
        <div id="bio">
          <table class="section">
            <tr>
                <td></td>
                <td><div class="section_head">About SSQ</div></td>
            </tr>
            <tr>
                <td></td>
                <td><img src="resources/imgs/full_band.jpg" class="floatright">Sans Souci Quartet has jumped into the Twin Cities music scene with a unique blend of bluegrass, folk rock and innovation. The instruments are traditional, the voices authentic, the words sometimes plaintive, but the arrangements are unique and refreshing.

                    <p>Sans Souci Quartet has had success playing numerous festivals including Harvest Fest, 10,000 Lakes Festival, Bella Family Music Festivals, Log Jam, and Boats &amp; Bluegrass. The band has shared the stage with many bands including Hot Buttered Rum, Charlie Parr,Cornmeal, Oakhurst, Packway Handle Bad, Head for the Hills, Pert Near Sandstone, and Wookiefoot.</p>
                    <p>Each member brings his own musical influences to the quartet: Eric Larson, the frontman on mandolin, has decade of stage performance experience and a background that spans folk revival to modern pop. Zach Gusa, initially a guitar and harmonica troubador, now also channels the phrasings of Doc Watson and Tony Rice as the vocal harmonist of the group. Eric Roberts, inspired by the energy of the local folk music scene, has a banjo picking style all his own. Adam Lutz, in the back with the bass, has the most diverse background of the group, recently transitioning without compromise from electronic funk to acoustic folk. Coming together, these boys have found common inspiration from late 70's bluegrass bands such as Old and in the Way, and current bands like the Old Crow Medicine Show. </p>

                    <p>In 2009, they released their first full-length album, "Knock Yourself Out," with nine original tunes. Though their name is playful, it's clear these boys care a great deal about their craft, and we look forward to more to come!
                    </p>
                    <p><img src="resources/imgs/ssq_live.jpg" class="floatleft">"Sans Souci Quartet attributes their success to the strong acoustic music scene in the Twin Cities area. The group has established a niche somewhere between the bluegrass and Americana/roots music scenes in this region, playing traditional instruments while pushing the traditional music envelope."&nbsp;&nbsp;--Inside Bluegrass
                    </p>
                    <p>"...arpeggiated mayhem..."&nbsp;&nbsp;--City Pages</p>
                </td>
                <td></td>
            </tr>
          </table>
        </div>
        <div id="press">
            <table class="section">
                <tr>
                    <td><div class="section_head">Press Info</div></td>
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
<br /><br /><br /><br />
<script>
    $('div#bio').hide();
    $('div#press').hide();
</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=197659156926880";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

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
