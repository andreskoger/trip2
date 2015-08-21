### Installation

You need to have [Composer](https://github.com/kristjanjansen/trip2_vagrant/blob/master/provision.sh#L46) and [NodeJS and Gulp](https://github.com/kristjanjansen/trip2_vagrant/blob/master/provision.sh#L105) installed. Then:

    git clone https://github.com/kristjanjansen/trip2.git
    cd trip2
    composer install
    php artisan key:generate
    npm install
    gulp
    sudo chmod -R o+w bootstrap/cache/
    sudo chmod -R o+w storage/
    sudo chmod -R o+w public/images/
    cp .env.example .env

Then  add following parameters to ```/.env```:

    DB_HOST1=127.0.0.1
    DB_DATABASE1=trip # Old Drupal database
    DB_USERNAME1=username
    DB_PASSWORD1=password

    DB_HOST2=127.0.0.1
    DB_DATABASE2=trip2 # New Laravel database
    DB_USERNAME2=username
    DB_PASSWORD2=password

    DB_CONNECTION=trip2

Now you should be able to access the web app and also run console commands.

### Converters

Converters convert legacy database records to Laravel models. Execute them by running:
    
    php artisan migrate:refresh
    php artisan convert:all
    
which runs all conversions found at ```app/Console/Commands```. You can list all the available conversions by running:

    php artisan list convert

When running the converter separately its recommended you first run:

    php artisan migrate:terms

Note that by default, only the small sample of legacy database is converted. To overwrite this add following parameter to ```.env```:

    CONVERT_TAKE=how_many_items

Note that maximum number of items in databases is around 110000.

If you also want to convert images, add following to ```.env```:
    
    CONVERT_FILES=true
