<?php $this->breadcrumbs =array('Security'); ?>

<h2>Preventing Cross Site Request Forgery</h2>

<p>
Cross-Site Request Forgery (CSRF) attacks occur when a malicious web site
causes a user's web browser to perform an unwanted action on a trusted site.
For example, a malicious web site has a page that contains an image tag whose src
points to a banking site: http://bank.example/withdraw?transfer=10000&to=someone. If a user who
has a login cookie for the banking site happens to visit this malicous page, the action of transferring
10000 dollars to someone will be executed. Contrary to cross-site, which exploits the trust a user
has for a particular site, CSRF exploits the trust that a site has for a particular user.
</p>