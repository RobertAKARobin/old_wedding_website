<?php

error_reporting(E_ERROR);

if(empty($_POST)){
    goto render;
}

if(
    empty($_POST["name"])
 || empty($_POST["email"])
 || empty($_POST["street"])
 || empty($_POST["city"])
 || empty($_POST["state"])
 || empty($_POST["zip"])
){
    $results = "Please be sure to fill out all your contact information!";
    goto render;
}

$people = json_decode(file_get_contents("people.json"),true);
$peopleNum = count($people);
$allowed = array("attending","name","email","street","city","state","zip","comments","diet");
foreach($_POST as $key => $val){
    if(!in_array($key,$allowed)) goto render;
    $$key = $val;
    $people[$peopleNum][$key] = str_replace(array("\n","\r","\t")," ",htmlspecialchars(substr(strip_tags($val),0,500)));
}
file_put_contents("people.json",json_encode($people));

switch($attending){
    case "both": $attending = "The DC wedding and MN reception!"; break;
    case "wedding": $attending = "The DC wedding!"; break;
    case "reception": $attending = "The MN reception!"; break;
    case "neither": $attending =  "We're so sorry you won't be able to join us in DC or Minneapolis. :(";
}

require "phpmailer/PHPMailerAutoload.php";
$mail = new PHPMailer;    
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'arielleandrobin@gmail.com';
$mail->Password = 'minesweet';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;    
$mail->From = 'arielleandrobin@gmail.com';
$mail->FromName = 'Arielle and Robin';
$mail->addAddress($email);
$mail->addCC('arielleandrobin@gmail.com');
$mail->WordWrap = 5000;
$mail->isHTML(false);
$mail->ContentType = "text/plain";
$mail->Subject = "Arielle and Robin's Wedding RSVP";
$mail->Body = "Thanks so much for RSVPing! Here's the information you sent us:\r\n
Name(s): $name\r\n
Attending: $attending\r\n
Email: $email\r\n
Street: $street\r\n
City: $city\r\n
State: $state\r\n
Zip code: $zip\r\n
Dietary restrictions: $diet\r\n
Comments: $comments\r\n
If you have any questions please feel free to e-mail us at arielleandrobin@gmail.com. Keep an eye out for updates at http://www.arielleandrobin.com! We can't wait!\r\n
Our very best,\r\n
Arielle and Robin";

if(!$mail->send()) {
    $results = $mail->ErrorInfo;
} else {
    $results = "Thanks! :) You should be getting a confirmation e-mail from us any second!";
}

render:

$disclaimer = <<<HTML

<p>The wedding ceremony itself will be in Washington, DC. We appreciate that might not be very accessible for some given the distance, the expense, and that it'll be in a hilly area on what will likely be a hot and humid weekend.</p>

<p>Also, the two of us would personally like to keep the ceremony quite small, shared mainly with our families.</p>

<p>In order to allow everyone to celebrate our marriage with us, Arielle's parents have offered to arrange <a href="#mninfo">a special reception in Minneapolis</a> that can accommodate more people. We would be delighted to see you there!</p>

<p>If you can't join us in DC or Minnesota, please let us know anyway! You can e-mail us at <a href="mailto:arielleandrobin@gmail.com">arielleandrobin@gmail.com</a> with any questions.</p>

<hr />

HTML;

?>
<!DOCTYPE html>
<html>
<head>
<title>Arielle &amp; Robin</title>
<link rel="stylesheet" type="text/css" href="indexcss.css" />
<meta charset="UTF-8" />
<meta name="description" content="These two cuties are getting hitched!" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
<script type="text/javascript" src="indexjs.js"></script>
</head>
<!--It'll be a real Puffin Party!-->
<body>
<div class="bg"><div></div></div>
<header>
<h1>Arielle &amp; Robin</h1>
<div class="hidden">
<img src="img/bg.jpg" width="1" height="1" alt="background" />
<p>We're getting married!</p>
</div>
<nav>
<ul>
<li><a href="#story">Story</a></li>
<li><a href="#who">Who</a></li>
<li><a href="#mninfo">MN Info</a></li>
<li><a href="#dcinfo">DC Info</a></li>
<li><a href="#registry">Registries</a></li>
</ul>
</nav>
</header>
<main>

