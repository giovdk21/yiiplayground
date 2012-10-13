<?php $this->breadcrumbs =array('Security'); ?>

<h2>Preventing XSS</h2>

<p>
Cross-site scripting (also known as XSS) occurs when a web application
gathers malicious data from a user. Often attackers will inject JavaScript,
VBScript, ActiveX, HTML, or Flash into a vulnerable application to fool other
application users and gather data from them.
For example, a poorly design forum system may display user input in forum posts
without any checking. An attacker can then inject a piece of malicious
JavaScript code into a post so that when other users read this post,
the JavaScript runs unexpectedly on their computers.
Cross-site scripting carried out on websites were roughly 80% of all security vulnerabilities .
Their impact may range from a petty nuisance to a significant security risk, depending on the
sensitivity of the data handled by the vulnerable site, and the nature of any
security mitigations implemented by the site's owner.
</p>