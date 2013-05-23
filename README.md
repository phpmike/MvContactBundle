MvContactBundle
===============

Contact form for website

INSTALLATION with COMPOSER
--------------------------

You need have installed Symfony2 2.2 with Composer or have a composer.json file

###1)  Add to composer.json in the root `require` key  

    "mv/mv-contact-bundle": "2.2.*@dev"

###2)  Add to AppKernel.php

    new Mv\ContactBundle\MvContactBundle(),

###3)  Add to config.yml
 
    mv_contact:
        mail_from:      server.mail@domain.tld
        mail_to:        your.mail@domain.tld
        # Eventually
        mail_cc:        another.mail@domain.tld
        mail_bcc:       another.secret.mail@domain.tld

###4)  Add to routing.yml
 
    mv_contact:
        resource: "@MvContactBundle/Resources/config/routing.yml"

for translated websites, add:

        prefix: /{_locale}
        defaults:
            _locale: en

###5)  Eventually override layout.html.twig

Create `app/Resources/MvContactBundle/views/layout.html.twig`

See original `vendor/mv/mv-contact-bundle/Mv/ContactBundle/Resources/views/layout.html.twig` for example

Change where extends from and bloc name are what you expect...

Run update with composer

    php path/to/composer.phar update

Route name "mvcontact" is contact form