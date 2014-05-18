<?php
    session_start();
    $_SESSION['webService'] = 0; 
    $_SESSION['mediaService'] = 0;
    $xml = simplexml_load_file('assests/servers.xml');
    $xml2 = simplexml_load_file('assests/version.xml');
    ?>
<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
	<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width" />
        <title>Freelance Server monitor | <?php echo $xml2->release;    echo $xml2->version; ?> </title>
        <link rel="stylesheet" href="stylesheets/normalize.css" />
        <link rel="stylesheet" href="stylesheets/app.css" />
        <link rel="stylesheet" href="flat-ui.css" />
        <script src="javascripts/vendor/custom.modernizr.js"></script>
        <link rel="stylesheet" href="jquery.switchButton.css">
	<link rel="stylesheet" href="css/styles.css" type="text/css" media="screen, print"/>
        <link href="introjs.css" rel="stylesheet">        
</head>
<body>
        
        <nav class="top-bar"> 
            <ul class="title-area">
            <!-- Title Area -->
                <li class="name">
                    <h1><a href="#">Freelance Server Monitor</a></h1>
                </li>
           <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
                <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
            </ul>
            <section class="top-bar-section">
<!--                <ul class="left">
                    <li class="divider"></li>
                    <li class="has-dropdown"><a href="#">Admininstrator</a>
                        <ul class="dropdown"><li class="title back js-generated"><h5><a href="#">« Back</a></h5></li>
                            <li><label>Tools</label></li>
                            <li><a onclick="messag();">Register New Server</a></li>
                        </ul>
                    </li>
                    <li class="divider"></li>
                </ul>-->
                <!-- Right Nav Section -->
                <ul class="right">
                    <li class="divider hide-for-small"></li>
                    <li><a onclick="startIntro();">Start Tour</a></li>
                </ul>
            </section></nav>
            <div class="row" id="doc-panels">
                <h3 class="subheader"><?php echo $xml->name ?></h3>
                <div id="step0">	
                    <h6 class="subheader">Release: <?php echo $xml2->release;   echo $xml2->version; ?> </h6></div>
                    <hr>
		</div>
                <?php       
                    function ServerStatusW($ipa,$sss)
                    {
                        if($ipa!=null && $sss!=null)
                        {
                            if($sock = @fsockopen($ipa, $sss, $num, $error, 1))
                            {
                                $_SESSION['webService'] = $_SESSION['webService'] + 1;
                                echo 'checked';
                            }
                        }else
                        {
                            return 'unchecked';
                        }
                    }
                    function getWPer()
                    {
                        $mod = $_SESSION['webService'] % 11;
                        $_SESSION['webService'] = (($_SESSION['webService'] / 11) ) * 100;
                        return floor($_SESSION['webService']); 
                    }
                ?> 
            <div class="row" id="doc-panels">
                <div class="large-12 columns">   
                <div class="row">
                <div class="large-6 columns">
                <div id="step1">
                    <h5 class="subheader">Web Services</h5>
                    <div class="panel radius">
                    <ul class="clearing-thumbs"> 
                       <li>
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">HTTP</label>
                                <input type="checkbox" value="1" <?php (ServerStatusW('192.168.2.101', intval($xml->http)))?>>
                            </div>
                        </li>
                        <li>
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">MySql Server</label>
                                <input type="checkbox" value="1" <?php (ServerStatusW($xml->ipaddress, intval($xml->mysql)))?>>
                            </div>
                        </li>
                        <li>
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">SSL</label>
                                <input type="checkbox" value="1" <?php (ServerStatusW($xml->ipaddress,intval($xml->ssl)))?>>
                            </div>
                        </li>
                        <li>
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">Pop3 Server</label>
                                <input type="checkbox" value="1" <?php (ServerStatusW($xml->ipaddress,intval($xml->pop3)))?>>
                            </div>
                        </li>
                        <li>
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">IMAP</label>
                                <input type="checkbox" value="1" <?php (ServerStatusW($xml->ipaddress,intval($xml->imap)))?>>
                            </div>
                        </li>
                        <li>
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">SMTP</label>
                                <input type="checkbox" value="1" <?php (ServerStatusW($xml->ipaddress,intval($xml->smtp)))?>>
                            </div>
                        </li>
                        <li class="clearing-thumbs">
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">DNS1</label>
                                <input type="checkbox" value="1" <?php (ServerStatusW($xml->ipaddress,intval($xml->dns1)))?>>
                            </div>
                        </li>
                        <li class="clearing-thumbs">
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">DNS2</label>
                                <input type="checkbox" value="1" <?php (ServerStatusW($xml->ipaddress,intval($xml->dns2)))?>>
                            </div>
                        </li>
                        <li class="clearing-thumbs">
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">Webmin</label>
                                <input type="checkbox" value="1" <?php (ServerStatusW($xml->ipaddress,intval($xml->webmin)))?>>
                            </div>
                        </li>
                        <li class="clearing-thumbs">
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">CPanel</label>
                                <input type="checkbox" value="1" <?php (ServerStatusW($xml->ipaddress,intval($xml->cpanel)))?>>
                            </div>
                        </li>
                        <li>
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle6">SSH</label>
                                <input type="checkbox" value="1"<?php (ServerStatusW($xml->ipaddress,intval($xml->ssh)))?>/>
                            </div>
                        </li>
                    </ul>
                  </div>
                </div> 
              </div>     
              <?php         
                function ServerStatusM($ipa,$sss)
                {
                if($ipa!=null && $sss!=null)
                {
                    
                    if($sock = @fsockopen($ipa, $sss, $num, $error, 1))
                    {
                        $_SESSION['mediaService'] = $_SESSION['mediaService'] + 1;
                        echo 'checked';
                    }
                    else
                    {
                        return 'unchecked';
                    }
                }
                }
                function getMPer()
                {
                    $_SESSION['mediaService'] = ($_SESSION['mediaService'] / 6) * 100;
                    return floor($_SESSION['mediaService']);
                }
                ?>   
                <h5 class="subheader">Media Services</h5>
                <div class="large-6 columns">
                    <div id="step2">
                  <div class="panel radius">
                    <ul class="clearing-thumbs"> 
                       <li>
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">plex Server</label>
                                <input type="checkbox" value="1" <?php (ServerStatusM('192.168.2.101',intval($xml->plex)))?>>
                        </div>
                        </li>
                        <li>
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">XBMC Server</label>
                                <input type="checkbox" value="1" <?php (ServerStatusM($xml->ipaddress,intval($xml->XBMC)))?>>
                            </div>
                        </li>
                        <li>
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">MS Media Server</label>
                                <input type="checkbox" value="1" <?php (ServerStatusM($xml->ipaddress,intval($xml->msmedia)))?> disabled="disabled">
                            </div>
                        </li>
                        <li>
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">Internet Radio</label>
                                <input type="checkbox" value="1" <?php (ServerStatusM($xml->ipaddress,intval($xml->internetradio)))?>>
                            </div>
                        </li>
                        <li>
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">MythTV</label>
                                <input type="checkbox" value="1" <?php (ServerStatusM($xml->ipaddress,intval($xml->quicktime)))?>>
                            </div>
                        </li>
                        <li>
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">Quicktime</label>
                                <input type="checkbox" value="1" <?php (ServerStatusM($xml->ipaddress,intval($xml->quicktime)))?>>
                            </div>
                        </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            </div>
          </div>
          <div class="row" id="doc-panels">
            <div class="large-12 columns">
              
              <div class="row">
                <div class="large-6 columns">
                    <div id="step3">
                  <div class="panel radius">
                    <div class="panel-body text-center"> 
                            <div id="webservices"></div>
                        </div>
                  </div>
                    </div>
                </div>
                <div class="large-6 columns">
                    <div id="step4">
                  <div class="panel radius">
                        <div class="panel-body text-center"> 
                            <div id="mediaservices"></div>
                        </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            <hr>
          </div>

        <?php
    
          function ServerStatusMal($ipa,$sss)
            {
                if($ipa!=null && $sss!=null)
                {
                    if($sock = @fsockopen($ipa, $sss, $num, $error, 1))
                    {
                        global  $malServices;
                        $malServices++;
                        echo 'checked';
                    }
                }else
                {
                    return 'unchecked';
                }
            }
    
        ?>
    
    
    
          <div class="row" id="doc-panels">
            <div class="large-12 columns">
              <div id="step5">
              <div class="row">
                  
                <div class="large-6 columns">
                <h5 class="subheader">Malicious Services</h5>
                  <div class="panel radius">
                    <ul class="clearing-thumbs"> 
                       <li>
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">Bagel.H</label>
                                <input type="checkbox" value="1" <?php (ServerStatusMal($xml->ipaddress,$xml->bagleh))?>>
                        </div>
                        </li>
                        <li>
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">MyDoom (1)</label>
                                <input type="checkbox" value="1" <?php (ServerStatusMal($xml->ipaddress,$xml->mydoom1))?>>
                            </div>
                        </li>
                        <li>
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">MyDoom (2)</label>
                                <input type="checkbox" value="1" <?php (ServerStatusMal($xml->ipaddress,$xml->mydoom2))?> disabled="disabled">
                            </div>
                        </li>
                        <li>
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">Rbot / Spybot</label>
                                <input type="checkbox" value="1" <?php (ServerStatusMal($xml->ipaddress,$xml->spybot))?>>
                            </div>
                        </li>
                        <li>
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">Sasser</label>
                                <input type="checkbox" value="1" <?php (ServerStatusMal($xml->ipaddress,$xml->sasser))?>>
                            </div>
                        </li>
                        <li>
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">Back Orifice</label>
                                <input type="checkbox" value="1" <?php (ServerStatusMal($xml->ipaddress,$xml->backorifice))?>>
                            </div>
                        </li>
                  </div>
                </div>             
                <h5 class="subheader"> -</h5>
                <div class="large-6 columns">
                  <div class="panel radius">
                    <ul class="clearing-thumbs"> 
                       <li>
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">Bagle.B</label>
                                <input type="checkbox" value="1" <?php (ServerStatusMal($xml->ipaddress,$xml->bagleb))?>>
                        </div>
                        </li>
                        <li>
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">Blaster</label>
                                <input type="checkbox" value="1" <?php (ServerStatusMal($xml->ipaddress,$xml->blaster))?>>
                            </div>
                        </li>
                        <li>
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">Dabber</label>
                                <input type="checkbox" value="1" <?php (ServerStatusMal($xml->ipaddress,$xml->dabber))?> disabled="disabled">
                            </div>
                        </li>
                        <li>
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">Netbus</label>
                                <input type="checkbox" value="1" <?php (ServerStatusMal($xml->ipaddress,$xml->netbus))?>>
                            </div>
                        </li>
                        <li>
                            <div class="slider demo" id="slider-1">
                                <label class="share-label" for="share-toggle2">Sub 7</label>
                                <input type="checkbox" value="1" <?php (ServerStatusMal($xml->ipaddress,$xml->sub7))?>>
                            </div>
                        </li>
                  </div>
                </div>
              </div>
            </div>
            <hr>
          </div>

          </div>
          <div class="row" id="doc-panels">
            <div class="large-12 columns">
              <div id="step6">
              <div class="row">
                  
                <div class="large-12 columns">
                <h5 class="subheader">Overall Services</h5>
                  <div class="panel radius">
                    
                      <div class="alert-box success">
                          <ul>
                              <li>Service is running smoothly
                              <a href="" class="close">×</a>
                              </li>
                              
                          </ul>
                      </div>
                  </div>
    
                  </div>
                </div>
                
              </div>
            </div>
            <hr>
          </div>