<section id="story">
<h2>Our Story</h2>
<p>Arielle and Rachel Goldy became roommates at American University and kept living together after graduation, whereas Robin and Rachel had grown up together in Ohio from Kindergarten through high school.</p>
<p>Robin moved to Washington in the last days of December of 2011 without a place to stay. Rachel offered her and Arielle's apartment &mdash; on the condition that Robin pick up Arielle from the airport. In the car, Arielle insisted they stop at a Petsmart to buy a cat for her apartment. Robin was instantly in love.</p>
<p>Well, not really. Robin, Rachel, and Arielle hung out for seven months as friends, commiserating together about the DC dating scene. One day (again in the car), Robin asked Arielle whether she thought they should date:</p>
<blockquote>No, because I think we'd kill each other.</blockquote>
<blockquote>Well, what if we tried?</blockquote>
<p>And it was decided with a fist-bump that they'd give it a shot. Their first date: <strong>bowling</strong>!</p>
<hr />
<p>Two years later, when it became obvious that they were soulmates, Arielle found a ring that she loved: simple, elegant, conflict-free, and from a small husband-and-wife-owned <a href="https://www.etsy.com/shop/artemer" target="_blank">jewelry shop</a> in one of Arielle's favorite places, Israel.</p>
<p>Because Arielle is <q>as subtle as a brick to the face</q> (Robin's words), she showed Robin the ring. Fast forward a few months: Robin knew it was time, ordered the ring, and became paranoid about Arielle finding out about it on his computer.</p>
<p>The ring was scheduled to be delivered on a day when Arielle would be away. Hovering over the ring's online shipment tracking updates, he watched as the ring's status changed to "delivered" without anything showing up at the door.</p>
<p>The next day, Robin and Arielle returned together from an errand run to find an "Israel Post" package with marked big Hebrew letters. Arielle picked up the package first and saw that the customs form was marked with "Contents: RING".</p>
<p>Quick thinker that he is, Robin said, <q>This isn't how I planned to do this, but it feels very <em>us</em>,</q> and proposed. Arielle, of course, enthusiastically accepted.</p>
</section>

<section id="who">
<h2>The Bridal Party</h2>
<dl>
<dt>Molly Schwaiger, Maid of Honor</dt>
<dd><img src="img/mk.jpg" width="150" height="150" alt="Molly Schwaiger Klane" />Molly has been a wise elder, friend, sister, and first boss. She taught Arielle many fine lessons such as how to properly microwave butter or chocolate chips, play Dominion, and find the best deals at Target. She is always there to be a listening ear and to give solid advice.</dd>
<dt>Danielle Gelberg</dt>
<dd><img src="img/dizzle.jpg" width="145" height="150" alt="Daniell Gelberg" />Since Arielle first sent that fateful Facebook message asking Danielle to room together in Paris, the two have been the best of friends. They have shared many adventures together, from almost being sold for seven mirrors in Morocco, to eating giant sausages and then washing them down with fried bread smothered in Nutella for breakfast in Prague, to student teaching, to now living in the same apartment building.</dd>
<dt>Rachel Goldy</dt>
<dd><img src="img/rachel.jpg" width="150" height="128" alt="Rachel Goldy" />Rachel is the reason Robin and Arielle met. She and Robin first met at the young age of 5, when his parents bought a car from her grandma, and then spent the next 13 years going through school together. Rachel met Arielle during their freshman year of college, and they lived together for over five years. Rachel will forever remain the dutiful aunt to young Atticus (our cat daughter) and a loyal friend to both Arielle and Robin.</dd>
<dt>Molly Thomas</dt>
<dd><a href="http://www.mollythomasny.com" target="_blank"><img src="img/mt.jpg" width="150" height="144" alt="Molly Thomas" /></a>Molly has spent many years claiming that she's Robin's older sister. Out of pure pity, Robin plays along with her sad charade.</dd>
<dt>Atticus Finch Klane, Back-up Ringbearer</dt>
<dd><img src="img/atti.jpg" width="123" height="200" alt="There she is!" />Atti is the landlord of Arielle and Robin's apartment. She demands adoration from her subjects.</dd>
</dl>
<dl class="groom">
<dt>Joe Carlin, Best Man</dt>
<dd><img src="img/joe.jpg" width="127" height="150" alt="Joe Carlin" />Joe and Robin met on their first day of high school when Joe made fun of Robin's name. Ironically, this is just as embarrassing to Joe now as it was to Robin then. The two have shared many highs and lows &mdash; but mostly highs, including innumerable late-night Taco Bell runs and being each other's Best Man.</dd>
<dt>Evan Bartow</dt>
<dd><img src="img/evanb.jpg" width="150" height="150" alt="Evan Bartow" />Evan and Robin met on their first day of Kindergarten. Then some stuff happened, and before long they were watching hopelessly as the dinner they were making for their double-date to Prom overcooked into a gelatenous mass of pasta. Now they share the same receding hairline.</dd>
<dt>Jeff Gerson</dt>
<dd><img src="img/jeff.jpg" width="150" height="150" alt="Jeff Gerson" />Robin was initially a little disappointed that Jeff would be his freshman roommate at Stanford, thinking that guy with the elegantly-coiffed hair would get all the girls. He probably would have, too, if he was interested. Despite basically running Silicon Valley, Jeff can somehow always make time to be an amazing friend.</dd>
<dt>Evan Klane</dt>
<dd><img src="img/evan.jpg" width="121" height="150" alt="Evan Klane" />Evan fell in love with his baby sister immediately, sharing with his preschool class that she is his favorite toy. He has given her many nicknames over the years and taught her many sports that she will likely never play again (such as lacrosse and hockey). He and Arielle share the same sense of quirky humor and enjoy quoting and watching 90’s classics.</dd>
</dl>
</section>

<section id="mninfo">
<h2>Reception</h2>

<p class="info"><a href="http://www.al-almas.com/">Al &amp; Alma's Charter Cruises</a>
5201 Piper Road
Mound, MN 55364

<em>August 8th, 2015, 12:00pm</em>
</p>

<p>Join us as we sail off into the sunset! The reception will take place on a boat (in a lake, no less). Lunch will be served. Those of you who will not be with us in DC &mdash; we'd love to see you here!</p>

</section>

<section id="dcinfo">
<h2>The DC Celebration</h2>
<?php echo $disclaimer ?>

<h2>Ceremony &amp; Reception</h2>
<p class="info"><a href="http://pinstripes.com/" target="_blank">Pinstripes</a>
1064 Wisconsin Avenue NW
Washington, DC 20007

<em>July 5th, 2015, 5:00pm</em>
</p>
<hr />
<h2>&ldquo;Rehearsal&rdquo; Dinner</h2>
<p class="info"><a href="https://www.google.com/maps/place/Georgetown+Waterfront+Park/@38.9031534,-77.0658017,16z/data=!4m2!3m1!1s0x0:0xa841b0b5af9e6649" target="_blank">Georgetown Waterfront Park</a>
<em>July 4th, 2015, 7:00pm</em></p>
<p>Come watch the fireworks in the nation's capital! This will be a fun and informal picnic by the Potomac River, a five-minute walk from Pinstripes. Dress for the weather!</p>
<hr />
<h2>Accommodations</h2>
<p class="info"><a href="http://www.georgetowninn.com" target="_blank">The Georgetown Inn</a>
1310 Wisconsin Ave, NW
Washington, DC 20007
(202) 333-8900
</p>
<p>This beautiful hotel is a three-minute walk from Pinstripes, smack in the heart of Georgetown.</p>
<p>The group name is <em>Klane-Thomas Wedding Party</em>, and rooms are around $160 - $170 a night. (Take it from us: that's a great deal for the time and location and for DC in general, but you're more than welcome to take a look at other accommodations.)</p>
<p>20 rooms have been reserved for the nights of Saturday, the 4th, and Sunday, the 5th. Check-in is 4:00pm and check-out is 12:00pm. Limited valet parking is available for a fee.</p>
<hr />
<h2>Getting there</h2>
<p>The 4th of July Weekend can be a little hairy, so we really recommend avoiding traffic and going by plane or train.</p>
<p>Washington/Reagan Airport (DCA) is by far the easiest way to get in and out of DC since it has its own DC Metro (subway) station. Dulles (IAD) and Baltimore (BWI) aren't available by Metro, although there are several bus/taxi options.</p>
<p>Pinstripes is about a 15-minute walk from the nearest Metro station, <a href="https://www.google.com/maps/place/Foggy+Bottom+Metro+Station/@38.904673,-77.0578731,15z/data=!4m2!3m1!1s0x89b7b7b17a97cb27:0x57039c345652dcf4" target="_blank">Foggy Bottom</a>. There are several accessible bus lines that run through Georgetown as well.</p>
<hr />
<h2>Things to do</h2>
<p>Georgetown has many shops, niche restaurants, and beautiful parks, and runs right along the Potomac River. It's also next to the old B&amp;O Railroad (remember that from Monopoly?) which has been turned into a bike/running path, the Capital Crescent Trail, which is almost completely flat and goes all the way to Bethesda. The rest of Washington offers a huge range of museums, memorials, and things that are just neat to see, most of which are free.</p>
<p>A great way to explore the city is by <a href="http://www.capitalbikeshare.com/" target="_blank">Capital Bikeshare</a>. Paying a daily and hourly fee gives you access to the bikes in over 150 bike racks across the area, and you don't need to return your bike to the rack from which you took it.</p>
</section>

<section id="registry">
<h2>Gift Registries</h2>
<ul class="big">
<li><a href="http://www.amazon.com/registry/wedding/DAHTHOUW363N" target="_blank">Amazon</a></li>
<li><a href="http://www.crateandbarrel.com/Gift-Registry/Arielle-Klane-and-Robin-Thomas/r5221092" target="_blank">Crate &amp; Barrel</a></li>
<li><a href="http://www.honeyfund.com/wedding/arielleandrobin" target="_blank">Honeyfund</a></li>
</ul>

<hr />

<h2>Mailing Address</h2>
<p class="info">4750 Chevy Chase Drive &num;107
Chevy Chase, MD 20815</p>

</section>

</main>

<footer>
<hr />
<h2>Contact</h2>
<p class="info"><a href="mailto:arielleandrobin@gmail.com" target="_blank">arielleandrobin@gmail.com</a><br />Facebook: <a href="https://www.facebook.com/ariellek" target="_blank">Arielle</a> &nbsp;<a href="https://www.facebook.com/robertgfthomas" target="_blank">Robin</a></p>
<a href="http://www.robertakarobin.com" target="_blank">Site coded by Robin</a>
</footer>

</body>
</html>
