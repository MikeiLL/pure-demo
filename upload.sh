#!/usr/bin/env bash

if [[ $1 == --boo ]] ; then
    rsync -avP style.css dist lib woocommerce screenshot.png templates *.php *.css elenaboo:public_html/wp/wp-content/themes/pure-demolition
elif [[ $1 == --ill ]] ; then
		rsync -avP style.css dist lib woocommerce screenshot.png templates *.php *.css bhujanga:public_html/wp/wp-content/themes/pure-coils
elif [[ $1 == --my ]] ; then
		rsync -avP style.css dist lib woocommerce screenshot.png templates *.php *.css my:public_html/wprs/wp-content/themes/pure-yoga
elif [[ $1 == --mh ]] ; then
		rsync -avP style.css dist lib woocommerce screenshot.png templates *.php *.css madhappy:public_html/LIVE/wp-content/themes/pure-madness
elif [[ $1 == --daddy ]] ; then
		rsync -avP style.css dist lib woocommerce screenshot.png templates *.php *.css madhappy:public_html/LIVE/wp-content/themes/pure-life
elif [[ $1 == --ville ]] ; then
		rsync -avP style.css dist lib woocommerce screenshot.png templates *.php *.css brnsville:public_html/wp/wp-content/themes/pure-ville
elif [[ $1 == --all ]] ; then
    rsync -avP style.css dist lib woocommerce screenshot.png templates *.php *.css elenaboo:public_html/wp/wp-content/themes/pure-demolition
		rsync -avP style.css dist lib woocommerce screenshot.png templates *.php *.css bhujanga:public_html/wp/wp-content/themes/pure-coils
		rsync -avP style.css dist lib woocommerce screenshot.png templates *.php *.css my:public_html/wprs/wp-content/themes/pure-yoga
		rsync -avP style.css dist lib woocommerce screenshot.png templates *.php *.css madhappy:public_html/LIVE/wp-content/themes/pure-madness
		rsync -avP style.css dist lib woocommerce screenshot.png templates *.php *.css brnsville:public_html/wp/wp-content/themes/pure-ville
		rsync -avP style.css dist lib woocommerce screenshot.png templates *.php *.css mfld:public_html/wp/wp-content/themes/pure-life
else
    echo Enter --boo --ill --mh --my --ville --daddy or --all
fi