<div id="chart3" class="plot" style="width:300px;height:180px;"></div>  
  <script>
  document.write('<script src=' +
  ('__proto__' in {} ? 'javascripts/vendor/zepto' : 'javascripts/vendor/jquery') +
  '.js><\/script>')
  </script>

  <script src="javascripts/foundation/foundation.js"></script>

	<script src="javascripts/foundation/foundation.alerts.js"></script>

	<script src="javascripts/foundation/foundation.clearing.js"></script>

	<script src="javascripts/foundation/foundation.cookie.js"></script>

	<script src="javascripts/foundation/foundation.dropdown.js"></script>

	<script src="javascripts/foundation/foundation.forms.js"></script>

	<script src="javascripts/foundation/foundation.joyride.js"></script>

	<script src="javascripts/foundation/foundation.magellan.js"></script>

	<script src="javascripts/foundation/foundation.orbit.js"></script>

	<script src="javascripts/foundation/foundation.placeholder.js"></script>

	<script src="javascripts/foundation/foundation.reveal.js"></script>

	<script src="javascripts/foundation/foundation.section.js"></script>

	<script src="javascripts/foundation/foundation.tooltips.js"></script>

	<script src="javascripts/foundation/foundation.topbar.js"></script>

  <script>
    $(document).foundation();
  </script>
  <script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-19093680-2']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
    <script src="jquery.switchButton.js"></script>

    <script>
      $(function() {
        $('#basic.demo input').switchButton();

        $('#basic2.demo input').switchButton();

        $("#labels.demo input").switchButton({
          on_label: 'YES',
          off_label: 'NO'
        });

        $("#default.demo input").switchButton({
          checked: false
        });

        $("#labels2-1.demo input").switchButton({
          show_labels: false
        });

        $("#labels2-2.demo input").switchButton({
          labels_placement: "right"
        });

        $("#labels2-3.demo input").switchButton({
          labels_placement: "left"
        });

        $("#slider-1.demo input").switchButton({
          width: 50,
          height: 20,
          button_width: 30
        });

        $("#slider-2.demo input").switchButton({
          width: 100,
          height: 40,
          button_width: 70
        });
      })
    </script>
   <script src="resources/js/raphael.2.1.0.min.js"></script>
    <script src="resources/js/justgage.1.0.1.min.js"></script>
    <script>
      var webservices, mediaservices, g3, g4;
      var M = <?php echo getMPer(); ?>;
      var W = <?php echo getWPer(); ?>;
      window.onload = function(){
        var webservices = new JustGage({
          id: "webservices", 
          value: W, 
          min: 0,
          max: 100,
          title: "Web Services",
          label: "Percent",
          startAnimationTime: 2000,
            startAnimationType: "bounce",
            refreshAnimationTime: 1,
            refreshAnimationType: "bounce",
            levelColors: [
            "#E74C3C",
            "#e74c3c",
            "#e74c3c"]
        });     
        var mediaservices = new JustGage({
          id: "mediaservices", 
          value: M, 
          min: 0,
          max: 100,
          title: "Media Services",
          label: "Percent",
          startAnimationTime: 2000,
            startAnimationType: "bounce",
            refreshAnimationTime: 1,
            refreshAnimationType: "bounce",
            levelColors: [
            "#e74c3c",
            "#e74c3c",
            "#e74c3c"]
        });
        setInterval(function() {
          g1.refresh(getRandomInt(50, 100));
          g2.refresh(getRandomInt(50, 100));          
          g3.refresh(getRandomInt(0, 50));
          g4.refresh(getRandomInt(0, 50));
        }, 2500);
      };
    </script> 
    <!-- Preloader -->




<script type="text/javascript" src="intro.js"></script>
    <script type="text/javascript">
      function startIntro(){
        var intro = introJs();
          intro.setOptions({
            steps: [
                {
                element: document.querySelector('#step0'),
                intro: "The version number is very important. Keep track on what version you are currently using!"
              },
              {
                element: document.querySelector('#step1'),
                intro: "These are standards that we believe every web server should have, custom services can always be added. Let us know!"
              },
              {
                element: document.querySelectorAll('#step2')[0],
                intro: "Usually these services are ment for home servers! But hey... anything is possible right?",
              },
              {
                element: '#step3',
                intro: 'For a quick glance, we included a graph. Now just look at the percentage of services you have!'
              },
              {
                element: '#step4',
                intro: "100% is not overkill. For the ultimate media server, try get the graph to 100!"
              },
              {
                element: '#step5',
                intro: 'If any of these are ON! Then you have a problem!!'
              },
              {
                element: '#step6',
                intro: 'Green is good, orange is ok for now, RED is bad... very BAD!'
              }
            ]
          });

          intro.start();
      }
    </script> 
    
    
    <script>
       function messag()
       {
           window.alert("This is a demo version. Please come back in 2014 for a free full version");
       }
    </script>
  </body>  
</html>