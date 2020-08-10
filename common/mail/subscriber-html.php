<?php

use common\helpers\HtmlLink;
?>


<p>Hello <?= $channel->username ?></p>
<p>User <?= HtmlLink::channelLink($user, true) ?> has subscribed to you</p>

<p>FreeCodeTube Team</p>