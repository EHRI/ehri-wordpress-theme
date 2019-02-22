#!/bin/sh

rsync -avl --exclude .idea --exclude node_modules --exclude *.iml --exclude .git . es1:/var/www/blog.ehri-project-stage.eu/wp-content/themes/ehri/
