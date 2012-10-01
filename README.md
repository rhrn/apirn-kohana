# Install

current installed envoirement: ubuntu 12.04, git, nginx 1.2.3, php5 + php5-fpm, mysql 5.5

in example `kohana` and `apirn-kohana` in same directory level, you can change it in index.php

### files

    git clone https://github.com/kohana/kohana.git
    cd kohana/
    git checkout -b dev33 origin/3.3/develop
    git submodule init
    git submodule update
    cd ..

    git clone https://github.com/rhrn/apirn-kohana.git
    cd apirn-kohana

    chmod -R 0777 logs cache
    cp index.php.default index.php

    cp config/default/* config/
    # configure database connect, cookie params... 
    
    # export mysql structure
    mysql -u test test < dev/sql/apirn-kohana.sql

### nginx

    sudo vim /etc/nginx/sites-available/apirn-kohana

put in config

    server {

      listen   8000; ## listen for ipv4; this line is default and implied

      # edit path to project
      root /home/rhrn/www/apirn-kohana;
      index index.php;

      server_name _;

      access_log  /var/log/nginx/apirn-kohana.loc.access.log;
      error_log  /var/log/nginx/apirn-kohana.loc.error.log;

      location / {
        try_files $uri $uri/ /index.php?$query_string;
      }

      location ~ \.php$ {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
      # # NOTE: You should have "cgi.fix_pathinfo = 0;" in php.ini
      #
      # # With php5-cgi alone:
      # fastcgi_pass 127.0.0.1:9000;
      # # With php5-fpm:
        fastcgi_pass unix:/var/run/php5-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
      }

      # deny access to .htaccess files, if Apache's document root
      # concurs with nginx's one
      #
      location ~ /\. {
       deny all;
      }
    }

create softlink for enabled sites

    sudo ln -s /etc/nginx/sites-available/apirn-kohana /etc/nginx/sites-enabled/

    sudo /etc/init.d/nginx restart
