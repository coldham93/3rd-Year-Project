<?php $seller = unserialize($seller); $user = unserialize($user); ?>

<p style="font-family:Helvetica">To {{ ucfirst($seller->first_name) }}</p>

<p style="font-family:Helvetica">{{ $text }}</p>

<p style="font-family:Helvetica">From {{ ucfirst($user->first_name) }}</p>